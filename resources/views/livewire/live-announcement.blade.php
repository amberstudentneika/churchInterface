<div>
    {{-- The best athlete wants his opponent at his best. --}}
<!-- component -->
<div class="grid grid-cols-1 gap-6 px-4 my-6 md:px-6 lg:px-8">

<div class="w-1/2 max-w-xl px-4 py-4 mx-auto bg-white rounded-lg shadow-md">
    <div class="flex justify-center">
     <p class="font-bold text-cool-gray-500">ANNOUNCEMENT</p>
    </div>
 


<form wire:submit.prevent="onSubmit">
  
    <div class="flex justify-center">
      <div class="py-2">
       <input wire:model="heading" placeholder="Title" class="@error('heading')  border-red-500 @enderror  resize-none rounded-sm bg-gray-100  border border-gray-300 outline-none"/>
       @error('heading')
       <p class="mt-4 text-xs italic text-red-500">
           {{ $message }}
       </p>
       @enderror 
      </div>
   </div>
    <div class="flex justify-center">
      <div class="py-2">
       <textarea wire:model="contents" placeholder="What's on your mind?" class="@error('contents')  border-red-500 @enderror  resize-none rounded-sm bg-gray-100 p-3 h-20 border border-gray-300 outline-none"></textarea>
       @error('contents')
       <p class="mt-4 text-xs italic text-red-500">
           {{ $message }}
       </p>
       @enderror 
      </div>
  </div>
  @if($textPost==true)
      <div class="flex justify-center"></label>
          <div class='flex items-center justify-center w-full'>
              <label class='flex flex-col w-full h-32 border-4 border-dashed cursor-pointer hover:bg-gray-100 hover:border-gray-200 group'>
                  <div class='flex flex-col items-center justify-center pt-7'>
                      <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                   @if($photo== '') 
                   <p class='pt-1 text-sm tracking-wider text-gray-400 lowercase group-hover:text-purple-600'>upload either JPG, JPEG, PDF file</p>
                   @else
                   <p class='pt-1 text-sm tracking-wider text-purple-600 lowercase'>{{$photo->getClientOriginalName()}}</p>
                  @endif
                  </div>
                  <input wire:model="photo" type="file" class="hidden" />
              </label>  
          </div>
        </div>
      @endif
      @if(session()->has('error'))
      <p class="mt-4 text-xs italic text-center text-red-500">
        {{ session()->get('error') }}
      </p>
      @endif
      
  <div class="flex justify-center">  
    <div class="flex flex-row items-center py-2">
      @if($textPost==false)
      <button type="button" wire:click="showMedia" class="flex flex-row items-center px-2 py-2 bg-blue-400 rounded-md focus:outline-none focus:shadow-outline">
        {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg> --}}
        <span class="ml-1">Add Photo/Video</span>
      </button>
      @elseif($textPost==true)
      <button type="button" wire:click="hideMedia" class="flex flex-row items-center px-2 py-2 bg-red-400 rounded-md focus:outline-none focus:shadow-outline">
        {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg> --}}
        <span class="ml-1">Remove Photo/Video</span>
      </button>
      @endif
      <button wire:click="onSubmit" type="submit" class="flex flex-row items-center px-2 py-2 ml-3 bg-green-400 rounded-md focus:outline-none focus:shadow-outline">
        {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg> --}}
        <span class="ml-1">Post</span>
      </button>
    </div>
  </div>
</form>
</div>
</div>





@forelse ($dataAnnounce as $announce)
<div class="grid grid-cols-1 gap-6 px-4 my-6 md:px-6 lg:px-8">

<div class="max-w-xl px-4 py-4 mx-auto bg-white rounded-lg shadow-md">
    <div class="flex flex-row items-center justify-between py-2">
      <div class="flex flex-row items-center">
      </div>
      <div class="flex flex-row items-center">
          <button type="button" wire:click.prevent="showEdit({{$announce['id']}})">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </button>
        <button type="button" wire:click.prevent="delete({{$announce['id']}})">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
        </button>
      </div>
    </div>
    <div class="flex flex-row items-center justify-between py-2">
      <div class="flex flex-row items-center">
        <a href="#" class="flex flex-row items-center rounded-lg focus:outline-none focus:shadow-outline">
          <img class="object-cover w-8 h-8 rounded-full" src="{{url('backgroundImage/tempProfileImage.png')}}" alt="">
          <p class="ml-2 text-base font-medium">memb</p>
        </a>
      </div>
      <div class="flex flex-row items-center">
        {{-- <p class="text-xs font-semibold text-gray-500">{{\Carbon\Carbon::parse($post['created_at'])->diffForHumans()}}</p> --}}
      </div>
    </div>
    <div class="py-2">
      <p class="mb-2 font-semibold leading-snug">topic</p>
      <p class="leading-snug">cont</p>
    </div>
    <div class="mt-2">
      {{-- @if($post['image']=="no image") --}}
      {{-- <img class="object-cover w-full rounded-lg" src="https://images.unsplash.com/photo-1586398710270-760041494553?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=80" alt=""> --}}
      {{-- @elseif($post['image']!="no image")
      <img class="object-cover w-full rounded-lg" src="{{url('storage/gallery/storage/'.$post['image'])}}" alt="">
      @endif --}}
    
        
        
</div>
</div>
</div>

{{-- <div class="flex justify-center">
    <div class="max-w-md px-8 py-4 my-20 bg-white rounded-lg shadow-lg">
    <div class="flex justify-center -mt-16 md:justify-end">
      <img class="object-cover w-20 h-20 border-2 border-indigo-500 rounded-full" src="{{url('backgroundImage/tempProfileImage.png')}}">
    </div>
    <div>
      <h2 class="text-3xl font-semibold text-gray-800">{{$announce['topic']}}</h2>
      <p class="mt-2 text-gray-600">{{$announce['message']}}</p>
    </div>
    <div class="mt-2">
        @if($announce['image']=="no image")
        @elseif($announce['image']!="no image")
            <img class="object-cover w-full rounded-lg" src="https://images.unsplash.com/photo-1586398710270-760041494553?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=80" alt="">
        @endif
    </div>
    <div class="flex justify-end mt-4">
      <a href="#" class="text-xl font-medium text-indigo-500"><span class="text-gray-700">Posted by:</span> {{$announce['member']['name']}}</a>
    </div>
  </div>  
  
</div> --}}



@empty
    
@endforelse
</div>
