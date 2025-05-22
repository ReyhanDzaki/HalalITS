<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Umkm;
use App\Models\Photo;
use App\Models\UmkmHistory; // Import the UmkmHistory model
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class Detailumkm extends Component
{
    public $umkms;
    public $photos = [];
    public $halalCode;
    public $pirt;
    public $bpom;
    public $umkm_id;
    public $recentUmkmHistory = []; // New property to hold recent history

    public function mount($no_umkm)
    {
        // Fetch UMKM by no_umkm
        $this->umkms = Umkm::where('no_umkm', $no_umkm)->with('photos')->firstOrFail();

        // Split the halal codes
        $this->halalCode = explode(',', $this->umkms->sertifikat_halal);

        // PIRT Halal Code
        $this->pirt = explode(',', $this->umkms->pirt);

        // BPOM Halal Code
        $this->bpom = explode(',', $this->umkms->bpom);

        // Set the UMKM id for further use
        $this->umkm_id = $this->umkms->id;

        // Fetch photos associated with this UMKM
        $this->photos = Photo::where('umkm_id', $this->umkm_id)->get();

        // --- NEW: Log the UMKM opening for the authenticated user ---
        if (Auth::check()) {
            $user = Auth::user();

            // Use updateOrCreate to prevent duplicate entries.
            // If a record with user_id and umkm_id exists, its opened_at will be updated.
            // Otherwise, a new record will be created.
            UmkmHistory::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'umkm_id' => $this->umkms->id, // Use the ID of the fetched UMKM
                ],
                [
                    'opened_at' => now(), // Record the current timestamp
                ]
            );

            // Load recent history after logging the current visit
            $this->loadRecentHistory();
        }
        // --- END NEW ---
    }

    /**
     * Loads the authenticated user's recent UMKM viewing history,
     * excluding the currently viewed UMKM.
     */
    public function loadRecentHistory()
    {
        if (Auth::check()) {
            $user = Auth::user();

            $this->recentUmkmHistory = UmkmHistory::where('user_id', $user->id)
                                                ->where('umkm_id', '!=', $this->umkms->id) // Exclude current UMKM
                                                ->with('umkm') // Eager load the UMKM details
                                                ->orderByDesc('opened_at')
                                                ->limit(5) // Limit to the last 5 viewed UMKMs
                                                ->get();
        }
    }

    public function getZoomLevelProperty()
    {
        return ($this->umkms->latitude && $this->umkms->longitude) ? 14 : 4;
    }

    public function render()
    {
        // Convert WhatsApp number
        $no_wa = preg_replace('/^0/', '62', $this->umkms->no_wa);

        return view('livewire.detailumkm', [
            'umkm' => $this->umkms,
            'photos' => $this->photos,
            'no_wa' => $no_wa,
            'recentUmkmHistory' => $this->recentUmkmHistory, // Pass to the view
        ])->layout('layouts.app');
    }
}
