<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>KML Click Capture Sample</title>
    <style>
      html, body {
        height: 370px;
        padding: 0;
        margin: 0;
        }
      #map {
       height: 1060px;
       width: 1000px;
       overflow: hidden;
       float: left;
       border: thin solid #333;
       }
      #capture {
       height: 360px;
       width: 480px;
       overflow: hidden;
       float: left;
       background-color: #ECECFB;
       border: thin solid #333;
       border-left: none;
       }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      var map;
      var src = '';

      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(-19.257753, 146.823688),
          zoom: 2,
          mapTypeId: 'terrain'
        });

        var kmlLayer = new google.maps.KmlLayer(src, {
          suppressInfoWindows: true,
          preserveViewport: false,
          map: map
        });
        kmlLayer.addListener('click', function(event) {
          var content = event.featureData.infoWindowHtml;
          var testimonial = document.getElementById('capture');
          testimonial.innerHTML = content;

          console.log(kmlLayer.getStatus());
        });



      }
    </script>
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLgptF_i32WYWQ2ECtkJqtEoLcyi3GVDk&callback=initMap">
    </script>
  </body>
</html>
