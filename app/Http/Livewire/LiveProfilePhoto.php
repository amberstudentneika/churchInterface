<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class LiveProfilePhoto extends Component
{
    use WithFileUploads;

    public $photo;

    public function clearField(){
    $this->photo='';
    }
    
    public function onSubmit(){
        $ch=curl_init();
        
        $photo=$this->photo->getClientOriginalName();
        $this->photo->storePubliclyAs('storage',$photo,'profileImage');
        
        $url = 'http://192.168.0.2:8081/api/upload/profileimage/store';
        $memberID = session()->get('memberID');
        $data=array(
            'memberID'=>$memberID,
            'photo'=>$photo,
        );
        
          http_build_query($data);
          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_POST,true);
          curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  
          $results = curl_exec($ch); 
          $results = json_decode($results,true);
  
          curl_close($ch);
          session()->put('memberImage',$photo);
          redirect()->route('adminFeed');
        $this->clearField();
    }
    public function render()
    {
        return view('livewire.live-profile-photo');
    }
}
