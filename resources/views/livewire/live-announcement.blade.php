<div>
    {{-- The best athlete wants his opponent at his best. --}}
<!-- component -->
<div class="max-w-xl mx-auto px-4 py-4 bg-white w-1/2 shadow-md rounded-lg">
    <div class="flex justify-center">
     <p class="text-cool-gray-500 font-bold">ANNOUNCEMENT</p>
    </div>
 


<form wire:submit.prevent="onSubmit">
  
    <div class="flex justify-center">
      <div class="py-2">
       <input wire:model="heading" placeholder="Title" class="@error('heading')  border-red-500 @enderror  resize-none rounded-sm bg-gray-100  border border-gray-300 outline-none"/>
       @error('heading')
       <p class="text-red-500 text-xs italic mt-4">
           {{ $message }}
       </p>
       @enderror 
      </div>
   </div>
    <div class="flex justify-center">
      <div class="py-2">
       <textarea wire:model="contents" placeholder="What's on your mind?" class="@error('contents')  border-red-500 @enderror  resize-none rounded-sm bg-gray-100 p-3 h-20 border border-gray-300 outline-none"></textarea>
       @error('contents')
       <p class="text-red-500 text-xs italic mt-4">
           {{ $message }}
       </p>
       @enderror 
      </div>
  </div>
  @if($textPost==true)
      <div class="flex justify-center"></label>
        {{-- <label class="uppercase md:text-sm text-xs text-blue-700 text-light font-semibold mb-1"> --}}
          <div class='flex items-center justify-center w-full'>
              <label class=' flex flex-col border-4 border-dashed w-full h-32 cursor-pointer hover:bg-gray-100 hover:border-gray-200 group'>
                  <div class='flex flex-col items-center justify-center pt-7'>
                      <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                   @if($photo== '') 
                   <p class='lowercase text-sm text-gray-400 group-hover:text-purple-600 pt-1 tracking-wider'>upload either JPG, JPEG, PDF file</p>
                   @else
                   <p class='lowercase text-sm text-purple-600 pt-1 tracking-wider'>{{$photo->getClientOriginalName()}}</p>
                  @endif
                  </div>
                  <input wire:model="photo" type="file" class="hidden" />
              </label>  
          </div>
        </div>
        @error('photo')
        <p class="text-red-500 text-xs italic mt-4">
            {{ "*required" }}
        </p>
        @enderror 
      @endif
 
  <div class="flex justify-center">  
    <div class="py-2 flex flex-row items-center">
      @if($textPost==false)
      <button type="button" wire:click="showMedia" class="flex flex-row items-center focus:outline-none focus:shadow-outline py-2 px-2 rounded-md bg-blue-400">
        {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg> --}}
        <span class="ml-1">Add Photo/Video</span>
      </button>
      @elseif($textPost==true)
      <button type="button" wire:click="hideMedia" class="flex flex-row items-center focus:outline-none focus:shadow-outline py-2 px-2 rounded-md bg-red-400">
        {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg> --}}
        <span class="ml-1">Remove Photo/Video</span>
      </button>
      @endif
      <button wire:click="onSubmit" type="submit" class="flex flex-row items-center focus:outline-none focus:shadow-outline py-2 px-2 rounded-md bg-green-400 ml-3">
        {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg> --}}
        <span class="ml-1">Post</span>
      </button>
    </div>
  </div>
</div>
</form>
</div>




<div class="flex justify-center">
<div class="max-w-md py-4 px-8 bg-white shadow-lg rounded-lg my-20">
    <div class="flex justify-center md:justify-end -mt-16">
      <img class="w-20 h-20 object-cover rounded-full border-2 border-indigo-500" src="https://images.unsplash.com/photo-1499714608240-22fc6ad53fb2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80">
    </div>
    <div>
      <h2 class="text-gray-800 text-3xl font-semibold">Design Tools</h2>
      <p class="mt-2 text-gray-600">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae dolores deserunt ea doloremque natus error, rerum quas odio quaerat nam ex commodi hic, suscipit in a veritatis pariatur minus consequuntur!</p>
    </div>
    <div class="mt-2">
      <img class="object-cover w-full rounded-lg" src="https://images.unsplash.com/photo-1586398710270-760041494553?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=80" alt="">
    </div>
    <div class="flex justify-end mt-4">
      <a href="#" class="text-xl font-medium text-indigo-500"><span class="text-gray-700">Posted by:</span> John Doe</a>
    </div>
  </div>
</div>
</div>
