<div>
    {{-- In work, do what you enjoy. --}}
    
@if ($viewMode==false)
        
<section class="h-screen px-4 antialiased text-gray-600">
       <div>
        <button type="button" wire:click.prevent="addMode()" class="p-2 pl-5 pr-5 text-lg text-gray-100 bg-blue-800 border-blue-300 rounded-lg focus:border-4">Category +</button>
       </div>
        <!-- Success Message -->
       @if(session()->has('success'))
               <div class="flex justify-center p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg shadow-md" role="alert">
                   <svg class="inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                   <div>
                       <span class="font-medium">Success alert!</span> {{session()->get('success')}}
                   </div>
               </div>
       @endif

        <div class="flex flex-col justify-center">
        <!-- Table -->
        <div class="w-full max-w-2xl mx-auto bg-white border border-gray-200 rounded-sm shadow-lg">
            <header class="px-5 py-4 border-b border-gray-100">
                <h2 class="font-semibold text-gray-800">Categories</h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="text-xs font-semibold text-gray-400 uppercase bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Category</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Description</div>
                                </th>
                                <th colspan='2' class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">action</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse ($data as $info)
                            
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{-- <div class="flex-shrink-0 w-10 h-10 mr-2 sm:mr-3"><img class="rounded-full" src="https://raw.githubusercontent.com/cruip/vuejs-admin-dashboard-template/main/src/images/user-36-05.jpg" width="40" height="40" alt="Alex Shatov"></div> --}}
                                        <div class="font-medium text-gray-800">{{$info['name']}}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$info['desc']}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <button wire:click.prevent="edit({{$info['id']}})" class="p-2 pl-5 pr-5 text-lg text-gray-100 bg-blue-500 border-blue-300 rounded-lg focus:border-4">Edit</button>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <button wire:click.prevent="delete({{$info['id']}})" class="p-2 pl-5 pr-5 text-lg text-gray-100 bg-red-500 border-red-300 rounded-lg focus:border-4">Delete</button>
                                </td>
                            </tr>
                                
                            @empty
                                 <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left">No categories created.</div>
                                    </td>
                                </td>
                            </tr>
                            @endforelse
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@elseif($addMode==true)
    <div>
    <button type="button" wire:click.prevent="viewMode()" class="p-2 pl-5 pr-5 text-lg text-gray-100 bg-blue-800 border-blue-300 rounded-lg focus:border-4">View Categories</button>
   </div>
    <div class="w-1/2 max-w-xl px-4 py-4 mx-auto bg-white rounded-lg shadow-md">
        <div class="flex justify-center">
         <p class="font-bold text-cool-gray-500">Category</p>
        </div>
  
    <form wire:submit.prevent="goSubmit">
        <div class="">
          <div class="py-2">
           <input wire:model="heading" placeholder="Category name" class="@error('heading') border-red-500 @enderror py-2 px-4 mt-5 resize-none rounded-sm bg-gray-100 w-full  border border-gray-300 outline-none"/>
           @error('heading')
           <p class="mt-4 text-xs italic text-red-500">
               {{ $message }}
           </p>
           @enderror 
          </div>
       </div>
        <div class="">
          <div class="py-2">
           <textarea wire:model="detail" placeholder="Tell us more about the category..." class="@error('detail')  border-red-500 @enderror  resize-none w-full rounded-sm bg-gray-100 p-3 h-36 border border-gray-300 outline-none"></textarea>
           @error('detail')
           <p class="mt-4 text-xs italic text-red-500">
               {{ $message }}
           </p>
           @enderror 
          </div>
      </div>
      <div class="flex justify-center">  
        <div class="flex flex-row items-center py-2">
          <a href="{{url()->previous()}}"><button type="button" wire:submit.prevent="" class="flex flex-row items-center px-2 py-2 bg-red-400 rounded-md focus:outline-none focus:shadow-outline">
            {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg> --}}
            <span class="ml-1">Cancel</span>
          </button></a>
          <button type="submit" class="flex flex-row items-center px-2 py-2 ml-3 bg-green-400 rounded-md focus:outline-none focus:shadow-outline">
            {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg> --}}
            <span class="ml-1">Create</span>
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
@elseif($editMode==true)
<div>
    <button type="button" wire:click.prevent="viewMode()" class="p-2 pl-5 pr-5 text-lg text-gray-100 bg-blue-800 border-blue-300 rounded-lg focus:border-4">View Categories</button>
   </div>
    <div class="w-1/2 max-w-xl px-4 py-4 mx-auto bg-white rounded-lg shadow-md">
        <div class="flex justify-center">
         <p class="font-bold text-cool-gray-500">Edit Category</p>
        </div>
  
    <form wire:submit.prevent="update">
        <div class="">
          <div class="py-2">
           <input wire:model="heading" placeholder="Category name" class="@error('heading') border-red-500 @enderror w-full  mt-5  py-2 px-4 resize-none rounded-sm bg-gray-100  border border-gray-300 outline-none"/>
           @error('heading')
           <p class="mt-4 text-xs italic text-red-500">
               {{ $message }}
           </p>
           @enderror 
          </div>
       </div>
        <div class="">
          <div class="py-2">
           <textarea wire:model="detail" placeholder="Tell us more about the category..." class="@error('detail')  border-red-500 @enderror py-2 px-4 w-full resize-none rounded-sm bg-gray-100 p-3 h-20 border border-gray-300 outline-none"></textarea>
           @error('detail')
           <p class="mt-4 text-xs italic text-red-500">
               {{ $message }}
           </p>
           @enderror 
          </div>
      </div>
      <div class="flex justify-center">  
        <div class="flex flex-row items-center py-2">
          <button wire:click.prevent="viewMode" type="button" wire:submit.prevent="" class="flex flex-row items-center px-2 py-2 bg-red-400 rounded-md focus:outline-none focus:shadow-outline">
            {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg> --}}
            <span class="ml-1">Cancel</span>
          </button>
          <button type="submit" class="flex flex-row items-center px-2 py-2 ml-3 bg-green-400 rounded-md focus:outline-none focus:shadow-outline">
            {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg> --}}
            <span class="ml-1">Update</span>
          </button>
        </div>
      </div>
    </div>
  </form>
</div>
@endif

</div>
