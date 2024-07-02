<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ mix('resources/css/app.css') }}">
    <title>Laravel</title>
    @livewireStyles
</head>

<body>
    <div class="">
        <div class="md:mt-20 mt-4">
            @livewire('header')
        </div>
        <div class="flex flex-col justify-center md:gap-12">
            @livewire('carousel')
            <div class="md:mx-12 mb-8 flex flex-col md:flex-row md:gap-24 gap-4 items-center justify-center">

            </div>
        </div>
        <div class="mt-12">
            @livewire('footer')
        </div>
    </div>
    @livewireScripts
</body>

</html>
