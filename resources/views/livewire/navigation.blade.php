<nav class="bg-gray-800" x-data="{ open: false }">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <!-- Mobile menu button-->
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                {{-- ! MOBILE MENU BUTTON --}}
                <button x-on:click="open = true" type="button"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Menú</span>
                    <!--
                  Icon when menu is closed.
      
                  Heroicon name: outline/bars-3
      
                  Menu open: "hidden", Menu closed: "block"
                -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!--
                  Icon when menu is open.
      
                  Heroicon name: outline/x-mark
      
                  Menu open: "block", Menu closed: "hidden"
                -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center sm:items-stretch sm:justify-start">

                {{-- ! LOGITIPO --}}
                <a href="/" class="flex flex-shrink-0 items-center">
                    <img class="block h-8 w-auto lg:hidden"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    <img class="hidden h-8 w-auto lg:block"
                        src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                </a>
                {{-- ! MENU LG --}}
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        {{-- <a href="#" class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                            aria-current="page">Dashboard</a> --}}
                        <a href="#"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Inicio</a>
                        <a href="#"
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Inicio</a>
                    </div>
                </div>
                {{-- ! BOTON NOTIFICACOPN --}}
                <div class="relative ml-3" x-data="{ open: false }">
                    <div>
                        <button x-on:click="open = true" type="button"
                            class="rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                            <!-- Heroicon name: outline/bell -->
                            {{-- <div
                                class="absolute text-xs rounded-full -mt-1 -mr-2 px-1 font-bold top-0 right-0 bg-red-700 text-white">
                                {{ Cart::count() }}</div> --}}
                                @livewire('shop.cart-component')
                            <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-shopping-cart w-6 h-6">
                                <circle cx="9" cy="21" r="1"></circle>
                                <circle cx="20" cy="21" r="1"></circle>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                            </svg>
                        </button>
                    </div>
                    <div x-show="open" x-on:click.away="open = false"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                    </div>
                </div>
            </div>
            {{-- ! AQUI CARRITO DE COMPRAS --}}
            @auth
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    {{-- ! Profile dropdown --}}
                    <div class="relative ml-3" x-data="{ open: false }">
                        <div>
                            <button x-on:click="open = true" type="button"
                                class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                {{-- <span class="sr-only">Open user menu</span> --}}
                                <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}"
                                    alt="">
                            </button>
                        </div>

                        <!--Dropdown menu, show/hide based on menu state.                            Entering: "transition ease-out duration-100"
                                                        From: "transform opacity-0 scale-95"
                                                        To: "transform opacity-100 scale-100"
                                                        Leaving: "transition ease-in duration-75"
                                                        From: "transform opacity-100 scale-100"
                                                        To: "transform opacity-0 scale-95"
                                                                                                -->
                        <div x-show="open" x-on:click.away="open = false"
                            class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700"
                                role="menuitem" tabindex="-1" id="user-menu-item-0">Tu perfil</a>
                            @can('admin.home')
                                <a href="{{ route('admin.home') }}" class="block px-4 py-2 text-sm text-gray-700"
                                    role="menuitem" tabindex="-1" id="user-menu-item-0">Dashboard</a>
                            @endcan
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700"
                                    role="menuitem" tabindex="-1" id="user-menu-item-2"
                                    @click.prevent="$root.submit();">Cerrar sesion</a>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div>
                    <a href="{{ route('login') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        {{ __('Login') }}</a>
                    <a href="{{ route('register') }}"
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{ __('Register') }}</a>
                </div>
            @endauth

        </div>
    </div>

    {{-- ! MENU MOBIL --}}
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="open" x-on:click.away=" open = false">
        <div class="space-y-1 px-2 pt-2 pb-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            @can('admin.home')
                <a href="#" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium"
                    aria-current="page">Dashboard</a>
            @endcan
            <a href=""
                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                Inicio</a>

            <a href="#"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                Inicio</a>
        </div>
    </div>
</nav>
