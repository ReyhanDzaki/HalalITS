<div class="mx-auto px-4 sm:px-6 lg:px-8 mt-4 md:mt-8">
    @if (session()->has('message'))
        <div class="bg-green-500 text-white px-4 py-3 rounded-lg relative mb-4" role="alert">
            <span class="block sm:inline text-sm sm:text-base">{{ session('message') }}</span>
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 space-y-3 md:space-y-0">
        <div class="w-full md:w-auto">
            <form>
                <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" id="default-search"
                        class="block w-full p-3 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cari UMKMmu disini.." required />
                </div>
            </form>
        </div>

        <div class="w-full md:w-auto">
            <button wire:click="create()" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out">
                Buat UMKM Baru
            </button>
        </div>
    </div>

    @if ($isModalOpen)
        @include('livewire.create-umkm')
    @endif

    <div class="hidden md:block overflow-x-auto rounded-lg shadow-md mb-6">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama UMKM</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama Pemilik</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">No. WA</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Alamat</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Dibuat Oleh</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($umkms as $umkm)
                    <tr>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $umkm->nama_umkm }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ $umkm->nama_pemilik }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ $umkm->no_wa }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ Str::limit($umkm->alamat, 60) }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">{{ $umkm->created_by }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <button onclick="window.location.href='/binaan/edit/{{ $umkm->no_umkm }}'"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1.5 px-3 rounded text-xs mr-2 transition duration-200 ease-in-out">
                                Edit
                            </button>
                            <button wire:click="delete({{ $umkm->id }})"
                                wire:confirm="Anda yakin ingin menghapus UMKM ini?"
                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-1.5 px-3 rounded text-xs transition duration-200 ease-in-out">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="md:hidden space-y-4 mb-6">
        @foreach ($umkms as $umkm)
            <div class="bg-white p-4 rounded-lg shadow-md border border-gray-200">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $umkm->nama_umkm }}</h3>
                    <div class="flex space-x-2">
                        <button onclick="window.location.href='/binaan/edit/{{ $umkm->no_umkm }}'"
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1.5 px-3 rounded text-xs transition duration-200 ease-in-out">
                            Edit
                        </button>
                        <button wire:click="delete({{ $umkm->id }})"
                            wire:confirm="Anda yakin ingin menghapus UMKM ini?"
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1.5 px-3 rounded text-xs transition duration-200 ease-in-out">
                            Hapus
                        </button>
                    </div>
                </div>
                <p class="text-sm text-gray-700 mb-1"><span class="font-medium">Pemilik:</span> {{ $umkm->nama_pemilik }}</p>
                <p class="text-sm text-gray-700 mb-1"><span class="font-medium">No. WA:</span> {{ $umkm->no_wa }}</p>
                <p class="text-sm text-gray-700 mb-1"><span class="font-medium">Alamat:</span> {{ $umkm->alamat }}</p>
                <p class="text-xs text-gray-500"><span class="font-medium">Dibuat Oleh:</span> {{ $umkm->created_by }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $umkms->links() }}
    </div>
</div>
