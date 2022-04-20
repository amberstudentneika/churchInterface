<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view('livewireBlade.liveRegister');
    }
    public function errorAlert(){
        return view('errorAlert');
    }
}
