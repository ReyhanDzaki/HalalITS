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
public $search = '';
    public $isModalOpen = false;

 public function updatedSearch()
    {
        $this->resetPage(); // Reset pagination when search query is updated
    }

    public function getQuery()
    {
        $query = Umkm::query();

        if ($this->search) {
            $search = strtolower($this->search);
            $query->whereRaw('LOWER(nama_umkm) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(nama_produk) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(nama_pemilik) LIKE ?', ["%{$search}%"]);
        }

        $query->orderBy('id', 'ASC');

        return $query;
    }

    public function render()
    {
       $umkms = $this->getQuery()->paginate(8);

        return view('livewire.umkm-crud', [
            'umkms' => $umkms,
        ])->layout('layouts.app');
    }

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

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

  public function store()
{
    // Validate the form data

    $messages = [
        'no_umkm.required' => 'Nomor UMKM is required.',
        'no_umkm.unique' => 'Nomor UMKM must be unique.',
        'nama_pemilik.required' => 'Nama Pemilik is required.',
        'nama_umkm.required' => 'Nama UMKM is required.',
        'nama_produk.required' => 'Nama Produk is required.',
        'tipe_binaan.required' => 'Tipe Binaan is required.',
        'alamat.required' => 'Alamat is required.',
        'desa.required' => 'Desa is required.',
        'kecamatan.required' => 'Kecamatan is required.',
        'kota.required' => 'Kota is required.',
        'status.required' => 'Status is required.',
        'image.image' => 'The image must be an image file.',
        'image.max' => 'The image size must be less than 2MB.',
        'no_wa.max' => 'No WhatsApp cannot be longer than 20 characters.',
        'email.email' => 'Please enter a valid email address.',
        'sertifikat_halal.max' => 'Sertifikat Halal cannot be longer than 255 characters.',
        'user_id.required' => 'User is required.',
        'user_id.exists' => 'User must exist in the system.',
        'newPhotos.*.image' => 'Each photo must be an image file.',
        'newPhotos.*.max' => 'Each photo must be smaller than 2MB.',
        'newPhotoDescriptions.*.max' => 'Each photo description cannot be longer than 255 characters.',
    ];

    $this->validate([
        'no_umkm' => 'required|unique:umkms,no_umkm',
        'nama_pemilik' => 'required|string|max:255',
        'nama_umkm' => 'required|string|max:255',
    ],$messages);


    // Handle the image upload (if any)
    if ($this->image) {
        $this->image = $this->image->store('images', 'public');
    }

    // Create the new UMKM record
    $umkm = Umkm::create([
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
        'image' => $this->image,  // Store the image URL (if uploaded)
        'no_wa' => $this->no_wa,
        'email' => $this->email,
        'instagram' => $this->instagram,
        'facebook' => $this->facebook,
        'bpom' => $this->bpom,
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
    ]);

    // Handle the photo uploads and descriptions
    foreach ($this->newPhotos as $index => $photo) {
        if ($photo) {
            $photoPath = $photo->store('photos', 'public');
            Photo::create([
                'photo' => $photoPath,
                'description' => $this->newPhotoDescriptions[$index],
                'umkm_id' => $umkm->id,  // Link the photo to the newly created UMKM entry
            ]);
        }
    }

    // Close the modal after storing the data
    $this->closeModal();

    // Flash success message
    session()->flash('message', 'UMKM Created Successfully.');

    // Reset the form fields
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


