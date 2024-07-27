<div class="bg-gray-50 flex justify-center">
    <div class="font-sans">
        <div class="p-4 lg:max-w-7xl max-w-2xl max-lg:mx-auto">
            <div class="md:ml-20 :my-2">
                <nav class="md:flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                        <li class="inline-flex items-center">
                            <a href="#"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                                <svg class="me-2.5 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                                <a href="{{ route('binaan.list') }}"
                                    class="ms-1 text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white md:ms-2">Catalog</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-gray-400 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                                <span
                                    class="ms-1 text-sm font-medium text-gray-500 dark:text-gray-400 md:ms-2">{{ $umkm->nama_umkm }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h2 class="mt-3 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">{{ $umkm->nama_umkm }}
                </h2>
            </div>
            <div class="grid items-start grid-cols-1 lg:grid-cols-5 gap-12">
                <div class="lg:col-span-3 w-full lg:sticky top-0 text-center">
                    <div x-data="{ showText: true }">
                        <label class="inline-flex items-center gap-3 cursor-pointer">
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Produk</span>
                            <input type="checkbox" x-model="showText" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                            </div>
                            <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Peta</span>
                        </label>

                        <template x-if="showText">
                            <div class="flex justify-center items-center p-12">
                                <iframe width="3300" height="470" frameborder="1"
                                    src = "https://maps.google.com/maps?q={{ $umkm->latitude }},{{ $umkm->longitude }}&hl=es;z=14&amp;output=embed"></iframe>
                            </div>
                        </template>
                        <template x-if="!showText">
                            <img src="path/to/your/image.jpg" alt="Image" class="w-full">
                        </template>
                    </div>


                </div>

                <div class="lg:col-span-2">
                    <h2 class="text-3xl font-semibold ">{{ $umkm->nama_umkm }}</h2>
                    <div class="flex space-x-2 flex-row items-center text-center mt-1">
                        <span class="w-8"><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M12 12C13.1046 12 14 11.1046 14 10C14 8.89543 13.1046 8 12 8C10.8954 8 10 8.89543 10 10C10 11.1046 10.8954 12 12 12Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </span>
                        <p class="text-gray-600 text-left">{{ $umkm->alamat }}</p>
                    </div>

                    {{-- <div class="flex space-x-2 mt-4">
                        <svg class="w-[18px] fill-yellow-300" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <svg class="w-[18px] fill-yellow-300" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <svg class="w-[18px] fill-yellow-300" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <svg class="w-[18px] fill-yellow-300" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <svg class="w-[18px] fill-[#CED5D8]" viewBox="0 0 14 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                        </svg>
                        <h4 class=" text-base">500 Reviews</h4>
                    </div> --}}

                    {{-- <div class="flex flex-wrap gap-4 mt-8">
                        <p class=" text-4xl font-semibold">$12</p>
                        <p class="text-gray-400 text-base"><strike>$16</strike> <span class="text-sm ml-1">Tax
                                included</span></p>
                    </div> --}}

                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="https://wa.me/{{ $no_wa }}" type="button"
                            class="flex flex-row items-center md:min-w-[200px] min-w-full gap-3 cursor-pointer px-4 py-3 bg-yellow-300 hover:bg-yellow-400 text-black text-md font-semibold rounded">
                            <div class="w-10">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M6.014 8.00613C6.12827 7.1024 7.30277 5.87414 8.23488 6.01043L8.23339 6.00894C9.14051 6.18132 9.85859 7.74261 10.2635 8.44465C10.5504 8.95402 10.3641 9.4701 10.0965 9.68787C9.7355 9.97883 9.17099 10.3803 9.28943 10.7834C9.5 11.5 12 14 13.2296 14.7107C13.695 14.9797 14.0325 14.2702 14.3207 13.9067C14.5301 13.6271 15.0466 13.46 15.5548 13.736C16.3138 14.178 17.0288 14.6917 17.69 15.27C18.0202 15.546 18.0977 15.9539 17.8689 16.385C17.4659 17.1443 16.3003 18.1456 15.4542 17.9421C13.9764 17.5868 8 15.27 6.08033 8.55801C5.97237 8.24048 5.99955 8.12044 6.014 8.00613Z"
                                            fill="#0F0F0F"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 23C10.7764 23 10.0994 22.8687 9 22.5L6.89443 23.5528C5.56462 24.2177 4 23.2507 4 21.7639V19.5C1.84655 17.492 1 15.1767 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12C23 18.0751 18.0751 23 12 23ZM6 18.6303L5.36395 18.0372C3.69087 16.4772 3 14.7331 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21C11.0143 21 10.552 20.911 9.63595 20.6038L8.84847 20.3397L6 21.7639V18.6303Z"
                                            fill="#0F0F0F"></path>
                                    </g>
                                </svg>
                            </div> Kontak Kami!
                        </a>
                        <button type="button"
                            class="md:min-w-[200px] min-w-full px-4 py-2.5 border border-yellow-300 bg-transparent text-yellow-300 text-sm font-semibold rounded">Keranjang?</button>
                    </div>

                    <div class="mt-8">
                        <div id="accordion-nested-parent" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-1">
                                <button type="button"
                                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-black border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                    data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                    aria-controls="accordion-collapse-body-1">
                                    <span>Siapa Pemilik {{ $umkm->nama_umkm }}</span>
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-1" class="hidden"
                                aria-labelledby="accordion-collapse-heading-1">
                                <div
                                    class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                    <p class="mb-2 text-black dark:text-gray-400">UMKM yang dimiliki oleh <span
                                            class="font-bold"> {{ $umkm->nama_pemilik }} </span> berasal dari
                                        {{ $umkm->kota }}, menyediakan <span class="font-bold">
                                            {{ $umkm->nama_produk }} </span> dan
                                        berbagai produk lainya!</p>
                                    {{-- <p class="mb-2 text-black dark:text-gray-400">Check out this guide to learn how
                                        to <a href="/docs/getting-started/introduction/"
                                            class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and
                                        start developing websites even faster with components on top of Tailwind CSS.
                                    </p> --}}
                                </div>
                            </div>
                            <h2 id="accordion-collapse-heading-2">
                                <button type="button"
                                    class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-black border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                    data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
                                    aria-controls="accordion-collapse-body-2">
                                    <span>Apa saja sertifikasi yang dimiliki {{ $umkm->nama_umkm }}?</span>
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </button>
                            </h2>
                            <div id="accordion-collapse-body-2" class="hidden"
                                aria-labelledby="accordion-collapse-heading-2">
                                <div class="p-5 border border-gray-200 dark:border-gray-700">
                                    <p class="mb-4 text-black dark:text-gray-400">Berikut merupakan sertifikasi yang
                                        dimiliki {{ $umkm->nama_umkm }}</p>
                                    <!-- Nested accordion -->
                                    <div id="accordion-nested-collapse" data-accordion="collapse">
                                        <h2 id="accordion-nested-collapse-heading-1">
                                            <button type="button"
                                                class="flex items-center justify-between w-full p-5 rounded-t-xl font-medium rtl:text-right text-black border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                                data-accordion-target="#accordion-nested-collapse-body-1"
                                                aria-expanded="false"
                                                aria-controls="accordion-nested-collapse-body-1">
                                                <span>Halal</span>
                                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                </svg>
                                            </button>
                                        </h2>
                                        <div id="accordion-nested-collapse-body-1" class="hidden"
                                            aria-labelledby="accordion-nested-collapse-heading-1">
                                            <div
                                                class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 flex gap-2 flex-col">
                                                @foreach ($halalCode as $code)
                                                    <a class="hover:underline"
                                                        href="https://bpjph.halal.go.id/search/sertifikat?nama_produk=&nama_pelaku_usaha=&no_sertifikat={{ $code }}&page=1"
                                                        target="_blank">
                                                        <div class="flex flex-row gap-3 items-center">
                                                            <img class="w-6 ring-1 rounded-xl ring-purple-600"
                                                                src="{{ asset('Logo-Halal.png') }}" alt="">
                                                            <p class="font-medium">
                                                                {{ $code }}
                                                            </p>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <h2 id="accordion-nested-collapse-heading-2">
                                            <button type="button"
                                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-black border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                                data-accordion-target="#accordion-nested-collapse-body-2"
                                                aria-expanded="false"
                                                aria-controls="accordion-nested-collapse-body-2">
                                                <span>Pangan Industri Rumah Tangga (PIRT)</span>
                                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                </svg>
                                            </button>
                                        </h2>
                                        <div id="accordion-nested-collapse-body-2" class="hidden"
                                            aria-labelledby="accordion-nested-collapse-heading-2">
                                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                                                <p class="text-black dark:text-gray-400">TODO Tombol Modal (newtab?)
                                                    PDF</p>
                                            </div>
                                        </div>
                                        <h2 id="accordion-nested-collapse-heading-3">
                                            <button type="button"
                                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-black border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                                data-accordion-target="#accordion-nested-collapse-body-3"
                                                aria-expanded="false"
                                                aria-controls="accordion-nested-collapse-body-3">
                                                <span>Bada Pengurus Olahan Makanan (BPOM)</span>
                                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 10 6">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                </svg>
                                            </button>
                                        </h2>
                                        <div id="accordion-nested-collapse-body-3" class="hidden"
                                            aria-labelledby="accordion-nested-collapse-heading-3">
                                            <div class="p-5 border border-gray-200 dark:border-gray-700">
                                                <p class="mb-2 text-black dark:text-gray-400">TODO Tombol Modal
                                                    (newtab?) PDF
                                                </p>
                                                {{-- <p class="mb-2 text-black dark:text-gray-400">Learn more about these
                                                    technologies:</p>
                                                <ul class="ps-5 text-black list-disc dark:text-gray-400">
                                                    <li><a href="https://flowbite.com/pro/"
                                                            class="text-blue-600 dark:text-blue-500 hover:underline">Flowbite
                                                            Pro</a></li>
                                                    <li><a href="https://tailwindui.com/" rel="nofollow"
                                                            class="text-blue-600 dark:text-blue-500 hover:underline">Tailwind
                                                            UI</a></li>
                                                </ul> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: Nested accordion -->
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8">
                        <div class="flex items-start mt-8">
                            <img src="https://readymadeui.com/team-2.webp"
                                class="w-12 h-12 rounded-full border-2 border-white" />

                            <div class="ml-3">
                                <h4 class="text-sm font-semibold ">{{ $umkm->nama_pemilik }}</h4>
                                <div class="flex space-x-1 mt-1">
                                    <svg class="w-4 fill-yellow-300" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-4 fill-yellow-300" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-4 fill-yellow-300" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-4 fill-yellow-300" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <svg class="w-4 fill-yellow-300" viewBox="0 0 14 13" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7 0L9.4687 3.60213L13.6574 4.83688L10.9944 8.29787L11.1145 12.6631L7 11.2L2.8855 12.6631L3.00556 8.29787L0.342604 4.83688L4.5313 3.60213L7 0Z" />
                                    </svg>
                                    <p class="text-xs !ml-2 font-semibold "> - {{ $umkm->tipe_binaan }}</p>
                                </div>
                                <p class="text-xs mt-4 ">Umkm saya terdaftar sejak {{ $umkm->created_at }}</p>
                            </div>
                        </div>
                        <ul class="flex my-2 md:my-6">
                            <a href="{{ route('binaan.list') }}"
                                class=" font-semibold text-sm text-white bg-gray-800 py-3 px-8 border-b-2 border-yellow-300 cursor-pointer transition-all">
                                Kembali</a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
