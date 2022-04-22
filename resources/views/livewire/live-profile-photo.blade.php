<div>
  
  <main class="mx-10 mt-5">
<div class="mt-10 sm:mt-0">
 <div class="md:grid md:grid-cols-3 md:gap-6">
   <div class="mt-5 md:mt-0 md:col-span-2">
     <form action="" wire:submit.prevent="onSubmit">
       
         <div class="shadow overflow-hidden sm:rounded-md">
         <div class="px-4 py-5 bg-white sm:p-6">
          <div class="grid grid-cols-3 mb-10">
            <div></div>
            <div class="">
              @if($photo != $oldPhoto)
                  <img class="object-cover w-48 h-48 border border-indigo-100 shadow-lg rounded-full" src="{{ $photo->temporaryUrl() }}">
              @else
                <img src="{{url('storage/profileImage/storage/'.$photo)}}" class="object-cover w-48 h-48 border border-indigo-100 shadow-lg rounded-full"/>
              @endif
            </div>
            <div></div>
          </div>
          <div class="grid grid-cols-3 mb-15">
            <div></div>
            <div class=""> <label class="cursor-pointer bg-blue-600 text-gray-200 font-bold rounded-md py-2 px-4">Change photo
                <input type="file" wire:model="photo"  class="hidden">
              </label>
                @error('photo')
              <p class="text-red-500 text-xs italic mt-4">
                  {{ $message }}
              </p>
              @enderror
            </div>
            <div></div>
          </div>
           <div class="grid grid-cols-6 gap-6">
             <div class="col-span-6 sm:col-span-3">
               <label for="firstname" class="block text-sm font-medium text-gray-700 ">First name</label>
               <input type="text" wire:model="firstname"  class="@error('firstname')  border-red-500 @enderror mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm text-gray-700 border rounded-md border-gray-250">
               @error('firstname')
               <p class="text-red-500 text-xs italic mt-4">
                   {{ $message }}
               </p>
               @enderror
             </div>
             
             <div class="col-span-6 sm:col-span-3">
               <label for="lastname" class="block text-sm font-medium text-gray-700">Last name</label>
               <input type="text" wire:model="lastname" class=" @error('lastname')  border-red-500 @enderror mt-1 p-2  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm text-gray-700 border rounded-md border-gray-250">
               @error('lastname')
               <p class="text-red-500 text-xs italic mt-4">
                   {{ $message }}
               </p>
               @enderror
             </div>

             <div class="col-span-6 sm:col-span-3">
                 <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                 <select id="gender" wire:model="gender" class="@error('gender')  border-red-500 @enderror mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                   <option>Select</option>
                   <option value="male">Male</option>
                   <option value="female">Female</option>
                 </select>
                 @error('gender')
                 <p class="text-red-500 text-xs italic mt-4">
                     {{ $message }}
                 </p>
                 @enderror  
             </div>
             <div class="col-span-6 sm:col-span-3">
                 <label for="" class="block text-sm font-medium text-gray-700">Change Password</label>
                 @if($changePassword==true)
                <button wire:click.prevent="hideChangePassword" type="button" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-red-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">Click to hide
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 15.707a1 1 0 010-1.414l5-5a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 0zm0-6a1 1 0 010-1.414l5-5a1 1 0 011.414 0l5 5a1 1 0 01-1.414 1.414L10 5.414 5.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                  </svg>
                </button>
                @else
                <button wire:click.prevent="showChangePassword" type="button" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-green-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">Click to show
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M15.707 4.293a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 011.414-1.414L10 8.586l4.293-4.293a1 1 0 011.414 0zm0 6a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-5-5a1 1 0 111.414-1.414L10 14.586l4.293-4.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                  </svg>
                </button>
                @endif
              </div>
              </div>
            
             @if($changePassword==true)
             <div class="mt-5 grid grid-cols-6 gap-6">
             <div class="col-span-6 sm:col-span-3">
                 <label class="block text-sm font-medium text-gray-700">New Password</label>
                 <input type="password" wire:model="password" class="@error('password')  border-red-500 @enderror mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm text-gray-700 border rounded-md border-gray-250">
                 @error('password')
                 <p class="text-red-500 text-xs italic mt-4">
                     {{ $message }}
                 </p>
                 @enderror 
             </div>

             <div class="col-span-6 sm:col-span-3">
                 <label class="block text-sm font-medium text-gray-700">Re-type Password</label>
                 <input type="password" wire:model="password_confirmation" class="@error('retypepassword')  border-red-500 @enderror mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm text-gray-700 border rounded-md border-gray-250">
                 @error('password_confirmation')
                 <p class="text-red-500 text-xs italic mt-4">
                     {{ $message }}
                 </p>
                 @enderror
             </div>
           </div> 
           @endif
         </div>


         <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex justify-center">
           <a href="{{route('adminFeed')}}">
            <button type="button" class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
             Cancel
           </button>
          </a>
           <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
             Save
           </button>
         </div>
       </div>
     </form>
   </div>
 </div>
</div>
</main>

</div>



