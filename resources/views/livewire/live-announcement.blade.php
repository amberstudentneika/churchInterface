<div>

    
<div class="w-1/2 max-w-xl px-4 py-4 mx-auto bg-white rounded-lg shadow-md">
    <div class="flex justify-center">
     <p class="font-bold text-cool-gray-500">ANNOUNCEMENT</p>
    </div>
 


<form wire:submit.prevent="onSubmit">
  
    <div class="">
      <div class="py-2">
       <input wire:model="heading" placeholder="Title" class="@error('heading')  border-red-500 @enderror py-2 px-4 w-full mt-5 resize-none rounded-sm bg-gray-100  border border-gray-300 outline-none"/>
       @error('heading')
       <p class="mt-4 text-xs italic text-red-500">
           {{ $message }}
       </p>
       @enderror 
      </div>
   </div>
    <div class="">
      <div class="py-2">
       <textarea wire:model="contents" placeholder="What's on your mind?" class="@error('contents')  border-red-500 @enderror  resize-none rounded-sm bg-gray-100 w-full p-3 h-36 border border-gray-300 outline-none"></textarea>
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
      @if($photo== '') 
        <label class='flex flex-col w-full h-32 border-4 border-dashed cursor-pointer hover:bg-gray-100 hover:border-gray-200 group'>
            <div class='flex flex-col items-center justify-center pt-7'>
                <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <p class='pt-1 text-sm tracking-wider text-gray-400 lowercase group-hover:text-purple-600'>upload either JPG, JPEG or PNG</p>
              </div>
              <input id="photo" wire:model="photo" accept=".jpg,.png,.jpeg" type="file" class="hidden" />
              <div wire:loading wire:target="photo"><span class="px-2 py-2 mt-5 text-white bg-green-300 rounded-md">Uploading..</span></div>
              <p class="mt-4 text-xs italic text-center text-red-500">
                {{ $fileError }}
              </p>
        </label>
        @else
        <div class="flex flex-col mb-5">
            <?php
              $tempPhoto = $photo->getClientOriginalName();
              $extens = substr(strrchr($tempPhoto, '.'), 1);
              $extens = strtoupper($extens);
            ?>
            @if($extens == "PNG" || $extens == "JPG" || $extens == "JPEG")
          <div>
            <img class="object-cover w-48 h-48 border border-indigo-100 rounded-md shadow-lg" src="{{$photo->temporaryUrl()}}">
          </div>
          @endif
          <div>
            <p class='pt-1 text-sm font-bold tracking-wider text-center text-purple-600 lowercase'>{{$photo->getClientOriginalName()}}</p>
          </div>
          <div>
          <p class="mt-4 text-xs italic text-center text-red-500">
            {{ $fileError }}
          </p>
          </div>
          </div>
         @endif 
    </div>
  </div>

 @endif
   

  <div class="flex justify-center">  
    <div class="flex flex-row items-center py-2">
      @if($textPost==false)
      <button type="button" wire:click="showMedia" class="flex flex-row items-center px-2 py-2 bg-blue-400 rounded-md focus:outline-none focus:shadow-outline">
        {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg> --}}
        <span class="ml-1">Add Photo</span>
      </button>
      @elseif($textPost==true)
      <button type="button" wire:click="hideMedia" class="flex flex-row items-center px-2 py-2 bg-red-400 rounded-md focus:outline-none focus:shadow-outline">
        {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg> --}}
        <span class="ml-1">Remove Photo</span>
      </button>
      @endif
      <button   type="submit" class="flex flex-row items-center px-2 py-2 ml-3 bg-green-400 rounded-md focus:outline-none focus:shadow-outline">
        {{-- <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg> --}}
        <span class="ml-1">Post</span>
      </button>
    </div>
  </div>
</form>
</div>


@forelse ($dataAnnounce as $announce)
<div class="grid grid-cols-1 gap-6 px-4 my-6 md:px-6 lg:px-8">

    <div class="w-full max-w-xl px-4 py-4 mx-auto bg-white rounded-lg shadow-md">
      <div class="flex flex-row items-center justify-between py-2">
        <div class="flex flex-row items-center">
        </div>
        <div class="flex flex-row items-center">
            <button type="submit" wire:click.prevent="showEdit({{$announce['id']}})">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
          </button>
@if($viewModal==true)
          {{--Start of modal --}}
          

      <div class="absolute top-0 bottom-0 left-0 right-0 z-10 py-12 transition duration-150 ease-in-out bg-gray-700">
      <div  class="container w-11/12 max-w-lg mx-auto md:w-2/3">
              <div class="relative px-5 py-8 bg-white border border-gray-400 rounded shadow-md md:px-10">
                 
                   <h1 class="mb-4 font-bold leading-tight tracking-normal text-center text-gray-800 font-lg">Edit Post</h1> 
                
                 <label class="text-sm font-bold leading-tight tracking-normal text-gray-800">Heading</label>
                  <input wire:model="heading"  class="flex items-center w-full h-10 pl-3 mt-2 mb-5 text-sm font-normal text-gray-600 border border-gray-300 rounded focus:outline-none focus:border focus:border-indigo-700" placeholder="" />
                 
                 
                  <label for="" class="text-sm font-bold leading-tight tracking-normal text-gray-800">Content</label>
                  <!-- <div class="relative mt-2 mb-5"> -->
                      <textarea wire:model="contents" class="flex items-center w-full px-2 py-4 pl-3 mb-8 text-sm font-normal text-gray-600 border border-gray-300 rounded resize-none h-36 focus:outline-none focus:border focus:border-indigo-700" placeholder="What's on your mind?"></textarea>
                  <!-- </div> -->
                   
                  @if($editPhoto != "no image")
                      <div class="">
                        @if($editPhoto != $editOldPhoto)
                            <?php
                            $tempPhoto = $editPhoto->getClientOriginalName();
                            $extens = substr(strrchr($tempPhoto, '.'), 1);
                            $extens = strtoupper($extens);
                            ?>
                            @if($extens == "PNG" || $extens == "JPG" || $extens == "JPEG")
                            <div>
                              <img class="object-cover border border-indigo-100 shadow-lg" src="{{ $editPhoto->temporaryUrl() }}">
                            </div>
                            <?php $fileError='';?>
                            @endif
                            <p class='pt-1 text-sm font-bold tracking-wider text-center text-purple-600 lowercase'>{{$editPhoto->getClientOriginalName()}}</p>
                            <p class="mt-4 text-xs italic text-center text-red-500">
                              {{ $fileError }}
                            </p>
                        @elseif($editPhoto == $editOldPhoto)
                            <img src="{{url('storage/gallery/storage/'.$editPhoto)}}" class="object-cover border border-indigo-100 shadow-lg"/>
                        @elseif($editPhoto== '')
                            <p class='pt-1 text-sm tracking-wider text-gray-400 lowercase group-hover:text-purple-600'>upload either JPG, JPEG or PNG</p>
                        @endif
                      </div>
                      <div wire:loading wire:target="editPhoto"><span class="px-2 py-2 mt-5 text-white bg-green-300 rounded-md">Uploading..</span></div>
                      <div class="flex justify-center mt-5"> <label class="px-4 py-2 mt-2 mb-5 font-bold text-gray-200 bg-blue-600 rounded-sm">Change photo
                        <input type="file" wire:model="editPhoto"  accept=".jpg,.png,.jpeg" class="hidden">
                      </label>
                      </div>

                      @if(session()->has('error'))
                        <p class="mt-4 text-xs italic text-center text-red-500">
                          {{ session()->get('error') }}
                        </p>
                      @endif
                      @elseif($editPhoto == "no image")
                      <div class="flex justify-center"></label>
                        <div class='flex items-center justify-center w-full'>
                          @if($photo== '') 
                            <label class='flex flex-col w-full h-32 border-4 border-dashed cursor-pointer hover:bg-gray-100 hover:border-gray-200 group'>
                                <div class='flex flex-col items-center justify-center pt-7'>
                                    <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class='pt-1 text-sm tracking-wider text-gray-400 lowercase group-hover:text-purple-600'>upload either JPG, JPEG or PNG</p>
                                  </div>
                                  <input id="photo" wire:model="photo" accept=".jpg,.png,.jpeg" type="file" class="hidden" />
                                  <div wire:loading wire:target="photo"><span class="px-2 py-2 mt-5 text-white bg-green-300 rounded-md">Uploading..</span></div>
                                  <p class="mt-4 text-xs italic text-center text-red-500">
                                    {{ $fileError }}
                                  </p>
                            </label>
                            @else
                            <div class="flex flex-col mb-5">
                                <?php
                                  $tempPhoto = $photo->getClientOriginalName();
                                  $extens = substr(strrchr($tempPhoto, '.'), 1);
                                  $extens = strtoupper($extens);
                                ?>
                                @if($extens == "PNG" || $extens == "JPG" || $extens == "JPEG")
                              <div>
                                <img class="object-cover w-48 h-48 border border-indigo-100 rounded-md shadow-lg" src="{{$photo->temporaryUrl()}}">
                              </div>
                              @endif
                              <div>
                                <p class='pt-1 text-sm font-bold tracking-wider text-center text-purple-600 lowercase'>{{$photo->getClientOriginalName()}}</p>
                              </div>
                              <div>
                              <p class="mt-4 text-xs italic text-center text-red-500">
                                {{ $fileError }}
                              </p>
                              </div>
                              </div>
                            @endif 
                        </div>
                      </div>
                  @endif
                  @if(session()->has('error'))
                  <p class="mt-4 text-xs italic text-center text-red-500">
                    {{ session()->get('error') }}
                  </p>
                  @endif





                  <div class="flex justify-center w-full mt-5">
                      <button wire:click="edit()" type="submit" class="px-8 py-2 text-sm text-white transition duration-150 ease-in-out bg-indigo-700 rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 hover:bg-indigo-600">Finish</button>
                      <button class="px-8 py-2 ml-3 text-sm text-gray-600 transition duration-150 ease-in-out bg-gray-100 border rounded focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 hover:border-gray-400 hover:bg-gray-300" wire:click.prevent="hideModal()">
                          Cancel
                      </button>
                  </div>
                  <button class="absolute top-0 right-0 mt-4 mr-5 text-gray-400 transition duration-150 ease-in-out rounded cursor-pointer hover:text-gray-600 focus:ring-2 focus:outline-none focus:ring-gray-600" wire:click.prevent="hideModal()" aria-label="close modal" role="button">
                      <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" />
                          <line x1="18" y1="6" x2="6" y2="18" />
                          <line x1="6" y1="6" x2="18" y2="18" />
                      </svg>
                  </button>
              </div>
          </div>
      </div>
      {{-- End of modal --}}
          @endif  
          <button type="button" wire:click.prevent="delete({{$announce['id']}})">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
        </div>
      </div>
                <?php 
                if(session()->has('memberImage')){
                  $photo = session()->get('memberImage');
                }else{
                  $photo = "tempProfileImage.png";
                }
                  ?>
      <div class="flex flex-row items-center justify-between py-2">
        <div class="flex flex-row items-center">
          <a href="#" class="flex flex-row items-center rounded-lg focus:outline-none focus:shadow-outline">
            <img class="object-cover w-8 h-8 rounded-full" src="{{url('storage/profileImage/storage/'.$photo)}}" alt="">
            <p class="ml-2 text-base font-medium">{{$announce['member']['name']}}</p>
          </a>
        </div>
        
      </div>
      <div class="py-2">
        <p class="mb-2 font-semibold leading-snug">{{$announce['topic']}}</p>
        <p class="leading-snug">{{$announce['message']}}</p>
      </div>
      <div class="mt-2">
        @if($announce['image']=="no image")
        @elseif($announce['image']!="no image")
            <img class="object-cover w-full rounded-lg" src="{{url('storage/gallery/storage/'.$announce['image'])}}" alt="">
        @endif
          <div class="flex justify-center">
          <div class="flex flex-row items-center py-2"></div>
          </div>
          
          <div class="mt-2">
            <div class="flex justify-center">
            <p class="text-xs font-semibold text-gray-500">{{\Carbon\Carbon::parse($announce['created_at'])->diffForHumans()}}</p>
          </div>
          
        </div>
      </div>
    </div>
    </div>

@empty
    
@endforelse

</div>
