<div>
    <div id="map" style="height: 500px;"></div>

    <!-- Load the required libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/markerclustererplus/2.1.4/markerclusterer.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLgptF_i32WYWQ2ECtkJqtEoLcyi3GVDk&libraries=geometry&callback=initMap"></script>

    <script>
        let map;
        let markers = []; // Array to hold all markers
        let markerCluster; // MarkerClusterer instance
        let kmlUrl = "https://docs.google.com/uc?id=1IJsXapCUACmK5PTTIZU8gJy8RIRq9Qht&export=kml";

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -7.2756195,
                    lng: 112.7126837
                },
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

            // First, load the KML layer to ensure the data is loaded correctly
            const kmlLayer = new google.maps.KmlLayer({
                url: kmlUrl,
                map: map,
                preserveViewport: false
            });

            // Listen for KML layer load to extract marker data
            kmlLayer.addListener('status_changed', function() {
                console.log("KML Status:", kmlLayer.getStatus());

                if (kmlLayer.getStatus() === 'OK') {
                    // Once the KML layer is loaded, extract data and create clusterable markers
                    setTimeout(function() {
                        extractKMLMarkers(kmlLayer);
                    }, 1000); // Give it a moment to render
                }
            });
        }

        function extractKMLMarkers(kmlLayer) {
            // First, hide the original KML layer
            kmlLayer.setMap(null);

            // Use the Google Maps Data Layer to load the KML
            const dataLayer = new google.maps.Data();
            dataLayer.loadGeoJson('https://maps.googleapis.com/maps/api/kml/parser?https://docs.google.com/uc?id=1IJsXapCUACmK5PTTIZU8gJy8RIRq9Qht%26export=kml');

            // Process each feature in the data layer
            dataLayer.forEach(function(feature) {
                const geometry = feature.getGeometry();
                if (geometry) {
                    geometry.forEachLatLng(function(latLng) {
                        // Create a marker for each point
                        const marker = new google.maps.Marker({
                            position: latLng,
                            map: map,
                            title: feature.getProperty('name') || "Location"
                        });

                        // Add info window with properties if available
                        const infoWindow = new google.maps.InfoWindow({
                            content: createInfoContent(feature)
                        });

                        marker.addListener('click', function() {
                            infoWindow.open(map, marker);
                        });

                        // Add to markers array
                        markers.push(marker);
                    });
                }
            });

            // After processing, create the marker clusterer
            createMarkerClusterer();

            // Remove the data layer as we've extracted what we need
            dataLayer.setMap(null);
        }

        function createInfoContent(feature) {
            const name = feature.getProperty('name') || "Unnamed Location";
            const description = feature.getProperty('description') || "";

            return `<div>
                <strong>${name}</strong>
                <div>${description}</div>
            </div>`;
        }

        function createMarkerClusterer() {
            // If we have markers, create a clusterer
            if (markers.length > 0) {
                markerCluster = new MarkerClusterer(map, markers, {
                    imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m',
                    maxZoom: 14, // Adjust this value to control when clustering appears
                    gridSize: 50  // Adjust this value to control cluster size
                });

                console.log("Created marker clusterer with", markers.length, "markers");
            } else {
                console.warn("No markers found to cluster");

                // As a fallback, let's try the simpler approach - just show the KML layer
                fallbackToSimpleKML();
            }
        }

        function fallbackToSimpleKML() {
            // As a fallback, we'll implement a simple KML layer with a custom overlay for clusters
            const kmlLayer = new google.maps.KmlLayer({
                url: kmlUrl,
                map: map,
                preserveViewport: false
            });

            // Listen for zoom changes to potentially show cluster overlay
            map.addListener('zoom_changed', function() {
                const zoom = map.getZoom();
                if (zoom <= 11) { // City level zoom
                    // Here we'd ideally count points in view and display a summary
                    // But for simplicity in this fallback, we just show an approximate count
                    showApproximateCount();
                }
            });
        }

        function showApproximateCount() {
            // This is a simplified approach for the fallback
            // In a real implementation, you would calculate actual visible points
            const overlay = new google.maps.OverlayView();

            overlay.onAdd = function() {
                const div = document.createElement('div');
                div.style.position = 'absolute';
                div.style.backgroundColor = 'rgba(255, 0, 0, 0.8)';
                div.style.borderRadius = '50%';
                div.style.width = '60px';
                div.style.height = '60px';
                div.style.textAlign = 'center';
                div.style.lineHeight = '60px';
                div.style.color = 'white';
                div.style.fontWeight = 'bold';
                div.style.fontSize = '18px';
                div.innerHTML = '~20';  // Approximate count

                this.div_ = div;
                const panes = this.getPanes();
                panes.overlayLayer.appendChild(div);
            };

            overlay.draw = function() {
                const projection = this.getProjection();
                const center = map.getCenter();
                const point = projection.fromLatLngToDivPixel(center);

                this.div_.style.left = (point.x - 30) + 'px';
                this.div_.style.top = (point.y - 30) + 'px';
            };

            overlay.setMap(map);
        }
    </script>
</div>
