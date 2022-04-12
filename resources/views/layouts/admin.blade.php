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
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
     <!-- component -->
<div class="w-full flex flex-row flex-wrap">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    .round {
      border-radius: 50%;
    }
  </style>
  
  <header class="bg-blue-900 py-6 w-full mx-auto grid grid-col">
    {{-- <div class="px-6 bg-red-900"> --}}
        <div>
            <p class="flex justify-center font-extrabold text-lg font-semibold text-gray-100 no-underline">
               Lewis Ministry
            </p>
        </div>
</header>


  <div class="w-full bg-indigo-100 h-screen flex flex-row flex-wrap justify-center ">
    
    <!-- Begin Navbar -->
    
    <div class="bg-white shadow-lg border-t-4 border-indigo-500 absolute bottom-0 w-full md:w-0 md:hidden flex flex-row flex-wrap">
      <div class="w-full text-right"><button class="p-2 fa fa-bars text-4xl text-gray-600"></button></div>
    </div>
    
    <div class="w-0 md:w-1/4 lg:w-1/5 h-0 md:h-screen overflow-y-hidden bg-white shadow-lg">
      <div class="p-5 bg-white sticky top-0">
        <img class="border border-indigo-100 shadow-lg round" src="http://lilithaengineering.co.za/wp-content/uploads/2017/08/person-placeholder.jpg">
        <div class="pt-2 border-t mt-5 w-full text-center text-xl text-gray-600">
          Some Person
        </div>
      </div>
      <div class="w-full h-screen antialiased flex flex-col hover:cursor-pointer">
        <a class="hover:bg-gray-300 bg-gray-200 border-t-2 p-3 w-full text-xl text-left text-gray-600 font-semibold" href="{{route('adminCategory')}}"><i class="fa fa-comment text-gray-600 text-2xl pr-1 pt-1 float-right"></i>Category</a>
        <a class="hover:bg-gray-300 bg-gray-200 border-t-2 p-3 w-full text-xl text-left text-gray-600 font-semibold" href="{{route('adminFeed')}}"><i class="fa fa-comment text-gray-600 text-2xl pr-1 pt-1 float-right"></i>Feeds</a>
        <a class="hover:bg-gray-300 bg-gray-200 border-t-2 p-3 w-full text-xl text-left text-gray-600 font-semibold" href=""><i class="fa fa-comment text-gray-600 text-2xl pr-1 pt-1 float-right"></i>Announcements</a>
        {{-- <a class="hover:bg-gray-300 bg-gray-200 border-t-2 p-3 w-full text-xl text-left text-gray-600 font-semibold" href=""><i class="fa fa-cog text-gray-600 text-2xl pr-1 pt-1 float-right"></i>Settings</a> --}}
        <a class="hover:bg-gray-300 bg-gray-200 border-t-2 p-3 w-full text-xl text-left text-gray-600 font-semibold" href=""><i class="fa fa-arrow-left text-gray-600 text-2xl pr-1 pt-1 float-right"></i>Log out</a>
      </div>
    </div>
    
    <!-- End Navbar -->
    
    <div class="w-full md:w-3/4 lg:w-4/5 p-5 md:px-12 lg:24 h-full overflow-x-scroll antialiased">
      
      <div class="mt-3 flex flex-col">
     
       @yield('content')
      </div>


    </div>
  </div>
  
  </div>

       
        @livewireScripts
    </div>
</body>
</html>