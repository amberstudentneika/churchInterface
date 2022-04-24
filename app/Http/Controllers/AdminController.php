<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('livewireBlade.liveAdmin.liveFeed');
    }
    public function editProfPhotoAdmin(){
        return view('livewireBlade.liveAdmin.liveProfilePhoto');
    }
    public function category(){
        return view('livewireBlade.liveAdmin.liveCategory');
    }
    public function announcement(){
        return view('livewireBlade.liveAdmin.liveAnnouncement');
    }
    public function logout(){
        session()->flush();
        return redirect()->route('login');
    }
}
