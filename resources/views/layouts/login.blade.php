<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @livewireStyles()
</head>

<body class="bg-gray-200 h-screen antialiased leading-none font-sans">
    <div id="app">
        {{-- <header class="bg-blue-900 py-6">
            <div class="container mx-auto flex justify-center px-6">
                <div>
                    <a href="{{ url('/') }}" class="font-extrabold text-2xl text-gray-100 no-underline">
                       Lewis Ministry
                    </a>
                </div>
             
            </div>
        </header> --}}

        @yield('content')
    @livewireScripts
    </div>
</body>
</html>