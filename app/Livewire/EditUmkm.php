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
    public $pirtCode = [];
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
    public $kota; // Added for 'kota' (city)

    public function mount($no_umkm)
    {
        $this->umkms = Umkm::where('no_umkm', $no_umkm)->firstOrFail();

        if ($this->umkms->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $this->halalCode = explode(',', $this->umkms->sertifikat_halal);
        $this->pirtCode = $this->umkms->pirt ? explode(',', $this->umkms->pirt) : [];
        $this->no_wa = preg_replace('/^0/', '62', $this->umkms->no_wa);
        $this->nama_umkm = $this->umkms->nama_umkm;
        $this->alamat = $this->umkms->alamat;
        $this->nama_pemilik = $this->umkms->nama_pemilik;
        $this->nama_produk = $this->umkms->nama_produk;
        $this->facebook = $this->umkms->facebook;
        $this->instagram = $this->umkms->instagram;
        $this->tokopedia = $this->umkms->tokopedia;
        $this->shopee = $this->umkms->shopee;
        $this->latitude = $this->umkms->latitude ?? -6.2; // Default to Jakarta
        $this->longitude = $this->umkms->longitude ?? 106.816666;
        $this->kota = $this->umkms->kota; // Initialize 'kota' from the UMKM model

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
                'nama_pemilik' => 'required|string|max:255',
                'photoDescriptions.*' => 'nullable|string|max:255',
                'photoHalalIds.*' => 'nullable|string|max:255',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'kota' => 'required|string|max:255', // Added validation for 'kota'
            ]);

            $this->umkms->update([
                'nama_umkm' => $this->nama_umkm,
                'alamat' => $this->alamat,
                'nama_pemilik' => $this->nama_pemilik,
                'nama_produk' => $this->nama_produk,
                'sertifikat_halal' => implode(',', array_filter($this->halalCode)),
                'pirt' => implode(',', array_filter($this->pirtCode)),
                'no_wa' => preg_replace('/^62/', '0', $this->no_wa),
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'facebook' => $this->facebook,
                'instagram' => $this->instagram,
                'tokopedia' => $this->tokopedia,
                'shopee' => $this->shopee,
                'kota' => $this->kota, // Save 'kota' to the UMKM model
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
                            return;
                        }
                    } else {
                        logger('Invalid photo input at index ' . $index . '. Input: ' . print_r($photoInput, true));
                        session()->flash('message', 'Failed to save photo. Please check your photo inputs.');
                        return;
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
                            return;
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
            throw $e;
        }
    }

    public function addCode()
    {
        $this->halalCode[] = '';
    }

    public function addPirtCode()
    {
        $this->pirtCode[] = '';
    }

    public function addPhotoField()
    {
        $this->photos[] = null;
        $this->photoDescriptions[] = '';
        $this->photoHalalIds[] = null;
    }

    public function removePhotoField($photoId)
    {
        $index = null;

        foreach ($this->existingPhotos as $key => $photo) {
            if ($photo->id == $photoId) {
                $index = $key;
                break;
            }
        }

        if ($index === null) {
            logger('Photo with ID ' . $photoId . ' not found in existingPhotos array.');
            return;
        }

        if (isset($this->existingPhotos[$index])) {
            $photo = $this->existingPhotos[$index];
            logger('Deleting photo with ID: ' . $photo->id);

            try {
                $photo->delete();
                logger('Photo deleted from database successfully.');
            } catch (\Exception $e) {
                logger('Error deleting photo from database: ' . $e->getMessage());
                session()->flash('errors', 'Failed to delete photo. Please try again.');
                return;
            }

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

            unset($this->existingPhotos[$index]);

            if (isset($this->photoDescriptions[$index])) {
                unset($this->photoDescriptions[$index]);
            }

            if (isset($this->photoHalalIds[$index])) {
                unset($this->photoHalalIds[$index]);
            }
        } elseif (isset($this->photos[$index])) {
            unset($this->photos[$index]);
            if (isset($this->photoDescriptions[$index])) {
                unset($this->photoDescriptions[$index]);
            }

            if (isset($this->photoHalalIds[$index])) {
                unset($this->photoHalalIds[$index]);
            }
        } else {
            logger('Index ' . $index . ' not found in photos or existingPhotos arrays.');
            return;
        }

        $this->photos = array_values($this->photos);
        $this->existingPhotos = array_values($this->existingPhotos->toArray());
        if (isset($this->photoDescriptions) && is_array($this->photoDescriptions)) {
            $this->photoDescriptions = array_values($this->photoDescriptions);
        }

        if (isset($this->photoHalalIds) && is_array($this->photoHalalIds)) {
            $this->photoHalalIds = array_values($this->photoHalalIds);
        }

        session()->flash('message', 'Photo successfully removed');
    }

    public function render()
    {
        return view('livewire.edit-umkm')->layout('layouts.app');
    }
}
