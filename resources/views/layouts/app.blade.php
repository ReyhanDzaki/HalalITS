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
            @livewire('header')
            <div class="py-24">
             {{ $slot }}
             </div>
            @livewire('footer')
        </div>
    </div>
    @livewireScripts

    @livewireScripts
</body>

</html>
