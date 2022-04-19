<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(){
        return view('livewireBlade.liveMember.liveFeed');
    }
    public function announcement(){
        return view('livewireBlade.liveMember.liveAnnouncement');
    }
    public function category(){
        return view('livewireBlade.liveMember.liveCategory');
    }
    public function editProfile(){
        return view('livewireBlade.liveMember.liveEditProfile');
    }
    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }
   
}
