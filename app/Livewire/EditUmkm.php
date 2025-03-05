<?php

namespace App\Livewire;

use App\Models\Umkm;
use App\Models\Photo;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditUmkm extends Component
{
    use WithFileUploads;

    public $umkms;
    public $halalCode = [];
    public $no_wa;
    public $nama_umkm;
    public $alamat;
    public $nama_pemilik;
    public $facebook;
    public $tokopedia;
    public $instagram;
    public $shopee;
    public $nama_produk;
    public $photos = []; // For new photo uploads
    public $photoDescriptions = []; // For photo descriptions
    public $existingPhotos = []; // For displaying existing photos
       public $latitude;
    public $longitude;


    public function mount($no_umkm)
    {
        $this->umkms = Umkm::where('no_umkm', $no_umkm)->firstOrFail();

        if ($this->umkms->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $this->halalCode = explode(',', $this->umkms->sertifikat_halal);
        $this->no_wa = preg_replace('/^0/', '62', $this->umkms->no_wa);
        $this->nama_umkm = $this->umkms->nama_umkm;
        $this->alamat = $this->umkms->alamat;
        $this->nama_pemilik = $this->umkms->nama_pemilik;
        $this->nama_produk = $this->umkms->nama_produk;
        $this->facebook = $this->umkms->facebook;
        $this->instagram = $this->umkms->instagram;
        $this->tokopedia = $this->umkms->tokopedia;
        $this->shopee = $this->umkms->shopee;
        $this->latitude = $this->umkms->latitude ?? -6.200000; // Default to Jakarta
        $this->longitude = $this->umkms->longitude ?? 106.816666;
        // Load existing photos and descriptions
        $this->existingPhotos = Photo::where('umkm_id', $this->umkms->id)->get();
        $this->photoDescriptions = $this->existingPhotos->pluck('description', 'id')->toArray();
    }

    public function removeCode($index)
    {
        unset($this->halalCode[$index]);
        $this->halalCode = array_values($this->halalCode); // Re-index array
    }

    public function update()
    {
        $this->validate([
            'nama_umkm' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'halalCode.*' => 'string|max:255',
            'photos.*' => 'nullable|image|max:1024', // Validate photo uploads
            'photoDescriptions.*' => 'nullable|string|max:255', // Validate photo descriptions
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $this->umkms->update([
            'nama_umkm' => $this->nama_umkm,
            'alamat' => $this->alamat,
            'nama_pemilik' => $this->nama_pemilik,
            'nama_produk' => $this->nama_produk,
            'sertifikat_halal' => implode(',', $this->halalCode),
            'no_wa' => preg_replace('/^62/', '0', $this->no_wa),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'tokopedia' => $this->tokopedia,
            'shopee' => $this->shopee,
        ]);

        // Handle photo upload and description update
        if ($this->photos) {
            foreach ($this->photos as $index => $file) {
                $photoPath = $file->store('photos', 'public');
                Photo::create([
                    'umkm_id' => $this->umkms->id,
                    'photo' => $photoPath,
                    'description' => $this->photoDescriptions[$index] ?? '', // Add description
                ]);
            }
        }

        // Handle updating existing photo descriptions
        foreach ($this->existingPhotos as $photo) {
            $photo->update([
                'description' => $this->photoDescriptions[$photo->id] ?? '',
            ]);
        }

        session()->flash('message', 'UMKM updated successfully.');
    }

    public function addCode()
{
    $this->halalCode[] = ''; // Add a new empty string to the halalCode array
}


    public function addPhotoField()
    {
        $this->photos[] = null;
        $this->photoDescriptions[] = '';
    }

public function removePhotoField($index)
{
    // Check if the index exists in the photos array (for new uploads)
    if (isset($this->photos[$index])) {
        // Remove the file from the photos array (these are not yet stored in the storage)
        unset($this->photos[$index]);
        unset($this->photoDescriptions[$index]);
    } elseif (isset($this->existingPhotos[$index])) {
        // If it's an existing photo, mark it for deletion
        $photo = $this->existingPhotos[$index];

        // Log the deletion attempt
        logger('Attempting to delete existing photo with ID: ' . $photo->id);

        // Delete the photo file from the storage
        if (Storage::disk('public')->exists($photo->photo)) {
            $deleted = Storage::disk('public')->delete($photo->photo);
            logger('Photo deleted from storage: ' . ($deleted ? 'yes' : 'no'));
        }

        // Delete the photo record from the database
        $photo->delete();
        logger('Photo record deleted from the database: yes');

        // Remove the photo and its description from the existingPhotos array
        unset($this->existingPhotos[$index]);
        unset($this->photoDescriptions[$photo->id]);
    } else {
        // Log if the index does not exist in either array
        logger('Index ' . $index . ' not found in photos or existingPhotos array.');
    }

    // Re-index the photos array if it was a new upload
    $this->photos = array_values($this->photos);

    // No need to re-index existingPhotos or photoDescriptions
}



    public function render()
    {
        return view('livewire.edit-umkm')->layout('layouts.app');
    }
}
