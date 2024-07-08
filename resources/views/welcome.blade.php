<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <title>Halal ITS</title>
    @livewireStyles
    <style>
        html,
        body {
            height: 370px;
            padding: 0;
            margin: 0;
        }

        #map {
            height: 720px;
            width: 1080px;
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
{{-- logic for randoming the cards --}}
@php
    $allIds = App\Models\Umkm::pluck('id')->toArray();

    $randomIds = [];
    while (count($randomIds) < 4 && count($allIds) > 0) {
        $randomKey = array_rand($allIds);
        $randomId = $allIds[$randomKey];
        if (!in_array($randomId, $randomIds)) {
            $randomIds[] = $randomId;
        }
        unset($allIds[$randomKey]);
    }
@endphp

<body class="bg-gray-100">
    <div class="">
        <div class="md:mt-20 mt-4">
            @livewire('header')
        </div>
        <div class="flex flex-col justify-center md:gap-12">
            <div class="flex flex-row justify-center">
                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1BYA1-9CRrR9grEdmn5A128fd00RLF4I&ehbc=2E312F"
                    width="640" height="480"></iframe>
                <div class="md:w-full w-full" id="map"></div>
                <div id="capture"></div>
            </div>
            <div class="md:mx-12 mb-8 flex flex-col md:gap-12 gap-4 items-center justify-center">
                <div>
                    <section class=" my-6 dark:bg-gray-900">
                        <div class="px-4 mx-auto max-w-screen-xl text-center">
                            <h1
                                class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                                Kami percaya Anda untuk ikut serta halal!</h1>
                            <p
                                class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-400">
                                Bersama Halal ITS Anda bisa menjelajahi aktivitas-aktivitas halal yang akan memukau
                                anda!</p>
                        </div>
                    </section>
                </div>
                <div class="text-left">
                    @livewire('search-umkm')
                </div>

                <div class="flex flex-row gap-3">
                    <span class="flex w-3 h-3 me-3 bg-gray-200 rounded-full"></span>
                    <span class="flex w-3 h-3 me-3 bg-gray-900 rounded-full dark:bg-gray-700"></span>
                    <span class="flex w-3 h-3 me-3 bg-blue-600 rounded-full"></span>
                    <span class="flex w-3 h-3 me-3 bg-green-500 rounded-full"></span>
                    <span class="flex w-3 h-3 me-3 bg-red-500 rounded-full"></span>
                    <span class="flex w-3 h-3 me-3 bg-purple-500 rounded-full"></span>
                    <span class="flex w-3 h-3 me-3 bg-indigo-500 rounded-full"></span>
                    <span class="flex w-3 h-3 me-3 bg-yellow-300 rounded-full"></span>
                    <span class="flex w-3 h-3 me-3 bg-teal-500 rounded-full"></span>

                </div>
                @livewire('trusted-by')
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-12">
                    @foreach ($randomIds as $id)
                        @php $umkm = App\Models\Umkm::find($id); @endphp
                        <livewire:card :umkm="$umkm" />
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-12">
            @livewire('footer')
        </div>
    </div>
    @livewireScripts
</body>
<script>
    var map;
    var src = 'https://developers.google.com/maps/documentation/javascript/examples/kml/westcampus.kml';

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
        });
    }
</script>
<script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTbWGJvHGcMO0cuqU__Mb5Voqo6Lw16nI&callback=initMap"></script>

</html>
