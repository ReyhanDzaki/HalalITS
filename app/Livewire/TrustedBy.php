<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Umkm;

class TrustedBy extends Component
{
    public $totalUmkms;

    public function mount()
    {
        $this->totalUmkms = Umkm::count();
    }

    public function render()
    {

        return view('livewire.trusted-by',);
    }
}
