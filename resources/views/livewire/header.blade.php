@php
    use Illuminate\Support\Facades\Auth;
@endphp

<div>
    <nav class="bg-white fixed w-full z-50 top-0 start-0 border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto px-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('logo-PKH.png') }}" class="h-16" alt="Flowbite Logo" />
            </a>
            <button data-collapse-toggle="navbar-default" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-ms text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    @if (Auth::check() && Auth::user()->is_admin)
                        <li>
                            <a href="{{ route('users') }}"
                                class="{{ 'users' == request()->path() ? 'nav-active' : 'nav-deact' }}"
                                aria-current="page">Authority</a>
                        </li>
                        <li>
                            <a href="{{ route('umkms') }}"
                                class="{{ 'umkms' == request()->path() ? 'nav-active' : 'nav-deact' }}"
                                aria-current="page">UMKM</a>
                        </li>
                    @endif

                    <li>
                        <a href="{{ route('home') }}"
                            class="{{ 'home' == request()->path() ? 'nav-active' : 'nav-deact' }}"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('binaan.list') }}"
                            class="{{ Str::contains(request()->path(), 'binaan') ? 'nav-active' : 'nav-deact' }}">
                            Catalog
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                            Maps
                        </a>
                    </li>
                    @auth
                        <li class="cursor-pointer hover:animate-pulse">

                            <span
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">
                                <span class="hover:animate-spin">👋</span>
                                {{ Auth::user()->name }}</span>

                        </li>
                    @endauth
                    @if (Auth::check())
                        <li>

                            <a href="{{ route('logout') }}"
                                class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent"
                                hover:text-gray-900">Logout</a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
        <hr>
    </nav>
</div>
