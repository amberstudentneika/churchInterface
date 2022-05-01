<div>

<div class="grid grid-cols-2">

    <div class="">
      <div class="">
        @forelse ( $dataPost as $post )
        <div class="mt-6">
          
            <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg shadow-md">
              <div class="flex flex-row items-center justify-between py-2">
                <div class="flex flex-row items-center">
                </div>
                <div class="flex flex-row items-center">
                  <p class="text-xs font-semibold text-gray-500">Posted: {{\Carbon\Carbon::parse($post['created_at'])->diffForHumans()}}</p>
                </div>
              </div>



                <div class="flex items-center justify-between">
                  <a href="#" class="flex flex-row items-center rounded-lg focus:outline-none focus:shadow-outline">
                    <img class="object-cover w-8 h-8 rounded-full" src="{{url('storage/profileImage/storage/'.$post['member']['image'])}}" alt="">
                    <p class="ml-2 text-base font-medium">{{$post['member']['firstname']." ".$post['member']['lastname']}}</p>
                  </a>
                <span class="font-light text-gray-600"></span>
                  <a href="#"
                        class="px-2 py-1 font-bold text-gray-100 bg-gray-600 rounded hover:bg-gray-500">
                      @forelse ($dataCategory as $category )
                        @if($category['id']==$post['topic']['categoryID'])
                        {{$category['name']}}
                        @endif
                      @empty
                        No Category Created
                      @endforelse
                      </a>
                </div>
                <div class="mt-2"><a href="#" class="text-2xl font-bold text-gray-700 hover:underline">
                  {{$post['topic']['name']}}</a>
                    <p class="mt-2 text-gray-600">
                      {{$post['body']}}
                    </p>
                </div>
                <div class="mt-2"><a href="#" class="text-2xl font-bold text-gray-700 hover:underline">
                  @if($post['image']=="no image")
                  @elseif($post['image']!="no image")
                  <img class="object-cover w-full rounded-lg" src="{{url('storage/gallery/storage/'.$post['image'])}}" alt="">
                  @endif</a>
                    <p class="mt-2 text-gray-600">
                    </p>
                </div>
                <div class="flex justify-center">
                  <div class="flex flex-row items-center py-2">
                    <button wire:click="like({{$post['id']}})" type="submit" class="flex flex-row items-center rounded-lg focus:outline-none focus:shadow-outline">
                      <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                      <span class="ml-1">{{$post['totalLikes']}}</span>
                    </button>
                    <button wire:click="showComment({{$post['id']}})" class="flex flex-row items-center ml-3 rounded-lg focus:outline-none focus:shadow-outline">
                      <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5"><path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                      <span class="ml-1">{{$post['totalComments']}}</span>
                    </button>
                  </div>
                  </div>

                  <div class="mt-2">
                    <div class="flex justify-center">
                    {{-- <input wire:model.defer="comment" type="text" placeholder="Make a comment.." class="w-2/4 px-2 py-1 mr-2 border border-gray-200 rounded-sm"/>
                    @if($editCommentInput == false)
                    <button wire:click="submitComment({{$post['id']}})" type="submit" class="px-2 py-2 bg-green-500 rounded-sm focus:outline-none focus:shadow-outline">Post</button>
                    @elseif($editCommentInput == true)
                    <button wire:click="editComment()" type="submit" class="px-2 py-2 bg-green-500 rounded-sm focus:outline-none focus:shadow-outline">Edit comment</button>
                    @endif

                    @if($showComments==false)
                    <button wire:click="showComment({{$post['id']}})" type="button" class="px-2 py-2 ml-1 bg-blue-500 rounded-sm focus:outline-none focus:shadow-outline">See Comment(s)</button>
                    @elseif($showComments==true)
                        @if($showCom==$post['id'])
                             @if($editCommentInput == false)
                              <button wire:click="hideComment({{$post['id']}})" type="submit" class="px-2 py-2 ml-1 bg-red-500 rounded-sm focus:outline-none focus:shadow-outline">Hide Comment(s)</button>
                              @elseif($editCommentInput == true)
                              <button wire:click="hideEditCommentInput()" type="submit" class="px-2 py-2 ml-1 bg-red-500 rounded-sm focus:outline-none focus:shadow-outline">Cancel</button>
                              @endif
                        
                        @elseif($showCom!=$post['id'])
                            <button wire:click="showComment({{$post['id']}})" type="button" class="px-2 py-2 ml-1 bg-blue-500 rounded-sm focus:outline-none focus:shadow-outline">See Comment(s)</button>
                        @endif
                    @endif --}}
                   
                    @if($showCom!=$post['id'])  
                    <input wire:model.defer="comment"  type="text" placeholder="Make a comment.." class="w-2/4 px-2 py-1 mr-2 border border-gray-200 rounded-sm"/>
                    <button wire:click="submitComment({{$post['id']}})" type="button" class="px-2 py-2 bg-green-500 rounded-sm focus:outline-none focus:shadow-outline">Post</button>
                    @elseif($editCommentInput==true) 
                    <input wire:model.defer="edComment"  type="text" placeholder="Make a comment.." class="w-2/4 px-2 py-1 mr-2 border border-gray-200 rounded-sm"/> 
                    <button wire:click="editComment()" type="submit" class="px-2 py-2 bg-green-500 rounded-sm focus:outline-none focus:shadow-outline">Edit Comment</button>
                    @endif  

                   
                      
                    @if($showComments==false)
                    <button wire:click="showComment({{$post['id']}})" type="button" class="px-2 py-2 ml-1 bg-blue-500 rounded-sm focus:outline-none focus:shadow-outline">See Comment(s)</button>
                    @elseif($showComments==true)
                        @if($showCom==$post['id'])
                            @if($editCommentInput == false)
                            <div class=" mx-40 ">
                            <button wire:click="hideComment({{$post['id']}})" type="submit" class="w-full flex justify-center px-2 py-2 ml-1 bg-red-500 rounded-sm focus:outline-none focus:shadow-outline">Hide Comment(s)</button>
                            </div>
                            @elseif($editCommentInput == true)
                            <button wire:click="hideEditCommentInput()" type="submit" class="px-2 py-2 ml-1 bg-red-500 rounded-sm focus:outline-none focus:shadow-outline">Cancel</button>
                            @endif
                        @elseif($showCom!=$post['id'])
                            <button wire:click="showComment({{$post['id']}})" type="button" class="px-2 py-2 ml-1 bg-blue-500 rounded-sm focus:outline-none focus:shadow-outline">See Comment(s)</button>
                        @endif
                    @endif
                  </div>
               </div>
            

             
                  @if($showComments==true)
                  @if($showCom==$post['id'])
                    <div class="mt-2">
                        @if($showCom!=null)
                        <div class="flex max-w-lg p-4 antialiased text-black bg-white dark:bg-gray-800 dark:text-gray-200">
                              <div>
                                @forelse($dataComment as $comment)
                                  @if($comment['postID']==$showCom)
                                  
                                  <div class="flex items-stretch">
                                    <div>
                                      <img class="w-8 h-8 mt-1 mr-2 rounded-full " src="{{url('storage/profileImage/storage/'.$comment['member']['image'])}}"/>
                                    </div>
                                    <div class="self-auto bg-gray-100 dark:bg-gray-700 rounded-3xl px-4 pt-2 pb-2.5">
                                      <div class="text-sm font-semibold leading-relaxed">
                                        {{$comment['member']['firstname']." ".$comment['member']['lastname']}}
                                      </div>
                                      {{$comment['body']}}
                                      <?php $memberID = session()->get('memberID') ?>
                                      @if($comment['memberID']== $memberID)
                                      <div>
                                        <button  wire:click="showEditComment({{$comment['id']}})" class="text-blue-500">edit</button>
                                        <button wire:click="deleteComment({{$comment['id']}},'{{$comment['postID']}}')" class="text-red-500">delete</button>
                                      </div>
                                        @endif
                                    </div>
                                  </div>

                                    <div class="text-sm ml-12 mt-0.5 mb-4 text-gray-500 dark:text-gray-400">
                                      {{\Carbon\Carbon::parse($comment['created_at'])->diffForHumans()}}
                                    </div>
                                 

                                  @endif
                                @empty
                                @endforelse
                              
                            </div>
                          </div>
                        @endif
                      </div>
                    @endif
                    @endif
            </div>
                  </div>
      @empty
        @endforelse
    </div>
    </div>
{{-- ======================================================================================================== --}}

    <div class="">


      {{-- Right Column Start --}}
         <div class="px-8">
           <h1 class="mb-4 text-xl font-bold text-gray-700">Authors</h1>
            <div class="flex flex-col max-w-sm px-6 py-4 mx-auto bg-white rounded-lg shadow-md">
                <ul class="-mx-4">
                  @forelse($dataMembers as $authors)
                  @if($authors['totalPosts']!=0)
                  <li class="flex items-center"><img
                    src="{{url('storage/profileImage/storage/'.$authors['image'])}}"
                    alt="profile" class="object-cover w-10 h-10 mx-4 rounded-full">
                  <p><a href="#" class="mx-1 font-bold text-gray-700 hover:underline">{{$authors['firstname']." ".$authors['lastname']}}</a><span
                        class="text-sm font-light text-gray-700">Created {{$authors['totalPosts']}} Posts</span></p>
                  </li>
                  @endif
                  @empty
                  <li class="flex items-center">
                  <span class="text-sm font-light text-gray-700">No post created</span></p>
                  </li>
                  @endforelse
                    
                </ul>
            </div>
        </div>
        <div class="px-8 mt-10">
            <h1 class="mb-4 text-xl font-bold text-gray-700">Categories</h1>
            <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
                <ul>
                  @forelse ($dataCategory as $category)
                    <li><a href="#" class="mx-1 font-bold text-gray-700 hover:text-gray-600 hover:underline">-
                      {{$category['name']}}</a></li>
                    
                  @empty
                    <li class="mt-2"><a href="#"
                            class="text-sm font-light text-gray-700e">-
                            No category created</a></li>
                    
                  @endforelse
                  
                </ul>
            </div>
        </div>
        <div class="px-8 mt-10">
            <h1 class="mb-4 text-xl font-bold text-gray-700">Recent Announcement</h1>
            {{-- @forelse ( $dataAnnouncement as $dataAnnouncement ) --}}
              <div class="flex flex-col max-w-sm px-8 py-6 mx-auto bg-white rounded-lg shadow-md">
                <div class="flex items-center justify-center">
                  <a href="#"  class="px-2 py-1 text-sm text-green-100 bg-gray-600 rounded hover:bg-gray-500">{{$dataAnnouncement['topic']}}</a>
                </div>
                <div class="mt-4"><a href="#" class="text-lg font-medium text-gray-700 hover:underline">
                  {{$dataAnnouncement['message']}}</a></div>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center"><img
                            src="{{url('storage/profileImage/storage/'.$dataAnnouncement['member']['image'])}}"
                            alt="avatar" class="object-cover w-8 h-8 rounded-full"><a href="#"
                            class="mx-3 text-sm text-gray-700 hover:underline">{{$dataAnnouncement['member']['firstname']." ".$dataAnnouncement['member']['lastname']}}</a></div><span
                        class="text-sm font-light text-gray-600">{{\Carbon\Carbon::parse($dataAnnouncement['created_at'])->diffForHumans()}}</span>
                </div>
            </div>
            {{-- @empty
            <div class="flex flex-col max-w-sm px-4 py-6 mx-auto bg-white rounded-lg shadow-md">
              <div class="mt-4"><p class="text-sm font-light text-gray-700">- No recent post</p></div>
          </div>
            @endforelse --}}
        </div>
     
    </div>
    </div> 
</div>


