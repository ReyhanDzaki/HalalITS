<div class="p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-medium">Edit UMKM {{ $nama_umkm }}</h1>
    <hr class="h-1 mx-auto my-1 bg-gray-300 border-0 rounded-sm md:my-4 dark:bg-gray-700">

    <div class="grid grid-cols-2 gap-3">
        <div>
            <form wire:submit.prevent="update" enctype="multipart/form-data">
                <h1 class="text-2xl font-medium">Personal Information</h1>
                <div class="mb-4">
                    <label for="nama_umkm" class="block text-gray-700">Nama UMKM</label>
                    <input type="text" id="nama_umkm" wire:model="nama_umkm"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="{{ $nama_umkm }}">
                    @error('nama_umkm')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700">Alamat</label>
                    <input type="text" id="alamat" wire:model="alamat"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="{{ $alamat }}">
                    @error('alamat')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_pemilik" class="block text-gray-700">Nama Pemilik</label>
                    <input type="text" id="nama_pemilik" wire:model="nama_pemilik"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="{{ $nama_pemilik }}">
                    @error('nama_pemilik')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_produk" class="block text-gray-700">Nama Produk</label>
                    <input type="text" id="nama_produk" wire:model="nama_produk"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="{{ $nama_produk }}">
                    @error('nama_produk')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
        </div>
        <div>
            <h1 class="text-2xl font-medium">Social Media Information</h1>

            <div class="mb-4">
                <label for="facebook" class="block text-gray-700">Facebook</label>
                <input type="text" id="facebook" wire:model="facebook"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ $facebook }}">
                @error('nama_produk')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="instagram" class="block text-gray-700">Instagram</label>
                <input type="text" id="instagram" wire:model="instagram"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ $instagram }}">
                @error('nama_produk')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tokopedia" class="block text-gray-700">Tokopedia</label>
                <input type="text" id="tokopedia" wire:model="tokopedia"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ $tokopedia }}">
                @error('nama_produk')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="shopee" class="block text-gray-700">Shopee</label>
                <input type="text" id="shopee" wire:model="shopee"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    value="{{ $shopee }}">
                @error('nama_produk')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

        </div>
    </div>
    <div wire:key="{{ rand() }} class="p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-2xl font-medium">Halal Code</h1>
        <div class="mb-4">
            <label for="halalCode" class="block text-gray-700">Sertifikat Halal</label>
            @foreach ($halalCode as $index => $code)
                <div class="flex items-center space-x-2 mb-2">
                    <input type="text" id="halalCode{{ $index }}" wire:model="halalCode.{{ $index }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        value="{{ $code }}">
                    <button type="button" wire:click="removeCode({{ $index }})"
                        class="text-red-500">Remove</button>
                </div>
            @endforeach
            <button type="button" wire:click="addCode" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md">Add
                Code</button>
        </div>

        <h1 class="text-2xl font-medium">Edit Map</h1>
        <!-- Map -->
        <div x-data="{
            map: null,
            latitude: @entangle('latitude'),
            longitude: @entangle('longitude'),
            init() {
                this.map = L.map(this.$refs.map).setView([this.latitude, this.longitude], 13);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href=\'http://www.openstreetmap.org/copyright\'>OpenStreetMap</a>',
                }).addTo(this.map);

                const marker = L.marker([this.latitude, this.longitude]).addTo(this.map);

                this.map.on('click', (e) => {
                    const lat = e.latlng.lat;
                    const lng = e.latlng.lng;
                    marker.setLatLng([lat, lng]);

                    // Update Alpine state
                    this.latitude = lat;
                    this.longitude = lng;

                    // Use Livewire's entangle to automatically sync
                    @this.latitude = lat;
                    @this.longitude = lng;
                });
            }
        }" x-init="init" x-ref="map">
            <div class="z-0" style="height: 400px;"></div>
        </div>

        <!-- Coordinates (Hidden or Visible for Debugging) -->
        <div class="">
            <input type="" id="latitude" wire:model="latitude">
            <input type="" id="longitude" wire:model="longitude">
        </div>
    </div>


    <div class="mb-4">
        <label for="no_wa" class="block text-gray-700">WhatsApp Number</label>
        <input type="text" id="no_wa" wire:model="no_wa"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
            value="{{ $no_wa }}">
    </div>
    <div class="mb-4">
        <h1 class="block text-2xl text-gray-700 mb-4">Existing Photos</h1>
        <div class="grid grid-cols-3">
            @foreach ($existingPhotos as $photo)
                <div class="mb-2 flex items-center space-x-4">
                    <img src="{{ asset('storage/' . $photo->photo) }}" alt="Photo"
                        class="w-32 h-32 object-cover">
                    <div>
                        <textarea wire:model="photoDescriptions.{{ $photo->id }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $photo->description }}</textarea>
                        <button type="button" wire:click="removePhotoField({{ $loop->index }})"
                            class="text-red-500">Remove</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700">Add New Photos</label>
        @foreach ($photos as $index => $photo)
            <div class="mb-2 flex items-center space-x-4">
                <input type="file" wire:model="photos.{{ $index }}"
                    class="border-gray-300 rounded-md shadow-sm">
                <input type="text" wire:model="photoDescriptions.{{ $index }}"
                    placeholder="Photo description" class="border-gray-300 rounded-md shadow-sm">
                {{-- <button type="button"
                        onclick="if(confirm('Are you sure you want to remove this photo?')) @this.removePhotoField({{ $index }})"
                        class="text-red-500">Remove</button> --}}
            </div>
        @endforeach
        <button type="button" wire:click="addPhotoField"
            class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md">Add Photo Field</button>
    </div>


    <div x-data="{ modalIsOpen: false }">
        <button type="submit" @click="modalIsOpen = true"
            class="bg-indigo-600 text-white px-4 py-2 rounded-md">Update UMKM</button>
        <a href="javascript:history.back()" class="bg-orange-600 text-white px-4 py-2 rounded-md">Back</a>

        {{-- <button @click="modalIsOpen = true" type="button"
                class="cursor-pointer whitespace-nowrap rounded-xl bg-blue-700 px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Open
                Modal</button> --}}
        <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen"
            @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false"
            class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8"
            role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
            <!-- Modal Dialog -->
            <div x-show="modalIsOpen"
                x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity"
                x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-xl border border-slate-300 bg-white text-slate-700 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-300">
                <!-- Dialog Header -->
                <div
                    class="flex items-center justify-between border-b border-slate-300 bg-slate-100/60 p-4 dark:border-slate-700 dark:bg-slate-900/20">
                    <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-black dark:text-white">
                        Notice!</h3>
                    <button @click="modalIsOpen = false" aria-label="close modal">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                            stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Dialog Body -->
                @if (session()->has('message'))
                    <div class="mb-4 px-4 py-6 text-green-600">
                        {{ session('message') }}
                    </div>
                @endif
                <!-- Dialog Footer -->
                <div
                    class="flex flex-col-reverse justify-between gap-2 border-t border-slate-300 bg-slate-100/60 p-4 dark:border-slate-700 dark:bg-slate-900/20 sm:flex-row sm:items-center md:justify-end">
                    <a href="{{ route('binaan.detail', $umkms->no_umkm) }}"
                        class="bg-gray-600 text-white px-4 py-2 rounded-md">Back</a>
                    {{-- <button @click="modalIsOpen = false" type="button"
                            class="cursor-pointer whitespace-nowrap rounded-xl bg-blue-700 px-4 py-2 text-center text-sm font-medium tracking-wide text-slate-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-700 active:opacity-100 active:outline-offset-0 dark:bg-blue-600 dark:text-slate-100 dark:focus-visible:outline-blue-600">Upgrade
                            Now</button> --}}
                </div>
            </div>
        </div>
    </div>
    </form>
</div>


@script
@endscript

@assets
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
@endassets
