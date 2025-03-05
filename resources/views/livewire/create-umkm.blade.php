<div class="fixed inset-0 flex items-center justify-center z-10 bg-black bg-opacity-50">
    <div class="bg-white shadow-xl transform rounded-xl transition-all max-w-lg w-full">
        <form>
            <div class="px-4 py-5 grid grid-cols-2 gap-3 rounded-xl bg-white">
                <div class="mb-4">
                    <label for="no_umkm" class="block text-gray-700 text-sm font-bold mb-2">No UMKM:</label>
                    <input type="text" id="no_umkm" wire:model="no_umkm"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="No UMKM">
                    @error('no_umkm')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_pemilik" class="block text-gray-700 text-sm font-bold mb-2">Nama Pemilik:</label>
                    <input type="text" id="nama_pemilik" wire:model="nama_pemilik"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Nama Pemilik">
                    @error('nama_pemilik')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_umkm" class="block text-gray-700 text-sm font-bold mb-2">Nama UMKM:</label>
                    <input type="text" id="nama_umkm" wire:model="nama_umkm"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Nama UMKM" required>
                    @error('nama_umkm')
                        <span class="text-red-400">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="nama_produk" class="block text-gray-700 text-sm font-bold mb-2">Nama Produk:</label>
                    <input type="text" id="nama_produk" wire:model="nama_produk"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Nama Produk">
                </div>


                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700 text-sm font-bold mb-2">Alamat:</label>
                    <input type="text" id="alamat" wire:model="alamat"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Alamat">
                </div>

                {{-- <div class="mb-4">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image:</label>
                    <input type="file" id="image" wire:model="image"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Image">
                </div> NOTE: Optional Image --}}

                <div class="mb-4">
                    <label for="no_wa" class="block text-gray-700 text-sm font-bold mb-2">No WA:</label>
                    <input type="text" id="no_wa" wire:model="no_wa"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="No WA">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" wire:model="email"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Email">
                </div>

                <div class="mb-4">
                    <label for="sertifikat_halal" class="block text-gray-700 text-sm font-bold mb-2">Sertifikat
                        Halal:</label>
                    <input type="text" id="sertifikat_halal" wire:model="sertifikat_halal"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="sertifikat_halal">
                </div>

                <div class="mb-4">
                    <label for="latitude" class="block text-gray-700 text-sm font-bold mb-2">Latitude:</label>
                    <input type="text" id="latitude" wire:model="latitude"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Latitude">
                </div>

                <div class="mb-4">
                    <label for="longitude" class="block text-gray-700 text-sm font-bold mb-2">Longitude:</label>
                    <input type="text" id="longitude" wire:model="longitude"
                        class="shadow-sm border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-label="Longitude">
                </div>

                {{-- <div>
                    <button type="button" wire:click="addPhotoField">Add Photo</button>
                </div> --}}

                @foreach ($newPhotos as $index => $photo)
                    <div>
                        <label for="photo_{{ $index }}">Upload Photo</label>
                        <input type="file" id="photo_{{ $index }}" wire:model="newPhotos.{{ $index }}">
                        <input type="text" wire:model="newPhotoDescriptions.{{ $index }}"
                            placeholder="Description">

                        @error("newPhotos.$index")
                            <span class="error">{{ $message }}</span>
                        @enderror
                        @error("newPhotoDescriptions.$index")
                            <span class="error">{{ $message }}</span>
                        @enderror

                        <button type="button" wire:click="removePhotoField({{ $index }})">Remove</button>
                    </div>
                @endforeach
                <!-- Add more fields as needed -->
            </div>
            <div class="bg-gray-50 px-4 py-3 flex justify-end rounded-b-xl">
                <button wire:click="store()" type="button"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 mr-2">
                    Save
                </button>
                <button wire:click="closeModal()" type="button"
                    class="bg-white hover:bg-gray-100 text-gray-700 border border-gray-300 font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
