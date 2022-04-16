<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveAnnouncement extends Component
{
    public $heading, $contents, $photo, $oldPhoto;
    public $textPost=false;
    
    
    public function showMedia(){
        $this->textPost = true;        
    }
    public function hideMedia(){
        $this->textPost = false;    
        $this->photo='';    
    }
   
    public function clearField(){
        $this->heading='';
        $this->contents='';
        $this->photo=''; 
        $this->oldPhoto='';
       
    } 
    protected $rules=[
        'heading' => 'required',
        'contents' => 'required',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function onSubmit(){
        $this->validate();
        
        if($this->textPost == true){
            if($this->photo==null){
              session()->flash('error','Upload photo/video or click "remove" button.');
          }
        }
  
          $ch=curl_init();
          $url = 'http://192.168.0.4:8081/api/announcement/store';
          
          if($this->photo!='' || $this->photo!=null){
              $photo=$this->photo->getClientOriginalName();
              $this->photo->storePubliclyAs('storage',$photo,'gallery');
          }elseif($this->photo=='' || $this->photo==null){
              $photo=$this->photo;
          }
          $memberID = session()->get('memberID');
          $data=array(
              'memberID'=>$memberID,
              'heading'=>$this->heading,
              'contents'=>$this->contents,
              'photo'=>$photo,
          );

          http_build_query($data);
          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_POST,true);
          curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  
          $results = curl_exec($ch);
          dd($results);
          $results = json_decode($results,true);
  
          curl_close($ch);
          $this->clearField();
    }
    public function render()
    {
        return view('livewire.live-announcement');
    }
}
