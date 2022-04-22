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
                <div class=""> <label class="bg-blue-600 text-gray-200 font-bold rounded-md py-2 px-4">Change photo
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
               <button type="submit" class="mr-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                 Cancel
               </button>
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
        {{-- <div class="flex justify-center"> 
            <div class='flex items-center justify-center w-full mt-4'>
                <label class='flex flex-col w-full h-32 border-4 border-dashed cursor-pointer hover:bg-gray-100 hover:border-gray-200 group'>
                    <div class='flex flex-col items-center justify-center pt-7'>
                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                     @if($photo== '') 
                     <p class='pt-1 text-sm tracking-wider text-gray-400 lowercase group-hover:text-purple-600'>Click here to select photo</p>
                     @else
                     <p class='pt-1 text-sm tracking-wider text-purple-600 lowercase'>{{$photo->getClientOriginalName()}}</p>
                    @endif
                    </div>
                    <input wire:model="photo" type="file" class="hidden" />
                </label>  
            </div>
          </div>
          @error('photo')
          <p class="mt-4 text-xs italic text-red-500">
              {{ "*required" }}
          </p>
          @enderror 
   
    <div class="flex justify-center">  
      <div class="flex flex-row items-center py-2">
        <button type="submit" class="flex flex-row items-center px-2 py-2 ml-3 bg-green-400 rounded-md focus:outline-none focus:shadow-outline">
          <span class="ml-1">Upload photo</span>
        </button>
      </div>
    </div> --}}


    


{{-- 
  <div class="xl:w-1/4 lg:w-1/2 md:w-1/2 flex flex-col mb-6">
  <label for="Email" class="pb-2 text-sm font-bold text-gray-800 dark:text-gray-100">Email</label>
  <div class="border border-green-400 shadow-sm rounded flex">
      <div tabindex="0" class="focus:outline-none px-4 py-3 dark:text-gray-100 flex items-center border-r border-green-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" />
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <polyline points="3 7 12 13 21 7" />
          </svg>
      </div>
      <input tabindex="0" type="text" id="Email" name="email" required class="pl-3 py-3 w-full text-sm focus:outline-none placeholder-gray-500 rounded bg-transparent text-gray-600 dark:text-gray-400" placeholder="example@gmail.com" />
  </div>
  <div class="flex justify-between items-center pt-1 text-green-700">
      <p class="text-xs">Email submission success!</p>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16">
          <path
              class="heroicon-ui"
              d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0
      0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"
              stroke="currentColor"
              stroke-width="0.25"
              stroke-linecap="round"
              stroke-linejoin="round"
              fill="currentColor"
          ></path>
      </svg>
  </div>
</div><div> --}}




</div>



