<div>
  {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
 
      <!-- component -->
      <div class="grid grid-cols-1 gap-6 my-6 px-4 md:px-6 lg:px-8">


          <div class="max-w-xl mx-auto px-4 py-4 bg-white w-1/2 shadow-md rounded-lg">
                <div class="flex justify-center">
                 <p class="text-cool-gray-500 font-bold">POST</p>
                </div>
             
          
  @forelse ( $dataPost as $post )
          <div class="max-w-xl mx-auto px-4 py-4 bg-white shadow-md rounded-lg">
            <div class="py-2 flex flex-row items-center justify-between">
              <div class="flex flex-row items-center">
                <a href="#" class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
                  <img class="rounded-full h-8 w-8 object-cover" src="https://images.unsplash.com/photo-1520065786657-b71a007dd8a5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=80" alt="">
                  <p class="ml-2 text-base font-medium">Jon Doe</p>
                </a>
              </div>
              <div class="flex flex-row items-center">
                <p class="text-xs font-semibold text-gray-500">{{\Carbon\Carbon::parse($post['created_at'])->diffForHumans()}}</p>
              </div>
            </div>
            <div class="py-2">
              <p class="leading-snug font-semibold mb-2">{{$post['topic']['name']}}</p>
              <p class="leading-snug">{{$post['body']}}</p>
            </div>
            <div class="mt-2">
              <img class="object-cover w-full rounded-lg" src="https://images.unsplash.com/photo-1586398710270-760041494553?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=80" alt="">
              <div class="flex justify-center">
                <div class="py-2 flex flex-row items-center">
                  <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    <span class="ml-1">3431</span>
                  </button>
                  <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    <span class="ml-1">566</span>
                  </button>
                </div>
                </div>
                
                <div class="mt-2">
                  <div class=" flex justify-center">
                  <input type="text" placeholder="Make a comment.." class="border border-gray-200 w-2/4 mr-2 py-1 px-2 rounded-sm"/>
                  <button class="focus:outline-none focus:shadow-outline bg-blue-500 rounded-sm py-2 px-2">Post Comment</button>
                </div>
              </div>
            </div>
          </div>
      @empty
        
      @endforelse
      
          {{-- <div class="max-w-xl mx-auto px-4 py-4 bg-white shadow-md rounded-lg">
            <div class="py-2 flex flex-row items-center justify-between">
              <div class="flex flex-row items-center">
                <a href="#" class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
                  <img class="rounded-full h-8 w-8 object-cover" src="https://images.unsplash.com/photo-1520065786657-b71a007dd8a5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=80" alt="">
                  <p class="ml-2 text-base font-medium">Jon Doe</p>
                </a>
              </div>
              <div class="flex flex-row items-center">
                <p class="text-xs font-semibold text-gray-500">2 hours ago</p>
              </div>
            </div>
            <div class="py-2">
              <p class="leading-snug">Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, ratione dicta deleniti, quas distinctio, veniam quo rem eveniet aliquid repudiandae fuga asperiores reiciendis tenetur? Eius quidem impedit et soluta accusamus.</p>
            </div>
            <div>
              <div class="flex justify-center">
              <div class="py-2 flex flex-row items-center">
                <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                  <span class="ml-1">3431</span>
                </button>
                <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                  <span class="ml-1">566</span>
                </button>
              </div>
              </div>
            </div>
            <div class="mt-2">
              <div class=" flex justify-center">
              <input type="text" placeholder="Make a comment.." class="border border-gray-200 w-2/4 mr-2 py-1 px-2 rounded-sm"/>
              <button class="focus:outline-none focus:shadow-outline bg-blue-500 rounded-sm py-2 px-2">Post Comment</button>
            </div>
          </div>
          </div>
       --}}
          {{-- <div class="max-w-xl mx-auto px-4 py-4 bg-white shadow-md rounded-lg">
            <div class="py-2 flex flex-row items-center justify-between">
              <div class="flex flex-row items-center">
                <a href="#" class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
                  <img class="rounded-full h-8 w-8 object-cover" src="https://images.unsplash.com/photo-1520065786657-b71a007dd8a5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=80" alt="">
                  <p class="ml-2 text-base font-medium">Jon Doe</p>
                </a>
              </div>
              <div class="flex flex-row items-center">
                <p class="text-xs font-semibold text-gray-500">2 hours ago</p>
              </div>
            </div>
            <div class="mt-2">
              <img class="object-cover w-full rounded-lg" src="https://images.unsplash.com/photo-1586398710270-760041494553?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1280&q=80" alt="">
              <div class="flex justify-center">
              <div class="py-2 flex flex-row items-center">
                <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg">
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                  <span class="ml-1">3431</span>
                </button>
                <button class="flex flex-row items-center focus:outline-none focus:shadow-outline rounded-lg ml-3">
                  <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                  <span class="ml-1">566</span>
                </button>
              </div>
            </div>
            </div>
            <div class="mt-2">
              <div class=" flex justify-center">
              <input type="text" placeholder="Make a comment.." class="border border-gray-200 w-2/4 mr-2 py-1 px-2 rounded-sm"/>
              <button class="focus:outline-none focus:shadow-outline bg-blue-500 rounded-sm py-2 px-2">Post Comment</button>
            </div>
          </div>
          </div> --}}
        </div>
      </div>
