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


     <nav class="flex justify-center bg-blue-900 p-3 flex-wrap">
      <a href="#" class="p-2 mr-4 flex justify-center">
        
          <span class="text-xl  text-white font-bold uppercase tracking-wide"
          >Lewis Ministry</span>
       
      </a>
      <button
        class="text-white inline-flex p-3 bg-blue-700 hover:bg-gray-900 rounded lg:hidden ml-auto hover:text-white outline-none nav-toggler"
        data-target="#navigation"
      >
        <i class="material-icons">menu</i>
      </button>
      <div
        class="hidden top-navbar w-full "
        id="navigation"
      >
        <div
          class="lg:inline-flex lg:flex-row lg:ml-auto lg:w-auto w-full lg:items-center items-start  flex flex-col lg:h-auto"
        >
          
          <a
          href="{{route('memberFeed')}}"
            class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
          >
            <span>Feeds</span>
          </a>
          <a
          href="{{route('memberAnnouncement')}}"
            class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
          >
            <span>Announcements</span>
          </a>
          <a
          href="{{route('memberEditProfile')}}"
            class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
          >
            <span>Edit Profile</span>
          </a>
          <a
          href="{{route('logout')}}"
            class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded text-gray-400 items-center justify-center hover:bg-gray-900 hover:text-white"
          >
            <span>Logout</span>
          </a>
          
        </div>
      </div>
    </nav>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
    $(".nav-toggler").each(function(_, navToggler) {
    var target = $(navToggler).data("target");
    $(navToggler).on("click", function() {
      $(target).animate({
        height: "toggle"
      });
    });
    });
    });
    
    </script>


<div class="flex flex-row flex-wrap w-full">
  <div class="flex flex-row flex-wrap justify-center w-full h-screen bg-indigo-100 ">

    <div class="w-0 h-0 overflow-y-hidden bg-white shadow-lg sm:w-1/4  md:w-1/4 lg:w-1/5 md:h-screen">
      <div class="sticky top-0 p-5 bg-white">
        <?php $photo=session()->get('memberImage')?> 
        {{--  --}}
        <div class="flex justify-center mt-10">
        <img class="object-cover w-48 h-48 border border-indigo-100 shadow-lg rounded-full" src="{{url('storage/profileImage/storage/'.$photo)}}">
        </div>
        
         <div class="w-full pt-2 mt-5 text-xl text-center text-black ">
          {{session()->get('memberName')}}
        </div>
       
      </div>
     
      <div class="flex flex-col w-full h-screen mt-8 antialiased hover:cursor-pointer">
       
        <a class="w-full p-3 text-xl font-semibold text-left text-black  border-t-2 border-gray-200 hover:bg-blue-200" href="{{route('memberFeed')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="float-right pt-1 pr-1 text-xl  text-black w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
            <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
          </svg>
          Feeds
        </a>
        <a class="w-full p-3 text-xl font-semibold text-left text-black border-t-2 border-gray-200 hover:bg-blue-200" href="{{route('memberAnnouncement')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="float-right pt-1 pr-1 text-2xl text-black w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd" />
          </svg>
          Announcements
        </a>
        <a class="w-full p-3 text-xl font-semibold text-left text-black border-t-2 border-gray-200 hover:bg-blue-200" href="{{route('memberEditProfile')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="float-right pt-1 pr-1 text-2xl text-black w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
          </svg>
          Edit Profile
        </a>
       <a class="w-full p-3 text-xl font-semibold text-left text-black border-t-2 border-gray-200 hover:bg-blue-200" href="{{route('logout')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="float-right pt-1 pr-1 text-2xl text-black w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
        </svg>Logout</a>
      </div>
    
    </div>
    
   
    <!-- End Navbar -->
    
    <div class="w-full h-full p-5 overflow-x-scroll antialiased md:w-3/4 lg:w-4/5 md:px-12 lg:24">
      
       @yield('content')
      
    </div>
  </div>
  
  </div>

       
        @livewireScripts
        

        <footer class="px-6 py-2 text-white bg-black">
          <div class="container flex flex-col items-center justify-between mx-auto md:flex-row">
            <div><p class="mt-2 md:mt-0 inline-block">Github</p></div>
            
            <a href="https://github.com/amberstudentneika" class="text-md ">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zM4 4h3a3 3 0 006 0h3a2 2 0 012 2v9a2 2 0 01-2 2H4a2 2 0 01-2-2V6a2 2 0 012-2zm2.5 7a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm2.45 4a2.5 2.5 0 10-4.9 0h4.9zM12 9a1 1 0 100 2h3a1 1 0 100-2h-3zm-1 4a1 1 0 011-1h2a1 1 0 110 2h-2a1 1 0 01-1-1z" clip-rule="evenodd" />
              </svg>
            <span class="inline-block">Designed by Shaneika Lewis</span>
           </a>
              
            <p class="mt-2 md:mt-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
              </svg>
              <span class="inline-block">All rights reserved 2022.</span>
            </p>
              
          </div>
      </footer>
    </div>
    
</body>
</html>