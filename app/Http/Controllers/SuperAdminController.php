<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function administrator(){
        return view('livewireBlade.liveSuperAdmin.liveAdministrator');
    }
    public function index(){
        return view('livewireBlade.liveSuperAdmin.liveSuperAdminFeed');
    }
    public function editProfPhotoAdmin(){
        return view('livewireBlade.liveSuperAdmin.liveProfilePhoto');
    }
    public function category(){
        return view('livewireBlade.liveSuperAdmin.liveCategory');
    }
    public function announcement(){
        return view('livewireBlade.liveSuperAdmin.liveSuperAdminAnnouncement');
    }

}
