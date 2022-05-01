<div>
    
 @if($viewMember==true)
<section class="h-screen px-4 antialiased text-gray-600">
       <div>
        <button type="button" wire:click.prevent="hideMemberMode()" class="p-2 pl-5 pr-5 mb-2 text-lg text-gray-100 bg-blue-800 border-blue-300 rounded-lg focus:border-4">View Administrators</button>
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
                <h2 class="font-semibold text-gray-800">Members</h2>

            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="text-xs font-semibold text-gray-400 uppercase bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Member</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Gender</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Posts</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Date Joined</div>
                                </th>
                                <th colspan='1' class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">action</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse ($userData as $info)
                            @if($info['role']==0)
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10 mr-2 sm:mr-3"><img class="rounded-full" src="{{url('storage/profileImage/storage/'.$info['image'])}}" width="40" height="40" alt="Alex Shatov"></div>
                                        <div class="font-medium text-gray-800">{{$info['firstname']." ".$info['lastname']}}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$info['gender']}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$info['totalPosts']}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{date('F d, Y', strtotime($info['created_at']))}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <button wire:click.prevent="makeAdmin({{$info['id']}})" class="p-2 pl-5 pr-5 text-gray-100 bg-blue-500 border-blue-300 rounded-lg text-md focus:border-4">Make Admin</button>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <button wire:click.prevent="removeUser({{$info['id']}})" class="p-2 pl-5 pr-5 text-gray-100 bg-red-500 border-red-300 rounded-lg text-md focus:border-4">De-Activate</button>
                                </td>
                            </tr>
                            @endif
                            @empty
                                 <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left text-gray-400">No members joined.</div>
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
@endif

{{-- ------------------------------------------------- --}}

@if($viewAdmin==false)
<section class="h-screen px-4 antialiased text-gray-600">
       <div>
        <button type="button" wire:click.prevent="showMemberMode()" class="p-2 pl-5 pr-5 mb-2 text-lg text-gray-100 bg-blue-800 border-blue-300 rounded-lg focus:border-4">view Members</button>
        <button type="button" wire:click.prevent="showDeactivatedUsers()" class="p-2 pl-5 pr-5 mb-2 text-lg text-gray-100 bg-indigo-800 border-blue-300 rounded-lg focus:border-4">view Deativated users</button>
       </div>
       {{-- <div>
        <button type="button" wire:click.prevent="" class="p-2 pl-5 pr-5 text-lg text-gray-100 bg-blue-800 border-blue-300 rounded-lg focus:border-4">Category +</button>
       </div> --}}
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
                <h2 class="font-semibold text-gray-800">Administrators</h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="text-xs font-semibold text-gray-400 uppercase bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Member</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Gender</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Posts</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Date Joined</div>
                                </th>
                                <th colspan='1' class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">action</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse ($userData as $info)
                            @if($info['role']==1)
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10 mr-2 sm:mr-3"><img class="rounded-full" src="{{url('storage/profileImage/storage/'.$info['image'])}}" width="40" height="40" alt="Alex Shatov"></div>
                                        <div class="font-medium text-gray-800">{{$info['firstname']." ".$info['lastname']}}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$info['gender']}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$info['totalPosts']}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{date('F d, Y', strtotime($info['created_at']))}}</div>
                                </td>
                                
                                <td class="p-2 whitespace-nowrap">
                                    <button wire:click.prevent="revokeRole({{$info['id']}})" class="p-2 pl-5 pr-5 text-gray-100 bg-blue-500 border-blue-300 rounded-lg text-md focus:border-4">Revoke Role</button>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <button wire:click.prevent="removeUser({{$info['id']}})" class="p-2 pl-5 pr-5 text-gray-100 bg-red-500 border-red-300 rounded-lg text-md focus:border-4">De-Activate</button>
                                </td>
                            </tr>
                            @endif
                            @empty
                                 <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left text-gray-400">No administrators found.</div>
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
@endif

@if($viewDeactivatedUsers==true)
<section class="h-screen px-4 antialiased text-gray-600">
       <div>
        <button type="button" wire:click.prevent="hideDeactivatedUsers()" class="p-2 pl-5 pr-5 mb-2 text-lg text-gray-100 bg-red-800 border-blue-300 rounded-lg focus:border-4">Return</button>
       </div>
       {{-- <div>
        <button type="button" wire:click.prevent="" class="p-2 pl-5 pr-5 text-lg text-gray-100 bg-blue-800 border-blue-300 rounded-lg focus:border-4">Category +</button>
       </div> --}}
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
                <h2 class="font-semibold text-gray-800">All Deactivated Users</h2>
            </header>
            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto">
                        <thead class="text-xs font-semibold text-gray-400 uppercase bg-gray-50">
                            <tr>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Member</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Gender</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Posts</div>
                                </th>
                                <th class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-left">Date Joined</div>
                                </th>
                                <th colspan='1' class="p-2 whitespace-nowrap">
                                    <div class="font-semibold text-center">action</div>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse ($inactiveUserData as $info)
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10 mr-2 sm:mr-3"><img class="rounded-full" src="{{url('storage/profileImage/storage/'.$info['image'])}}" width="40" height="40" alt="Alex Shatov"></div>
                                        <div class="font-medium text-gray-800">{{$info['firstname']." ".$info['lastname']}}</div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$info['gender']}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{$info['totalPosts']}}</div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left">{{date('F d, Y', strtotime($info['created_at']))}}</div>
                                </td>
                                
                                <td class="p-2 whitespace-nowrap">
                                    <button wire:click.prevent="ReactivateUsers({{$info['id']}})" class="p-2 pl-5 pr-5 text-gray-100 bg-red-500 border-red-300 rounded-lg text-md focus:border-4">Re-Activate</button>
                                </td>
                            </tr>
                            @empty
                                 <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <td class="p-2 whitespace-nowrap">
                                        <div class="text-left text-gray-400">No administrators found.</div>
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
@endif

</div>
