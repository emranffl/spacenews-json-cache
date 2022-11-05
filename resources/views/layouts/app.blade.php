<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- js -->
    <script defer src="{{ asset('js/app.js') }}"></script>
    <script defer src="{{ asset('js/script.js') }}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


    @yield('HEADCONTENT')

</head>

@section('NAVLINKS')
    {{-- <a href="/" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Home</a> --}}

    {{-- <a href="#" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Team</a> --}}

    {{-- <a href="#" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">About</a> --}}
@endsection

<body class="min-h-screen relative">

    <nav class="bg-blue-600" x-data="{ mobilemenudropdown: false }">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-12">

                <!-- mobile menu button-->
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button type="button" x-on:click="mobilemenudropdown = ! mobilemenudropdown"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-300 hover:text-gray-700 hover:bg-gray-200 focus:outline-none"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <!-- icon when menu is closed -->
                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <!-- icon when menu is open -->
                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="text-white text-xl">SpaceNews</a>
                    </div>

                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-3">

                            @yield('NAVLINKS')

                        </div>
                    </div>
                </div>


                <div class="flex space-x-3 text-lime-50">
                    <a href="/login" class="hover:text-gray-900">Login</a>
                    <span>|</span>
                    <a href="/signup" class="px-5 rounded border border-white hover:bg-white hover:text-gray-900">
                        Sign Up
                    </a>
                </div>

                {{-- <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button type="button"
                        class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>

                    <div class="ml-3 relative" x-data="{ profilemenudropdown: false }">
                        <div>
                            <button x-on:click="profilemenudropdown = ! profilemenudropdown" type="button"
                                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full"
                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                    alt="">
                            </button>
                        </div>

                        <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 z-10 bg-white ring ring-black ring-opacity-5 focus:outline-none"
                            x-show="profilemenudropdown" @click.away="profilemenudropdown = false"
                            @click.children="profilemenudropdown = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-800"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-1" role="menu" aria-orientation="vertical"
                            aria-labelledby="user-menu-button" tabindex="-1">

                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                tabindex="-1" id="user-menu-item-0">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                tabindex="-1" id="user-menu-item-1">Preferences</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                                tabindex="-1" id="user-menu-item-2">Logout</a>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>

        {{-- //* mobile menu, show/hide based on menu state --}}
        <div class="sm:hidden" id="mobile-menu" x-show="mobilemenudropdown" @click.away="mobilemenudropdown = false"
            @click.children="mobilemenudropdown = false" x-transition:enter="transition ease-in duration-200"
            x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in-out duration-800"
            x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1">
            <div class="px-2 pt-2 pb-3 flex justify-center">

                @yield('NAVLINKS')

            </div>
        </div>
    </nav>


    <main>
        @yield('MAINCONTENT')
    </main>
</body>

</html>
