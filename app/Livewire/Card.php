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
        return view('livewire.card');
    }
}
