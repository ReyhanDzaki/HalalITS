<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Umkm;
use Livewire\WithPagination;

class UmkmList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap'; // Use the bootstrap theme for pagination (optional)

    public function render()
    {
        $umkms = Umkm::paginate(12); // Fetch 15 UMKM records per page

        return view('livewire.umkm-list', ['umkms' => $umkms])->layout('layouts.app');
    }
}
