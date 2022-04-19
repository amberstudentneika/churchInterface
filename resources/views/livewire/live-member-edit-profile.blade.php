<div>
    <div class="w-1/2 max-w-xl px-4 py-4 mx-auto bg-white rounded-lg shadow-md">
        <div class="flex justify-center">
         <p class="font-bold text-cool-gray-500">Upload a photo of you</p>
        </div>
    <form wire:submit.prevent="onSubmit">
       
      
        {{-- <div class="flex justify-center">
          <div class="py-2">
           <textarea wire:model="contents" placeholder="What's on your mind?" class="@error('contents')  border-red-500 @enderror  resize-none rounded-sm bg-gray-100 p-3 h-20 border border-gray-300 outline-none"></textarea>
           @error('contents')
           <p class="mt-4 text-xs italic text-red-500">
               {{ $message }}
           </p>
           @enderror 
          </div>
      </div> --}}
          <div class="flex justify-center"> 
            {{-- <label class="mb-1 text-xs font-semibold text-blue-700 uppercase md:text-sm text-light"> --}}
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
            {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg> --}}
            <span class="ml-1">Upload photo</span>
          </button>
        </div>
      </div>
    </div>
  </form>
  
</div>
</div>
