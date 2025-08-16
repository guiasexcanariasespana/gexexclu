<!DOCTYPE html>
<html data-theme="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('google_analytics')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">


    <div class="min-h-screen">


        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif
        <div class="navbar bg-base-100">
            <div class="w-64 ml-5">
                <a href="{{ url('/') }}"> <img src="{{ config('app.url') }}/img/logo.png" /></a>
            </div>
            <div class="flex-1 justify-end">

                <div class="dropdown dropdown-end">
                    @auth
                        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                            <div class="w-10 rounded-full">
                                <img src="{{ Auth::user()->profile_photo_url }}" />
                            </div>
                        </label>
                        @if (Route::has('login'))
                            <ul tabindex="0"
                                class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">

                                <li>
                                    <a href="{{ route('profile.show') }}"> Mi perfil </a>
                                </li>
                                <li>
                                    <a href="{{ url('/dashboard') }}"
                                        class="text-sm text-gray-700 dark:text-gray-500 ">Panel</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Cerrar Sesión') }}
                                        </x-jet-dropdown-link>
                                    </form>
                                </li>
                            @else
                                <li> <a href="{{ route('login') }}"
                                        class="text-sm text-gray-700 dark:text-gray-500 ">Ingresar</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}"
                                            class="text-sm text-gray-700 dark:text-gray-500 ">Registrate</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div id="progress" class="h-1 bg-white shadow"
            style="background:linear-gradient(to right, #4dc0b5 var(--scroll), transparent 0);"></div>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')
    @livewireScripts
    <script>
        Livewire.on('verificar', function() {
            verificar();
        });
    </script>
</body>

</html>
