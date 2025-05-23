<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Umkm;

class Card extends Component
{
    public $umkm;

    // Accept $umkm as a parameter in mount method
    public function mount($umkm)
    {
        $this->umkm = $umkm;
    }

    public function render()
    {
        $umkms = Umkm::with('photos')->get(); // Or a specific query like ->where('no_umkm', $someNoUmkm)->first()
        return view('livewire.card');
    }
}
