<?php

namespace App\Livewire;

use App\Models\Umkm;
use Livewire\Component;
use Livewire\WithPagination;

class UmkmList extends Component
{
    use WithPagination;

    public $search = '';
    public $page = 1; // Explicitly declare the page property


  protected $queryString = [
    'search' => ['except' => ''],
    'page' => ['except' => 1] // Include page in query string
];

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
        $umkms = $this->getQuery()->paginate(12);

        return view('livewire.umkm-list', [
            'umkms' => $umkms,
        ])->layout('layouts.app');
    }
}
