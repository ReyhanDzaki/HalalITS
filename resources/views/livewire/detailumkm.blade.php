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
                                    src="https://maps.google.com/maps?q={{ $umkm->latitude ?? '-3.1963' }},{{ $umkm->longitude ?? '118.5056' }}&z={{ $this->zoomLevel }}&amp;output=embed"></iframe>
                            </div>

                        </template>
                        <template x-if="!showText">
                            <div>
                                <h3 class="my-3">Produk dari {{ $umkm->nama_umkm }}</h3>
                                <div class="grid grid-cols-2">
                                    @foreach ($umkm->photos as $photo)
                                        <div class="flex flex-col gap-3 justify-center items-center">
                                            <img src="{{ Storage::url($photo->photo) }}"
                                                alt="UMKM Photo of {{ $photo->description }}" style="max-width: 200px;">
                                            <p>{{ $photo->description }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
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
                            class="flex flex-row items-center min-w-full justify-center gap-3 cursor-pointer px-4 py-3 bg-yellow-300 hover:bg-yellow-400 text-black text-xl font-semibold rounded">
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
                                                @php
                                                    // Define placeholders if applicable
                                                    $placeholders = ['-', 'N/A', 'None', null]; // Adjust based on expected placeholder values
                                                @endphp

                                                @if (!array_diff($halalCode, $placeholders))
                                                    <p>No Halal Certificates</p>
                                                @else
                                                    @foreach ($halalCode as $code)
                                                        <a class="hover:underline"
                                                            href="https://bpjph.halal.go.id/search/sertifikat?nama_produk=&nama_pelaku_usaha=&no_sertifikat={{ $code }}&page=1"
                                                            target="_blank">
                                                            <div class="flex flex-row gap-3 items-center">
                                                                <img class="w-6 ring-1 rounded-xl ring-purple-600"
                                                                    src="{{ asset('Logo-Halal.png') }}"
                                                                    alt="">
                                                                <p class="font-medium">
                                                                    {{ $code }}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                @endif
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
                                                @if (!array_diff($pirt, $placeholders))
                                                    <p>No PIRT Certificates</p>
                                                @else
                                                    @foreach ($pirt as $p)
                                                        {{ $p }}
                                                        </a>
                                                    @endforeach
                                                @endif
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
                                                @if (!array_diff($bpom, $placeholders))
                                                    <p>No BPOM Certificates</p>
                                                @else
                                                    @foreach ($bpom as $p)
                                                        {{ $p }}
                                                        </a>
                                                    @endforeach
                                                @endif
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
                    @if (
                        ($umkm->facebook && $umkm->facebook !== '-') ||
                            ($umkm->instagram && $umkm->instagram !== '-') ||
                            ($umkm->tokopedia && $umkm->tokopedia !== '-'))
                        <div class="mt-8 flex justify-center">
                            <h1 class="text-3xl font-medium">Our Social Media</h1>
                        </div>
                        <div class="mt-4 flex justify-center">
                            @if ($umkm->facebook && $umkm->facebook !== '-')
                                <a href="{{ Str::startsWith($umkm->facebook, 'http') ? $umkm->facebook : 'https://www.facebook.com/' . ltrim($umkm->facebook, '@') }}"
                                    target="_blank">
                                    <span
                                        class="inline-flex items-center justify-center w-12 h-12 me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                        <?xml version="1.0" ?>
                                        {{-- facebook --}}
                                        <svg class="w-6 h-6">
                                            <svg version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                                                xmlns="http://www.w3.org/2000/svg" xmlns:serif="http://www.serif.com/"
                                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                                <path
                                                    d="M374.245,285.825l14.104,-91.961l-88.233,0l0,-59.677c0,-25.159 12.325,-49.682 51.845,-49.682l40.117,0l0,-78.291c0,0 -36.408,-6.214 -71.214,-6.214c-72.67,0 -120.165,44.042 -120.165,123.775l0,70.089l-80.777,0l0,91.961l80.777,0l0,222.31c16.197,2.542 32.798,3.865 49.709,3.865c16.911,0 33.512,-1.323 49.708,-3.865l0,-222.31l74.129,0Z"
                                                    style="fill-rule:nonzero;" />
                                            </svg>
                                    </span>
                                </a>
                            @endif
                            @if ($umkm->instagram && $umkm->instagram !== '-')
                                <a href="{{ Str::startsWith($umkm->instagram, 'http') ? $umkm->instagram : 'https://www.instagram.com/' . ltrim($umkm->instagram, '@') }}"
                                    target="_blank">
                                    <span
                                        class="inline-flex items-center justify-center w-12 h-12 me-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-gray-700 dark:text-blue-400">
                                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor" fill-rule="evenodd"
                                                d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </a>
                            @endif
                            @if ($umkm->tokopedia && $umkm->tokopedia !== '-')
                                <a href="{{ Str::startsWith($umkm->tokopedia, 'http') ? $umkm->tokopedia : 'https://www.tokopedia.com/' . ltrim($umkm->tokopedia, '@') }}"
                                    target="_blank">
                                    <span
                                        class="inline-flex items-center justify-center w-12 h-12 me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 192 192"
                                            fill="none">
                                            <path fill="#000000" fill-rule="evenodd"
                                                d="M96 28c-9.504 0-17.78 5.307-22.008 13.127C82.736 42.123 88.89 44 96 47.332c7.11-3.332 13.264-5.209 22.008-6.205C113.781 33.31 105.506 28 96 28Zm0-12c-15.973 0-29.568 10.117-34.754 24.28C52.932 40 42.462 40 28.53 40H28a6 6 0 0 0-6 6v124a6 6 0 0 0 6 6h92c27.614 0 50-22.386 50-50V46a6 6 0 0 0-6-6h-.531c-13.931 0-24.401 0-32.715.28C125.566 26.113 111.97 16 96 16ZM34 52.001V164h86c20.987 0 38-17.013 38-38V52.001c-18.502.009-29.622.098-37.872.966-8.692.915-13.999 2.677-21.445 6.4a6 6 0 0 1-5.366 0c-7.446-3.723-12.753-5.485-21.445-6.4-8.25-.868-19.37-.957-37.872-.966ZM50 96c0-9.941 8.059-18 18-18s18 8.059 18 18-8.059 18-18 18-18-8.059-18-18Zm18-30c-16.569 0-30 13.431-30 30 0 16.569 13.431 30 30 30 1.126 0 2.238-.062 3.332-.183l20.425 20.426a6 6 0 0 0 8.486 0l20.425-20.426c1.094.121 2.206.183 3.332.183 16.569 0 30-13.431 30-30 0-16.569-13.431-30-30-30-12.764 0-23.666 7.971-28 19.207C91.666 73.971 80.764 66 68 66Zm40.082 55.433A30.1 30.1 0 0 1 96 106.793a30.101 30.101 0 0 1-12.082 14.64L96 133.515l12.082-12.082ZM124 78c-9.941 0-18 8.059-18 18s8.059 18 18 18 18-8.059 18-18-8.059-18-18-18ZM76 96a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm48 8a8 8 0 1 0 0-16 8 8 0 0 0 0 16Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Icon description</span>
                                    </span>
                                </a>
                            @endif
                            @if ($umkm->shopee && $umkm->shopee !== '-')
                                <a href="{{ Str::startsWith($umkm->shopee, 'http') ? $umkm->shopee : 'https://www.shopee.com/' . ltrim($umkm->shopee, '@') }}"
                                    target="_blank">
                                    <span
                                        class="inline-flex items-center justify-center w-12 h-12 me-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-gray-700 dark:text-blue-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 192 192"
                                            fill="none">
                                            <path fill="#000000"
                                                d="m29.004 157.064 5.987-.399-5.987.399ZM22 52v-6a6 6 0 0 0-5.987 6.4L22 52Zm140.996 105.064-5.987-.399 5.987.399ZM170 52l5.987.4A6 6 0 0 0 170 46v6ZM34.991 156.665 27.987 51.601l-11.974.798 7.005 105.064 11.973-.798Zm133.991.798 7.005-105.064-11.974-.798-7.004 105.064 11.973.798Zm-11.973-.798a10 10 0 0 1-9.978 9.335v12c11.582 0 21.181-8.98 21.951-20.537l-11.973-.798Zm-133.991.798C23.788 169.02 33.387 178 44.968 178v-12a10 10 0 0 1-9.977-9.335l-11.973.798ZM74 48c0-12.15 9.85-22 22-22V14c-18.778 0-34 15.222-34 34h12Zm22-22c12.15 0 22 9.85 22 22h12c0-18.778-15.222-34-34-34v12ZM22 58h148V46H22v12Zm22.969 120H147.03v-12H44.969v12Z" />
                                            <path stroke="#000000" stroke-linecap="round" stroke-width="12"
                                                d="M114 84H88c-7.732 0-14 6.268-14 14v0c0 7.732 6.268 14 14 14h4m-2 0h14c7.732 0 14 6.268 14 14v0c0 7.732-6.268 14-14 14H78" />
                                        </svg>
                                    </span>
                                </a>
                            @endif
                        </div>
                    @endif
                    <div class="mt-8">
                        <div class="flex items-start mt-8">
                            <img src="https://readymadeui.com/team-2.webp"
                                class="w-12 h-12 rounded-full border-2 border-white" />

                            <div class="ml-3">
                                <h4 class="text-sm font-semibold ">{{ $umkm->nama_pemilik }}</h4>
                                <!-- <div class="flex space-x-1 mt-1">
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
                                </div> -->
                                <p class="text-xs mt-4 ">Umkm saya terdaftar sejak {{ $umkm->created_at }}</p>
                            </div>
                        </div>
                        <ul class="flex my-2 md:my-6 flex-row justify-between">
                            <a href="{{ route('binaan.list') }}"
                                class=" font-semibold text-sm text-white bg-gray-800 py-3 px-8 border-b-2 border-yellow-300 cursor-pointer transition-all">
                                Kembali</a>
                            @if (Auth::check() && (Auth::id() === $umkm->user_id || Auth::user()->is_admin))
                                <a href="{{ route('binaan.edit', $umkm->no_umkm) }}"
                                    class="font-semibold text-sm text-white bg-gray-800 py-3 px-8 border-b-2 border-yellow-300 cursor-pointer transition-all">
                                    Edit
                                </a>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
