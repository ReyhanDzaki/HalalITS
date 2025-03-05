<div class="mx-12 mt-2">
    <!-- Flash Message for Success -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <div>
        <div>
            <form>
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" id="default-search"
                        class="block md:w-[32rem] w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Cari umkm mu disini.." required />

                </div>
            </form><br>
        </div>
    </div>
    <!-- Button to Create a New UMKM -->
    <div class="mb-4 pt-1">
        <button wire:click="create()" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
            Create New UMKM
        </button>
    </div>

    <!-- Modal for Creating/Editing UMKM -->
    @if ($isModalOpen)
        @include('livewire.create-umkm')
    @endif

    <!-- Table for Displaying UMKM Data -->
    <table class="table-fixed w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 border border-gray-300">Nama UMKM</th>
                <th class="px-4 py-2 border border-gray-300">Nama Pemilik</th>
                <th class="px-4 py-2 border border-gray-300">No. WA</th>
                <th class="px-4 py-2 border border-gray-300">Alamat</th>
                <th class="px-4 py-2 border border-gray-300">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($umkms as $umkm)
                <tr>
                    <td class="border px-4 py-2">{{ $umkm->nama_umkm }}</td>
                    <td class="border px-4 py-2">{{ $umkm->nama_pemilik }}</td>
                    <td class="border px-4 py-2">{{ $umkm->no_wa }}</td>
                    <td class="border px-4 py-2">{{ $umkm->alamat }}</td>
                    <td class="border px-4 py-2">
                        <button onclick="window.location.href='/binaan/edit/{{ $umkm->no_umkm }}'"
                            class="bg-green-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </button>

                        <button wire:click="delete({{ $umkm->id }})"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $umkms->links() }}
    </div>
</div>
