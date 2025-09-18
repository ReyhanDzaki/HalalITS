<div class="container mx-auto my-8 p-4 bg-gray-50 rounded-lg shadow-md">
    <h1 class="md:text-3xl text-lg font-bold text-gray-800 mb-6 text-center md:text-left">Riwayat UMKM yang Baru Saja Dilihat</h1>

    @if ($umkmHistory->isEmpty())
        <p class="text-gray-600 text-sm md:text-lg text-center py-8">Anda belum melihat UMKM apapun. Mulai jelajahi sekarang!</p>
    @else
        <div class="overflow-x-auto rounded-lg shadow-md hidden md:block">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama UMKM
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Lokasi
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Dilihat Pada
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Aksi</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($umkmHistory as $history)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    @if ($history->umkm)
                                        <a href="{{ route('binaan.detail', ['no_umkm' => $history->umkm->no_umkm]) }}"
                                            class="text-blue-600 hover:text-blue-800 hover:underline">
                                            {{ $history->umkm->nama_umkm }}
                                        </a>
                                    @else
                                        <span class="text-gray-500">UMKM Tidak Ditemukan</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    @if ($history->umkm)
                                        {{ Str::limit($history->umkm->alamat, 50) }}
                                    @else
                                        N/A
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">
                                    {{ $history->opened_at->format('M d, Y H:i') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    ({{ $history->opened_at->diffForHumans() }})
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-4">
                                    @if ($history->umkm)
                                        <a href="{{ route('binaan.detail', ['no_umkm' => $history->umkm->no_umkm]) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Lihat Detail</a>
                                    @endif
                                    <button type="button" wire:click="deleteHistoryEntry({{ $history->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menghapus entri riwayat ini?"
                                        class="text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 p-1 rounded-full hover:bg-red-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="sr-only">Hapus</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="md:hidden space-y-4">
            @foreach ($umkmHistory as $history)
                <div class="bg-white p-4 rounded-lg shadow-md flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <svg class="h-8 w-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8zM12 9c-1.654 0-3 1.346-3 3s1.346 3 3 3 3-1.346 3-3-1.346-3-3-3z"/>
                        </svg>
                    </div>
                    <div class="flex-grow">
                        <div class="text-lg font-semibold text-gray-900">
                            @if ($history->umkm)
                                <a href="{{ route('binaan.detail', ['no_umkm' => $history->umkm->no_umkm]) }}"
                                    class="text-blue-600 hover:text-blue-800 hover:underline">
                                    {{ $history->umkm->nama_umkm }}
                                </a>
                            @else
                                <span class="text-gray-500">UMKM Tidak Ditemukan</span>
                            @endif
                        </div>
                        <div class="text-sm text-gray-700 mt-1">
                            @if ($history->umkm)
                                <span class="font-medium">Lokasi:</span> {{ Str::limit($history->umkm->alamat, 50) }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="text-sm text-gray-600">
                            <span class="font-medium">Dilihat:</span> {{ $history->opened_at->format('M d, Y H:i') }} ({{ $history->opened_at->diffForHumans() }})
                        </div>
                        <div class="flex justify-end mt-3 space-x-3">
                            @if ($history->umkm)
                                <a href="{{ route('binaan.detail', ['no_umkm' => $history->umkm->no_umkm]) }}"
                                    class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">Lihat Detail</a>
                            @endif
                            <button type="button" wire:click="deleteHistoryEntry({{ $history->id }})"
                                wire:confirm="Apakah Anda yakin ingin menghapus entri riwayat ini?"
                                class="text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 p-1 rounded-full hover:bg-red-100 flex items-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="sr-only">Hapus</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination Links --}}
        <div class="mt-8">
            {{ $umkmHistory->links() }}
        </div>
    @endif
</div>
