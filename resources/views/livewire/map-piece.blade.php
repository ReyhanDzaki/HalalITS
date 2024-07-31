<div>
    <div id="map" class="w-max"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key="></script>
    <script>
        let map;
        let kmlLayer; // Declare kmlLayer in the global scope

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -6.2, lng: 106.8 }, // Center the map on a general location
                zoom: 8,
                styles: [
                    {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [
                            { "visibility": "off" }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "stylers": [
                            { "visibility": "off" }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                            { "visibility": "off" }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "stylers": [
                            { "visibility": "off" }
                        ]
                    }
                ]
            });

            // Load the KML layer
            addKmlLayer('{{ $kmlUrl }}');

        }

        function addKmlLayer(url) {
            // Remove any existing KML layer
            if (kmlLayer) {
                kmlLayer.setMap(null);
            }
            console.log(url);

            // Create a new KML layer
            kmlLayer = new google.maps.KmlLayer({
                url: "http://api.flickr.com/services/feeds/geo/?g=322338@N20&lang=en-us&format=feed-georss",
                map: map,
                suppressInfoWindows: false,
                preserveViewport: false,
                screenOverlays: true
            });

            // Add a status listener to handle errors
            kmlLayer.addListener('status_changed', function() {
                if (kmlLayer.getStatus() !== 'OK') {
                    console.error('KML Layer status:', kmlLayer.getStatus());
                }
            });
        }

        // Initialize the map when the window loads
        window.onload = initMap;
    </script>

</div>
