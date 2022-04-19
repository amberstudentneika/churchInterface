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
<div class="flex flex-row flex-wrap w-full">

  

 <header class="grid w-full py-6 mx-auto bg-white border-b border-blue-300 shadow-lg grid-col">
        <div>
            <p class="flex justify-center text-2xl font-semibold font-extrabold text-blue-800 no-underline">
               Lewis Ministry
            </p>
        </div>
</header>


  <div class="flex flex-row flex-wrap justify-center w-full h-screen bg-indigo-100 ">
    
    <!-- Begin Navbar -->
    
    {{-- <div class="absolute bottom-0 flex flex-row flex-wrap w-full bg-white border-t-4 border-indigo-500 shadow-lg md:w-0 md:hidden">
      <div class="w-full text-right"><button class="p-2 text-4xl text-black fa fa-bars"></button></div>
    </div> --}}
    
    <div class="w-0 h-0 overflow-y-hidden bg-white shadow-lg sm:w-1/4  md:w-1/4 lg:w-1/5 md:h-screen">
      <div class="sticky top-0 p-5 bg-white">
        <?php $photo=session()->get('memberImage')?> 
        <div class="flex justify-center mt-10">
        <img class="object-cover w-48 h-48 border border-indigo-100 shadow-lg round" src="{{url('storage/profileImage/storage/'.$photo)}}">
        </div>
        
         <div class="w-full pt-2 mt-5 text-xl text-center text-black ">
          {{session()->get('memberName')}}
        </div>
        
        {{-- <div class="mt-5 text-sm text-center text-black border-t ">
        <a  href="{{route('editProfilePhotoAdmin')}}">
              <svg xmlns="http://www.w3.org/2000/svg" class="pt-2 pr-1 text-2xl text-black w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
              </svg>
              <span>Edit Profile</span>
        </a>
        </div> --}}
        
       
      </div>
     
      <div class="flex flex-col w-full h-screen mt-8 antialiased hover:cursor-pointer">
       
        <a class="w-full p-3 text-xl font-semibold text-left text-black bg-blue-200 border-t-2 border-gray-200 hover:bg-blue-300" href="{{route('memberFeed')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="float-right pt-1 pr-1 text-2xl text-black w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
            <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
          </svg>
          Feeds
        </a>
        <a class="w-full p-3 text-xl font-semibold text-left text-black bg-blue-200 border-t-2 border-gray-200 hover:bg-blue-300" href="{{route('memberAnnouncement')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="float-right pt-1 pr-1 text-2xl text-black w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M18 3a1 1 0 00-1.447-.894L8.763 6H5a3 3 0 000 6h.28l1.771 5.316A1 1 0 008 18h1a1 1 0 001-1v-4.382l6.553 3.276A1 1 0 0018 15V3z" clip-rule="evenodd" />
          </svg>
          Announcements
        </a>
        <a class="w-full p-3 text-xl font-semibold text-left text-black bg-blue-200 border-t-2 border-gray-200 hover:bg-blue-300" href="{{route('memberEditProfile')}}">
          <svg xmlns="http://www.w3.org/2000/svg" class="float-right pt-1 pr-1 text-2xl text-black w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
          </svg>
          Edit Profile
        </a>
       <a class="w-full p-3 text-xl font-semibold text-left text-black bg-blue-200 border-t-2 border-gray-200 hover:bg-blue-300" href="{{route('logout')}}">
        <svg xmlns="http://www.w3.org/2000/svg" class="float-right pt-1 pr-1 text-2xl text-black w-7 h-7" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
        </svg>Logout</a>
      </div>
    
    </div>
    
   
    <!-- End Navbar -->
    
    <div class="w-full h-full p-5 overflow-x-scroll antialiased md:w-3/4 lg:w-4/5 md:px-12 lg:24">
      
      <div class="flex flex-col mt-3">
     
       @yield('content')
      </div>


    </div>
  </div>
  
  </div>

       
        @livewireScripts
        

        <footer class="px-6 py-2 text-white bg-blue-700">
          <div class="container flex flex-col items-center justify-between mx-auto md:flex-row"><a href="#"
                  class="text-2xl font-bold">Designed by Shaneika Lewis</a>
              <p class="mt-2 md:mt-0">All rights reserved 2022.</p>
              <div class="flex mt-4 mb-2 -mx-2 md:mt-0 md:mb-0"><a href="#"
                      class="mx-2 text-gray-100 hover:text-gray-400"><svg viewBox="0 0 512 512"
                          class="w-4 h-4 fill-current">
                      <path
                          d="M444.17,32H70.28C49.85,32,32,46.7,32,66.89V441.61C32,461.91,49.85,480,70.28,480H444.06C464.6,480,480,461.79,480,441.61V66.89C480.12,46.7,464.6,32,444.17,32ZM170.87,405.43H106.69V205.88h64.18ZM141,175.54h-.46c-20.54,0-33.84-15.29-33.84-34.43,0-19.49,13.65-34.42,34.65-34.42s33.85,14.82,34.31,34.42C175.65,160.25,162.35,175.54,141,175.54ZM405.43,405.43H341.25V296.32c0-26.14-9.34-44-32.56-44-17.74,0-28.24,12-32.91,23.69-1.75,4.2-2.22,9.92-2.22,15.76V405.43H209.38V205.88h64.18v27.77c9.34-13.3,23.93-32.44,57.88-32.44,42.13,0,74,27.77,74,87.64Z">
                      </path>
                  </svg></a><a href="#" class="mx-2 text-gray-100 hover:text-gray-400"><svg viewBox="0 0 512 512"
                      class="w-4 h-4 fill-current">
                      <path
                          d="M455.27,32H56.73A24.74,24.74,0,0,0,32,56.73V455.27A24.74,24.74,0,0,0,56.73,480H256V304H202.45V240H256V189c0-57.86,40.13-89.36,91.82-89.36,24.73,0,51.33,1.86,57.51,2.68v60.43H364.15c-28.12,0-33.48,13.3-33.48,32.9V240h67l-8.75,64H330.67V480h124.6A24.74,24.74,0,0,0,480,455.27V56.73A24.74,24.74,0,0,0,455.27,32Z">
                      </path>
                  </svg></a><a href="#" class="mx-2 text-gray-100 hover:text-gray-400"><svg viewBox="0 0 512 512"
                      class="w-4 h-4 fill-current">
                      <path
                          d="M496,109.5a201.8,201.8,0,0,1-56.55,15.3,97.51,97.51,0,0,0,43.33-53.6,197.74,197.74,0,0,1-62.56,23.5A99.14,99.14,0,0,0,348.31,64c-54.42,0-98.46,43.4-98.46,96.9a93.21,93.21,0,0,0,2.54,22.1,280.7,280.7,0,0,1-203-101.3A95.69,95.69,0,0,0,36,130.4C36,164,53.53,193.7,80,211.1A97.5,97.5,0,0,1,35.22,199v1.2c0,47,34,86.1,79,95a100.76,100.76,0,0,1-25.94,3.4,94.38,94.38,0,0,1-18.51-1.8c12.51,38.5,48.92,66.5,92.05,67.3A199.59,199.59,0,0,1,39.5,405.6,203,203,0,0,1,16,404.2,278.68,278.68,0,0,0,166.74,448c181.36,0,280.44-147.7,280.44-275.8,0-4.2-.11-8.4-.31-12.5A198.48,198.48,0,0,0,496,109.5Z">
                      </path>
                  </svg></a>
              </div>
          </div>
      </footer>
    </div>
    
</body>
</html>