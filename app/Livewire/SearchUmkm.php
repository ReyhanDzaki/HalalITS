<?php

namespace App\Livewire;

use App\Models\Umkm;
use Livewire\Attributes\Url;
use Livewire\Component;
use Illuminate\Support\Facades\Redirect;

class SearchUmkm extends Component
{
    #[Url(as:'s', history :true, keep: true)]
    public $search = '';
    public $umkms;

    public function render()
    {
        // Adjust the query based on whether $search is provided or not
        if (!empty($this->search)) {
            $search = strtolower($this->search);
            $this->umkms = Umkm::whereRaw('LOWER(nama_umkm) LIKE ?', ["%{$search}%"])
                               ->orWhereRaw('LOWER(nama_produk) LIKE ?', ["%{$search}%"])
                               ->orWhereRaw('LOWER(nama_pemilik) LIKE ?', ["%{$search}%"])
                               ->limit(3)
                               ->get();
        } else {
            $this->umkms = []; // Initialize $umkms as an empty array when $search is empty
        }

        return view('livewire.search-umkm', [
            'umkms' => Umkm::where('nama_umkm', 'like', '%' . $this->search . '%')
        ]);


    }

     public function toList()
    {
        // Redirect to UmkmList component with search term as query parameter
        return Redirect::route('binaan.list', ['search' => $this->search]);
    }

    public function handleDetail($no_umkm)
    {
        return Redirect::route('binaan.detail', ['no_umkm' => $no_umkm]);
    }

}
