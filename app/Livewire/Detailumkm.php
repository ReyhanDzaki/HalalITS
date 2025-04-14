<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Umkm;
use App\Models\Photo;

class Detailumkm extends Component
{
    public $umkms;
    public $photos = [];
    public $halalCode;
    public $pirt;
    public $bpom;
    public $umkm_id;

    public function mount($no_umkm)
    {
        // Fetch UMKM by no_umkm
        $this->umkms = Umkm::where('no_umkm', $no_umkm)->with('photos')->firstOrFail();

        // Split the halal codes
        $this->halalCode = explode(',', $this->umkms->sertifikat_halal);

        // PIRT Halal Code
        $this->pirt = explode(',', $this->umkms->pirt);

        // BPOM Halal Code
        $this->bpom = explode(',', $this->umkms->bpom);

        // Set the UMKM id for further use
        $this->umkm_id = $this->umkms->id;

        // Fetch photos associated with this UMKM
        $this->photos = Photo::where('umkm_id', $this->umkm_id)->get();
    }

     public function getZoomLevelProperty()
     {
     return ($this->umkms->latitude && $this->umkms->longitude) ? 14 : 4;
     }

    public function render()
    {
        // Convert WhatsApp number
        $no_wa = preg_replace('/^0/', '62', $this->umkms->no_wa);

        return view('livewire.detailumkm', [
            'umkm' => $this->umkms,
            'photos' => $this->photos,
            'no_wa' => $no_wa,
        ])->layout('layouts.app');
    }
}
