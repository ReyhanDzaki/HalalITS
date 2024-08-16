<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Umkm;
use App\Models\Photo;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class UmkmCrud extends Component
{
    use WithPagination, WithFileUploads;

    public $umkm_id, $no_umkm, $nama_pemilik, $nama_umkm, $nama_produk, $tipe_binaan, $alamat,
           $desa, $kecamatan, $kota, $status, $image, $no_wa, $email, $instagram,
           $facebook, $bpom, $pirt, $google_map, $tokopedia, $shopee, $bukalapak,
           $website, $video, $sertifikat_halal, $produkdesa, $user_id, $dosen,
           $cities_id, $status_date, $latitude, $longitude, $plus_code, $google_maps;

    public $photos = [];
    public $photoDescriptions = [];
    public $newPhotos = [];
    public $newPhotoDescriptions = [];

    public $isModalOpen = false;

    protected $rules = [
        // Existing rules
        'no_umkm' => 'required',
        // Other rules...

        // Add rules for new photos and descriptions
        'newPhotos.*' => 'nullable|image|max:2048',
        'newPhotoDescriptions.*' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        if (!Auth::check() || Auth::user()->name !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
    }

    public function render()
    {
        return view('livewire.umkm-crud', [
            'umkms' => Umkm::paginate(10),
        ])->layout('layouts.app');
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        // Handle the image upload
        if ($this->image) {
            $this->image = $this->image->store('images', 'public');
        }

        // Create or update the UMKM record
        $umkm = Umkm::updateOrCreate( // Set to null for new records
            [
                'no_umkm' => $this->no_umkm,
                'nama_pemilik' => $this->nama_pemilik,
                'nama_umkm' => $this->nama_umkm,
                'nama_produk' => $this->nama_produk,
                'tipe_binaan' => $this->tipe_binaan,
                'alamat' => $this->alamat,
                'desa' => $this->desa,
                'kecamatan' => $this->kecamatan,
                'kota' => $this->kota,
                'status' => $this->status,
                'image' => $this->image,
                'no_wa' => $this->no_wa,
                'email' => $this->email,
                'instagram' => $this->instagram,
                'facebook' => $this->facebook,
                'bpom' => $this->bpom,
                'pirt' => $this->pirt,
                'google_map' => $this->google_map,
                'tokopedia' => $this->tokopedia,
                'shopee' => $this->shopee,
                'bukalapak' => $this->bukalapak,
                'website' => $this->website,
                'video' => $this->video,
                'sertifikat_halal' => $this->sertifikat_halal,
                'produkdesa' => $this->produkdesa,
                'user_id' => $this->user_id,
                'dosen' => $this->dosen,
                'status_date' => $this->status_date,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
                'plus_code' => $this->plus_code,
                'google_maps' => $this->google_maps,
            ]
        );

        // Handle the photo uploads and descriptions
        foreach ($this->newPhotos as $index => $photo) {
            if ($photo) {
                $photoPath = $photo->store('photos', 'public');
               Photo::create([
            'photo' => $photoPath,
            'description' => $this->newPhotoDescriptions[$index],
            'umkm_id' => $umkm->id, // Ensure this is set
        ]);
            }
        }
        $this->closeModal();
        session()->flash('message', 'UMKM Created Successfully.');
        $this->resetFields();
    }

    public function addPhotoField()
    {
        $this->newPhotos[] = null;
        $this->newPhotoDescriptions[] = '';
    }

    public function removePhotoField($index)
    {
        unset($this->newPhotos[$index]);
        unset($this->newPhotoDescriptions[$index]);
        $this->newPhotos = array_values($this->newPhotos);
        $this->newPhotoDescriptions = array_values($this->newPhotoDescriptions);
    }

    public function edit($id)
    {
        $umkm = Umkm::findOrFail($id);
        $this->umkm_id = $id;
        $this->fill($umkm->toArray());
        $this->openModal();
    }

    public function delete($id)
    {
        Umkm::find($id)->delete();
        session()->flash('message', 'UMKM Deleted Successfully.');
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function resetFields()
    {
        // Reset fields
        $this->umkm_id = null;
        $this->no_umkm = null;
        $this->nama_pemilik = null;
        $this->nama_umkm = null;
        $this->nama_produk = null;
        $this->tipe_binaan = null;
        $this->alamat = null;
        $this->desa = null;
        $this->kecamatan = null;
        $this->kota = null;
        $this->status = null;
        $this->image = null;
        $this->no_wa = null;
        $this->email = null;
        $this->instagram = null;
        $this->facebook = null;
        $this->bpom = null;
        $this->pirt = null;
        $this->google_map = null;
        $this->tokopedia = null;
        $this->shopee = null;
        $this->bukalapak = null;
        $this->website = null;
        $this->video = null;
        $this->sertifikat_halal = null;
        $this->produkdesa = null;
        $this->user_id = null;
        $this->dosen = null;
        $this->cities_id = null;
        $this->status_date = null;
        $this->latitude = null;
        $this->longitude = null;
        $this->plus_code = null;
        $this->google_maps = null;
        $this->newPhotos = [];
        $this->newPhotoDescriptions = [];
    }
}
