<?php

namespace App\Livewire;

use App\Models\Umkm;
use App\Models\User;
use Livewire\Component;

class ManageUmkms extends Component
{
    public $umkms;
    public $users;
    public $search = ''; // Add a search property

    public function mount()
    {
        $this->users = User::all();
        $this->umkms = $this->queryUmkms();
    }

    public function updatedSearch()
    {
        // Update the UMKM list based on the search query
        $this->umkms = $this->queryUmkms();
    }

    public function assignUser($no_umkm, $userId)
    {
        $umkm = Umkm::where('no_umkm', $no_umkm)->firstOrFail();
        $umkm->update(['user_id' => $userId]);

        session()->flash('message', "User assigned to UMKM {$umkm->nama_umkm} successfully.");
        $this->umkms = $this->queryUmkms(); // Refresh the list
    }

    public function deleteUser($no_umkm)
    {
        $umkm = Umkm::where('no_umkm', $no_umkm)->firstOrFail();
        $umkm->update(['user_id' => null]);

        session()->flash('message', "User unassigned from UMKM {$umkm->nama_umkm} successfully.");
        $this->umkms = $this->queryUmkms(); // Refresh the list
    }



    private function queryUmkms()
    {
        $query = Umkm::query();

        if ($this->search) {
            $search = strtolower($this->search);
            $query->whereRaw('LOWER(nama_umkm) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(nama_produk) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(nama_pemilik) LIKE ?', ["%{$search}%"]);
        }

        return $query->orderBy('id', 'ASC')->get();
    }

    public function render()
    {
        return view('livewire.manage-umkms')->layout('layouts.app');
    }
}
