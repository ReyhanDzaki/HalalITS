<section>
    <div>
        <form wire:submit.prevent="search">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 md:left-0 -left-12 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 md:ml-0 ml-12 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live="search" type="text" id="default-search"
                    class="block md:min-w-[40rem] w-[20rem] md:w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari umkm mu disini.." required />
                <button wire:click="toList"
                    class="text-white absolute right-2.5 bottom-2.5 bg-gray-800 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form><br>
    </div>



    @if ($umkms)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 justify-center md:justify-start">
            @foreach ($umkms as $umkm)
                <div
                    class="max-w-sm md:my-6 px-1 pt-3 md:p-6 bg-white border grid grid-cols-1 border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ route('binaan.detail', $umkm->no_umkm) }}">
                        <h5 class="mb-2 text-md md:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $umkm->nama_umkm }}</h5>
                    </a>
                    <p class="mb-3 font-normal md:text-normal text-sm text-gray-700 dark:text-gray-400"><span class="hidden md:visible">Kami menyediakan</span>
                        {{ $umkm->nama_produk }}</p>
                    <a href="{{ route('binaan.detail', $umkm->no_umkm) }}"
                        class="md:inline-flex items-center p-2 md:px-3 md:py-2 md:visible hidden text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Read more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-sm font-semibold text-gray-400">Tidak Ditemukan!</p>
    @endif
</section>
