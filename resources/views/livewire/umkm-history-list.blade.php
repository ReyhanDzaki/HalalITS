<div class="container mx-auto my-8 p-4 bg-gray-50 rounded-lg shadow-md">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Recently Viewed UMKM History</h1>

    @if ($umkmHistory->isEmpty())
        <p class="text-gray-600 text-lg text-center py-8">You haven't viewed any UMKMs yet. Start exploring!</p>
    @else
        <div class="overflow-x-auto rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200 bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            UMKM Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Location
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Viewed At
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Actions</span>
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
                                        <span class="text-gray-500">UMKM Not Found</span>
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
                            <td class="px-6 py-4 whitespace-nowrap items-center text-right text-sm font-medium">
                                <div class="items-center flex justify-end">
                                    @if ($history->umkm)
                                        <a href="{{ route('binaan.detail', ['no_umkm' => $history->umkm->no_umkm]) }}"
                                            class="text-indigo-600 hover:text-indigo-900 mr-4">View Details</a>
                                    @endif
                                    <button type="button" wire:click="deleteHistoryEntry({{ $history->id }})"
                                        wire:confirm="Are you sure you want to delete this history entry?"
                                        class="text-red-600 hover:text-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 p-1 rounded-full hover:bg-red-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span class="sr-only">Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="mt-8">
            {{ $umkmHistory->links() }}
        </div>
    @endif
</div>
