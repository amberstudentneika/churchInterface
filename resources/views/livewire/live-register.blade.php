<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <main class="mx-10 mt-5">
        {{-- <main> --}}
   <div class="mt-10 sm:mt-0">
     <div class="md:grid md:grid-cols-3 md:gap-6">
       <div class="md:col-span-1">
         <div class="px-4 sm:px-0">
           <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
           <p class="mt-1 text-sm text-gray-600">
             Use a permanent address where you can receive mail.
           </p>
         </div>
       </div>
       <div class="mt-5 md:mt-0 md:col-span-2">
         <form action="" wire:submit.prevent="onSubmit">
             <div class="shadow overflow-hidden sm:rounded-md">
             <div class="px-4 py-5 bg-white sm:p-6">
               <div class="grid grid-cols-6 gap-6">
                 <div class="col-span-6 sm:col-span-3">
                   <label for="firstname" class="block text-sm font-medium text-gray-700">First name</label>
                   <input type="text" wire:model="firstname"  class="@error('firstname')  border-red-500 @enderror mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                   @error('firstname')
                   <p class="text-red-500 text-xs italic mt-4">
                       {{ $message }}
                   </p>
                   @enderror
                 </div>
                 
                 <div class="col-span-6 sm:col-span-3">
                   <label for="lastname" class="block text-sm font-medium text-gray-700">Last name</label>
                   <input type="text" wire:model="lastname" class=" @error('lastname')  border-red-500 @enderror mt-1 p-2  focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
                     <label class="block text-sm font-medium text-gray-700">Email</label>
                     <input type="email" wire:model="email" class="@error('email')  border-red-500 @enderror mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                     @error('email')
                     <p class="text-red-500 text-xs italic mt-4">
                         {{ $message }}
                     </p>
                     @enderror  
                 </div>
   
                 <div class="col-span-6 sm:col-span-3">
                     <label class="block text-sm font-medium text-gray-700">Password</label>
                     <input type="password" wire:model="password" class="@error('password')  border-red-500 @enderror mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                     @error('password')
                     <p class="text-red-500 text-xs italic mt-4">
                         {{ $message }}
                     </p>
                     @enderror 
                 </div>
 
                 <div class="col-span-6 sm:col-span-3">
                     <label class="block text-sm font-medium text-gray-700">Re-type Password</label>
                     <input type="password" wire:model="password_confirmation" class="@error('retypepassword')  border-red-500 @enderror mt-1 p-2 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                     @error('password_confirmation')
                     <p class="text-red-500 text-xs italic mt-4">
                         {{ $message }}
                     </p>
                     @enderror
                 </div>
   
                
               </div>
             </div>
 
  
             <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
               <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                 Register
               </button>
             </div>
           </div>
         </form>
       </div>
     </div>
   </div>
    </main>
</div>
