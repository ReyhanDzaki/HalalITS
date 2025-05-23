<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UmkmHistory; // Import the UmkmHistory model
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Livewire\WithPagination; // Import WithPagination trait for pagination

class UmkmHistoryList extends Component
{
    use WithPagination; // Use the pagination trait

    public $perPage = 10; // Number of history items per page

    /**`
     * Renders the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $umkmHistory = collect(); // Initialize as an empty collection

        if (Auth::check()) {
            $user = Auth::user();

            // Fetch the authenticated user's UMKM viewing history
            // Eager load the 'umkm' relationship to avoid N+1 queries
            // Order by the most recently opened and paginate the results
            $umkmHistory = UmkmHistory::where('user_id', $user->id)->with('umkm')->orderByDesc('opened_at')->paginate($this->perPage);
        }

        // The component's view will now be rendered without an explicit layout
        return view('livewire.umkm-history-list', [
            'umkmHistory' => $umkmHistory,
        ])->layout('layouts.app');
    }

    public function deleteHistoryEntry($historyId)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Find the history entry and ensure it belongs to the authenticated user
            $historyEntry = UmkmHistory::where('id', $historyId)->where('user_id', $user->id)->first();

            if ($historyEntry) {
                $historyEntry->delete();
                // Livewire's reactivity will automatically remove the row from the UI
                // No need for session flashes or gotoPage(1) for a "drop row" effect.
            }
        }
    }
}
