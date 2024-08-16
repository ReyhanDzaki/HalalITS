<div class="mx-12">
    <!-- Flash Message for Success -->
    @if (session()->has('message'))
        <div class="bg-green-500 text-white px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Button to Create a New UMKM -->
    <div class="mb-4">
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
                <th class="px-4 py-2 border border-gray-300">Nama Pemilik</th>
                <th class="px-4 py-2 border border-gray-300">No. WA</th>
                <th class="px-4 py-2 border border-gray-300">Alamat</th>
                <th class="px-4 py-2 border border-gray-300">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($umkms as $umkm)
                <tr>
                    <td class="border px-4 py-2">{{ $umkm->nama_pemilik }}</td>
                    <td class="border px-4 py-2">{{ $umkm->no_wa }}</td>
                    <td class="border px-4 py-2">{{ $umkm->alamat }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $umkm->id }})"
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
