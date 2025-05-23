<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Umkm;
use App\Models\Photo; // Make sure Photo model is imported

class Card extends Component
{
    public $umkm;
    public $halalCode; // <--- This needs to be declared
    public $pirt;      // <--- This needs to be declared
    public $photos;    // <--- This needs to be declared

    /**
     * Mount the component, receiving the UMKM model instance.
     *
     * @param Umkm $umkm The UMKM model instance to display.
     */
    public function mount(Umkm $umkm)
    {
        // Ensure the UMKM has its photos loaded
        $this->umkm = $umkm->load('photos');

        // Prepare the halalCode, pirt, and photos variables for the view
        // Use null coalescing to handle cases where sertifikat_halal or pirt might be null
        $this->halalCode = $this->umkm->sertifikat_halal ? explode(',', $this->umkm->sertifikat_halal) : [];
        $this->pirt = $this->umkm->pirt ? explode(',', $this->umkm->pirt) : [];
        $this->photos = $this->umkm->photos; // The loaded photos relationship
    }

    /**
     * Render the component view.
     * Public properties are automatically available.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.card');
    }
}
