<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Umkm;
use Illuminate\Support\Facades\Storage;

class MapPiece extends Component
{
    public $kmlUrl;
    public $url;

    public function mount()
    {
        $this->generateKML();
    }

    public function generateKML()
    {
        $locations = Umkm::all();
        $kml = $this->createKML($locations);

        $kmlPath = 'kml/locations.kml';
        Storage::disk('public')->put($kmlPath, $kml);

        $this->kmlUrl = Storage::url($kmlPath);
        $this->url = asset('storage/' . $kmlPath);
    }

    private function createKML($locations)
    {
        // Initialize the KML string with the XML declaration and KML structure
        $kml = '<?xml version="1.0" encoding="UTF-8"?>';
        $kml .= '<kml xmlns="http://www.opengis.net/kml/2.2">';
        $kml .= '<Document>';

        // Check if locations are present
        if ($locations->isEmpty()) {
            // Optionally, add a placemark indicating no data available
            $kml .= '<Placemark>';
            $kml .= '<name>No Locations Available</name>';
            $kml .= '<description>No data available for this map.</description>';
            $kml .= '<Point>';
            $kml .= '<coordinates>0,0</coordinates>'; // Default coordinates
            $kml .= '</Point>';
            $kml .= '</Placemark>';
        } else {
            // Loop through each location and add to KML
            foreach ($locations as $location) {
                if (!empty($location->latitude) && !empty($location->longitude)) { // Ensure coordinates are not empty
                    $kml .= '<Placemark>';
                    $kml .= '<name>' . htmlspecialchars($location->nama_umkm) . '</name>';
                    $kml .= '<description>' . htmlspecialchars($location->alamat) . '</description>';
                    $kml .= '<Point>';
                    $kml .= '<coordinates>' . $location->longitude . ',' . $location->latitude . '</coordinates>';
                    $kml .= '</Point>';
                    $kml .= '</Placemark>';
                }
            }
        }

        // Close the KML structure
        $kml .= '</Document>';
        $kml .= '</kml>';

        return $kml;
    }
}
