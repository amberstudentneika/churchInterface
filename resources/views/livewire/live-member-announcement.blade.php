<div>

    
   
    @forelse ($dataAnnounce as $announce)
    <div class="grid grid-cols-1 gap-6 px-4 my-6 md:px-6 lg:px-8">
    
        <div class="max-w-xl w-full px-4 py-4 mx-auto bg-white rounded-lg shadow-md">
          <div class="flex flex-row items-center justify-between py-2">
            <div class="flex flex-row items-center">
            </div>
           
          </div>
          <div class="flex flex-row items-center justify-between py-2">
           
            <div class="flex flex-row items-center">
              <a href="#" class="flex flex-row items-center rounded-lg focus:outline-none focus:shadow-outline">
                <img class="object-cover w-8 h-8 rounded-full" src="{{url('storage/profileImage/storage/'.$announce['member']['image'])}}" alt="">
                <p class="ml-2 text-base font-medium">{{$announce['member']['name']}}</p>
              </a>
            </div>
            <div class="flex flex-row items-center">
              <a href="#" class="flex flex-row items-center rounded-lg focus:outline-none focus:shadow-outline">
                <p class="ml-2 text-base font-medium">{{\Carbon\Carbon::parse($announce['created_at'])->diffForHumans()}}</p>
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
           
              
            </div>
          </div>
        </div>
  
    
    @empty
        
    @endforelse
    
    </div>
    