<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Umkm;


class Detailumkm extends Component

{
public $umkms;
public $halalCode;

 public function mount($no_umkm)
    {
        $this->umkms = Umkm::where('no_umkm', $no_umkm)->firstOrFail();
        $this->halalCode = explode(',', $this->umkms->sertifikat_halal);
    }

    public function render()
    {
         //declare nowa
        $no_wa = preg_replace('/^0/', '62', $this->umkms->no_wa);
         return view('livewire.detailumkm', [
            'umkm' => $this->umkms,
            'no_wa' =>$no_wa,
        ])->layout('layouts.app');
    }
}
