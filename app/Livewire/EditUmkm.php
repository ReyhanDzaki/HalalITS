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
    public $pirtCode = []; // Added for PIRT code
    public $no_wa;
    public $nama_umkm;
    public $alamat;
    public $nama_pemilik;
    public $facebook;
    public $tokopedia;
    public $instagram;
    public $shopee;
    public $nama_produk;
    public $photos = [];
    public $photoDescriptions = [];
    public $existingPhotos = [];
    public $photoHalalIds = [];
    public $latitude;
    public $longitude;

    public function mount($no_umkm)
    {
        $this->umkms = Umkm::where('no_umkm', $no_umkm)->firstOrFail();

        if ($this->umkms->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $this->halalCode = explode(',', $this->umkms->sertifikat_halal);
        // Initialize pirtCode from the umkms model, handling potential null or empty string
        $this->pirtCode = $this->umkms->pirt ? explode(',', $this->umkms->pirt) : [];
        $this->no_wa = preg_replace('/^0/', '62', $this->umkms->no_wa);
        $this->nama_umkm = $this->umkms->nama_umkm;
        $this->alamat = $this->umkms->alamat;
        $this->nama_pemilik = $this->umkms->nama_pemilik;
        $this->nama_produk = $this->umkms->nama_produk;
        $this->facebook = $this->umkms->facebook;
        $this->instagram = $this->umkms->instagram;
        $this->tokopedia = $this->umkms->tokopedia;
        $this->shopee = $this->shopee;
        $this->latitude = $this->umkms->latitude ?? -6.2; // Default to Jakarta
        $this->longitude = $this->umkms->longitude ?? 106.816666;
        // Load existing photos and descriptions
        $this->existingPhotos = Photo::where('umkm_id', $this->umkms->id)->get();
        $this->photoDescriptions = $this->existingPhotos->pluck('description', 'id')->toArray();
        $this->photoHalalIds = $this->existingPhotos->pluck('sertifikathalal_id', 'id')->toArray();
    }

    public function removeCode($index)
    {
        unset($this->halalCode[$index]);
        $this->halalCode = array_values($this->halalCode); // Re-index array
    }

    // New method to remove PIRT code
    public function removePirtCode($index)
    {
        unset($this->pirtCode[$index]);
        $this->pirtCode = array_values($this->pirtCode); // Re-index array
    }

    public function update()
    {
        try {
            $this->validate([
                'nama_umkm' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'nama_pemilik' => 'required|string|max:255',
                'nama_produk' => 'required|string|max:255',
                'halalCode.*' => 'nullable|string|max:255', // Made nullable as it might be empty
                'pirtCode.*' => 'nullable|string|max:255', // Added validation for PIRT code
                'photoDescriptions.*' => 'nullable|string|max:255',
                'photoHalalIds.*' => 'nullable|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);

            $this->umkms->update([
                'nama_umkm' => $this->nama_umkm,
                'alamat' => $this->alamat,
                'nama_pemilik' => $this->nama_pemilik,
                'nama_produk' => $this->nama_produk,
                'sertifikat_halal' => implode(',', array_filter($this->halalCode)), // Filter out empty strings before imploding
                'pirt' => implode(',', array_filter($this->pirtCode)), // Save PIRT code, filter out empty strings
                'no_wa' => preg_replace('/^62/', '0', $this->no_wa),
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'facebook' => $this->facebook,
                'instagram' => $this->instagram,
                'tokopedia' => $this->tokopedia,
                'shopee' => $this->shopee,
            ]);

            // Handle new photo uploads/links
            if ($this->photos) {
                foreach ($this->photos as $index => $photoInput) {
                    $photoPath = null;

                    // Check if it's a file upload
                    if (is_object($photoInput) && $photoInput->isValid()) {
                        $photoPath = $photoInput->store('photos', 'public'); // Store uploaded file
                        logger('File upload detected. Path: ' . $photoPath);
                    }
                    // If it's a URL string
                    elseif (is_string($photoInput) && filter_var($photoInput, FILTER_VALIDATE_URL)) {
                        if (filter_var($photoInput, FILTER_VALIDATE_URL)) {
                            $photoPath = $photoInput; // Store the URL if it is actually a valid URL
                            logger('Valid URL detected. URL: ' . $photoPath);
                        } else {
                            logger('Invalid URL detected at index ' . $index . '. Input: ' . $photoInput);
                            session()->flash('message', 'Failed to save photo. Please check your photo inputs.');
                            return; // Exit the entire function immediately
                        }
                    } else {
                        logger('Invalid photo input at index ' . $index . '. Input: ' . print_r($photoInput, true));
                        session()->flash('message', 'Failed to save photo. Please check your photo inputs.');
                        return; // Exit the entire function immediately
                    }

                    if ($photoPath) {
                        try {
                            $createdPhoto = Photo::create([
                                'umkm_id' => $this->umkms->id,
                                'photos' => $photoPath,
                                'description' => $this->photoDescriptions[$index] ?? '',
                                'sertifikathalal_id' => $this->photoHalalIds[$index] ?? '',
                            ]);
                            logger('Photo record created in database. Photo ID: ' . $createdPhoto->id . ', Path: ' . $photoPath);
                        } catch (\Exception $e) {
                            logger('Error creating photo record: ' . $e->getMessage() . ', Path: ' . $photoPath);
                            session()->flash('errors', 'Failed to save photo. Please try again.');
                            return; // Exit the entire function immediately
                        }
                    }
                }
            }

            // Handle updating existing photo descriptions
            foreach ($this->existingPhotos as $photo) {
                $photo->update([
                    'description' => $this->photoDescriptions[$photo->id] ?? '',
                    'sertifikathalal_id' => $this->photoHalalIds[$photo->id] ?? '',
                ]);
            }

            session()->flash('message', 'UMKM updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('message', 'Failed! Pastikan semua input wajib sudah terisi.');
            throw $e; // Re-throw the exception to trigger Laravel's default error handling
        }
    }

    public function addCode()
    {
        $this->halalCode[] = ''; // Add a new empty string to the halalCode array
    }

    // New method to add PIRT code field
    public function addPirtCode()
    {
        $this->pirtCode[] = ''; // Add a new empty string to the pirtCode array
    }

    public function addPhotoField()
    {
        $this->photos[] = null;
        $this->photoDescriptions[] = '';
        $this->photoHalalIds[] = null;
    }

    public function removePhotoField($photoId)
    {
        // Initialize index to null
        $index = null;

        // Find the index of the photo in the existingPhotos collection
        foreach ($this->existingPhotos as $key => $photo) {
            if ($photo->id == $photoId) {
                $index = $key; // Found the index!
                break; // Exit the loop
            }
        }

        // Check if the index was found
        if ($index === null) {
            logger('Photo with ID ' . $photoId . ' not found in existingPhotos array.');
            return;
        }

        // Check if the index exists in the existingPhotos array
        if (isset($this->existingPhotos[$index])) {
            // Get the photo object
            $photo = $this->existingPhotos[$index];

            // Log the photo ID before deletion
            logger('Deleting photo with ID: ' . $photo->id);

            // Delete the photo record from the database
            try {
                $photo->delete();
                logger('Photo deleted from database successfully.');
            } catch (\Exception $e) {
                // Log any errors during database deletion
                logger('Error deleting photo from database: ' . $e->getMessage());
                session()->flash('errors', 'Failed to delete photo. Please try again.');
                return; // Important: Exit the function if deletion fails
            }

            // Delete the photo file from storage, if it exists
            if (!empty($photo->photos) && is_string($photo->photos) && Storage::disk('public')->exists($photo->photos)) {
                $deleted = Storage::disk('public')->delete($photo->photos);
                if ($deleted) {
                    logger('Photo file deleted from storage.');
                } else {
                    logger('Failed to delete photo file from storage.');
                }
            } else {
                logger('Photo file path is invalid or null.');
            }

            // Remove the photo from the existingPhotos array
            unset($this->existingPhotos[$index]);

            // Remove associated description and halal IDs. Use index.
            if (isset($this->photoDescriptions[$index])) {
                unset($this->photoDescriptions[$index]);
            }

            if (isset($this->photoHalalIds[$index])) {
                unset($this->photoHalalIds[$index]);
            }
        } elseif (isset($this->photos[$index])) {
            // Handle the case where the photo is a new upload (not yet in the database)
            unset($this->photos[$index]);
            if (isset($this->photoDescriptions[$index])) {
                unset($this->photoDescriptions[$index]);
            }

            if (isset($this->photoHalalIds[$index])) {
                unset($this->photoHalalIds[$index]);
            }
        } else {
            // Log if the index does not exist in either array
            logger('Index ' . $index . ' not found in photos or existingPhotos arrays.');
            return;
        }

        // Re-index the arrays
        $this->photos = array_values($this->photos);
        $this->existingPhotos = array_values($this->existingPhotos->toArray()); // Convert to array before array_values()
        if (isset($this->photoDescriptions) && is_array($this->photoDescriptions)) {
            $this->photoDescriptions = array_values($this->photoDescriptions);
        }

        if (isset($this->photoHalalIds) && is_array($this->photoHalalIds)) {
            $this->photoHalalIds = array_values($this->photoHalalIds);
        }

        // Flash a success message
        session()->flash('message', 'Photo successfully removed');
    }

    public function render()
    {
        return view('livewire.edit-umkm')->layout('layouts.app');
    }
}
