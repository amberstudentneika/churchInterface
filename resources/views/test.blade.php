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
    <div class=" max-w-lg p-4 antialiased text-black bg-white dark:bg-gray-800 dark:text-gray-200">
        <!-- comment component -->
        <div>
            
            <div>
            <div class="flex items-stretch">
                <div>
                  <img class="w-8 h-8 mt-1 mr-2 rounded-full " src="{{url('storage\profileImage\storage\tempProfileImage.png')}}"/>
                </div>

                <div class="self-auto bg-gray-100 dark:bg-gray-700 rounded-3xl px-4 pt-2 pb-2.5">
                  <div class="text-sm font-semibold leading-relaxed">shaneika lewis</div>
                 hi there u  
                </div>

            </div>
            <div class="text-sm ml-10 mt-0.5 text-gray-500 dark:text-gray-400">
              12 hours
            </div>
            </div>

                {{-- <div>
                  <img class="w-8 h-8 mt-1 mr-2 rounded-full " src="{{url('storage\profileImage\storage\tempProfileImage.png')}}"/>
                </div>
                <div class="bg-gray-100 dark:bg-gray-700 rounded-3xl px-4 pt-2 pb-2.5">
                  <div class="text-sm font-semibold leading-relaxed">shaneika lewis</div>
                 hi there u am okat toat ghtyfu uhgyu ukg yf yg ytf uyfyt 
                </div>
                <div class="text-sm ml-4 mt-0.5 text-gray-500 dark:text-gray-400">
                  12 hours
                </div> --}}
            
        
      </div>
    </div>


</div>
</body>
</html>