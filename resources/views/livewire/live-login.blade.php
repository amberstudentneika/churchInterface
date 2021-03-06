<div class="mt-10">
    {{-- Stop trying to control. --}}
    @if(session()->has('success'))
    <div class="shadow-md flex justify-center bg-green-100 rounded-lg p-4 mb-4 text-sm text-green-700" role="alert">
        <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div>
            <span class="font-medium">Success alert!</span> {{session()->get('success')}}
        </div>
    </div>
    @elseif(session()->has('failedLogin'))
    <div class="shadow-md flex justify-center bg-red-100 rounded-lg p-4 mb-4 text-sm text-red-700" role="alert">
        <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
        <div>
            <span class="font-medium">Whoops!</span> {{session()->get('failedLogin')}}
        </div>
    </div>
    @endif
    <div class="py-6">
        <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
              <div class="hidden lg:block lg:w-1/2 bg-cover" style="background-image:url('backgroundImage/bible-2110439_1920.jpg')"></div>
              {{-- <div class="hidden lg:block lg:w-1/2 bg-cover" style="background-image:url('https://images.unsplash.com/photo-1546514714-df0ccc50d7bf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=667&q=80')"></div> --}}
              <div class="w-full p-8 lg:w-1/2">
                  <h2 class="text-2xl font-bold text-gray-700 text-center mb-8">Lewis Ministry of God</h2>
                  {{-- <p class="text-xl text-gray-600 text-center">Welcome back!</p> --}}
                 <form wire:submit.prevent="onSubmit">
                  <div class="mt-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                      <input wire:model="email" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="email">
                  </div>
                  <div class="mt-4">
                      <div class="flex justify-between">
                          <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                          <a href="#" class="text-xs text-gray-500">Forget Password?</a>
                      </div>
                      <input wire:model="password" class="bg-gray-200 text-gray-700 focus:outline-none focus:shadow-outline border border-gray-300 rounded py-2 px-4 block w-full appearance-none" type="password">
                  </div>
                  <div class="mt-8">
                      <button type="submit" class="bg-green-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-green-600">Login</button>
                  </div>
                  <div class="mt-4 flex items-center justify-between">
                      <span class="border-b w-1/5 md:w-1/4"></span>
                      <a href="{{route('register')}}" class="text-xs text-gray-500 uppercase">or sign up</a>
                      <span class="border-b w-1/5 md:w-1/4"></span>
                  </div>
                 </form>
              </div>
          </div>
      </div>
          
    </div>
