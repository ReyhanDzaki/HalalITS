<div>
    <div id="map" style="height: 500px;"></div>

    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLgptF_i32WYWQ2ECtkJqtEoLcyi3GVDk&callback=initMap">
    </script>

    <script>
        let map;
        let kmlUrl = "https://docs.google.com/uc?id=1v40no0GV_nyKngRF4zTGCVKdHD3C3SPO&export=kml";

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -2.5, // Approximate center of Indonesia
                    lng: 118 // Approximate center of Indonesia
                },
                zoom: 5,      // Zoom level to show all of Indonesia
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

            // Load the KML layer directly
            const kmlLayer = new google.maps.KmlLayer({
                url: kmlUrl,
                map: map,
                preserveViewport: true // <--- CHANGED THIS TO TRUE
            });

            // Optional: Listen for KML layer status for debugging
            kmlLayer.addListener('status_changed', function() {
                console.log("KML Status:", kmlLayer.getStatus());
            });
        }
    </script>
</div>
