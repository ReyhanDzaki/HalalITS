<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Umkm;

class SearchUmkm extends Component
{
    public $searchTerm = '';
    public $umkms;

    public function render()
    {
        // Adjust the query based on whether $searchTerm is provided or not
        if (!empty($this->searchTerm)) {
            $this->umkms = Umkm::where('nama_umkm', 'like', '%' . $this->searchTerm . '%')
                               ->orWhere('nama_produk', 'like', '%' . $this->searchTerm . '%')
                               ->orWhere('nama_pemilik', 'like', '%' . $this->searchTerm . '%')
                               ->get();
        } else {
            $this->umkms = []; // Initialize $umkms as an empty array when $searchTerm is empty
        }

        return view('livewire.search-umkm');
    }
}
