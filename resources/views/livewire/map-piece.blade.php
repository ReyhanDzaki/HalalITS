<div>
    <div id="map"></div>

    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLgptF_i32WYWQ2ECtkJqtEoLcyi3GVDk"></script>
    <script>
        let map;
        let kmlLayer; // Declare kmlLayer in the global scope

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -7.2756195,
                    lng: 112.7126837
                }, // Center the map on a general location
                zoom: 12,
                mapTypeId: 'terrain',
                styles: [{
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "poi",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "transit",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    }
                ]
            });

            // Load the KML layer
            addKmlLayer('{{ $kmlUrl }}');

        }

        function addKmlLayer(url) {
            // Remove any existing KML layer
            // if (kmlLayer) {
            //     kmlLayer.setMap(null);
            // }
            console.log("{{ $url }}", url);

            // Create a new KML layer
            kmlLayer = new google.maps.KmlLayer({
                url: "https://docs.google.com/uc?id=1IJsXapCUACmK5PTTIZU8gJy8RIRq9Qht&amp;export=kml",
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
