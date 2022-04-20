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
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    @livewireStyles()
</head>

<body class="h-screen font-sans antialiased leading-none bg-gray-100">
<div id="app">
  <!-- component -->
<style>
    .gradient {
      background-image: linear-gradient(135deg, #684ca0 35%, #1c4ca0 100%);
    }
  </style>
  
  
      <div class="gradient text-white min-h-screen flex items-center">
        <div class="container mx-auto p-4 flex flex-wrap items-center">
          {{-- <div class="w-full md:w-5/12 text-center p-4">
            <img src="https://themichailov.com/img/not-found.svg" alt="Not Found" />
          </div> --}}
          <div class="w-full md:w-7/12 text-center md:text-left p-4">
            <div class="text-6xl font-medium">Whooops!</div>
            <div class="text-6xl font-medium"> </div>
            <div class="text-xl md:text-3xl font-medium mb-4">
              Our system is currently down. Please try again later!
            </div>
            <div class="text-lg mb-8">
              {{-- You may have mistyped the address or the page may have moved. --}}
            </div>
            <a href="{{url()->previous()}}" class=" hover:bg-gray-100 hover:text-blue-600 hover:font-bold border border-white rounded p-4">Go Back</a>
          </div>
        </div>
      </div>

</div>
</body>
</html>