<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('livewireBlade.liveAdmin.liveFeed');
    }
    public function category(){
        return view('livewireBlade.liveAdmin.liveCategory');
    }

}
