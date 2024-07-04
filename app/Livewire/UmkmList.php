<?php

namespace App\Livewire;

use App\Models\Umkm;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UmkmList extends Component
{
    use WithPagination;

    #[Url(as:'s', history :true, keep: true)]
    public $search ='';

    protected $queryString = ['search']; // Enable query string parameter binding


    public function getQuery()
    {
        $query = Umkm::query();


        if ($this->search) {
            $search = strtolower($this->search);
            $query->whereRaw('LOWER(nama_umkm) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(nama_produk) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(nama_pemilik) LIKE ?', ["%{$search}%"]);
        }


        return $query;
    }

    public function render()
    {
        $umkms = $this->getQuery()->paginate(12); // Paginate results

        return view('livewire.umkm-list', [
            'umkms' => $umkms,
        ])->layout('layouts.app');
    }
}
