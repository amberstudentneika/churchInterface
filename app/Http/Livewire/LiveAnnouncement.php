<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
class LiveAnnouncement extends Component
{
    use WithFileUploads;
    public $viewModal=false, $announceID;
    public $heading, $contents, $photo, $oldPhoto;
    public $textPost=false;
    

    public function viewModal(){
        $this->viewModal=true;
    }
    public function hideModal(){
        $this->viewModal=false;
        $this->photo='';  
    }
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
          $url = 'http://192.168.0.12:8081/api/announcement/store';

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
          $results = json_decode($results,true);
          curl_close($ch);
          $this->textPost = false; 
          $this->clearField();
    }
   
    

public function showEdit($id){
    $this->viewModal=true;
    $this->announceID = $id;
    $ch=curl_init();
    $url = 'http://192.168.0.12:8081/api/announcement/show/'.$this->announceID;
    
    //$mID=session()->get('memberID');//should be ADMIN not member
  
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

    $results = curl_exec($ch);
    // dd($results);
    $results = json_decode($results,true);
    $data=$results['data'];
    $this->announceID=$data['id'];
    $this->heading=$data['topic'];
    $this->contents=$data['message'];
    $this->photo=$data['image'];
    $this->oldPhoto=$data['image'];
    // dd($this->photo);
    curl_close($ch);
}

    public function edit(){
        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/announcement/update/'.$this->announceID;
        
        if($this->oldPhoto == $this->photo){
            $photo = $this->oldPhoto;
            }elseif($this->oldPhoto != $this->photo){
                $photo=$this->photo->getClientOriginalName();
                $this->photo->storePubliclyAs('storage',$photo,'gallery');
        }
        
        $data=array(
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
        // dd($results);
        $results = json_decode($results,true);
        curl_close($ch);
        $this->clearField();
        $this->hideModal();
    }

    public function delete($id){
        $this->announceID= $id;
        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/announcement/delete/'.$this->announceID;
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        curl_close($ch);
    }
    public function render()
    {
         //view Announcements
         $ch=curl_init();
         $url = 'http://192.168.0.12:8081/api/announcement/index';
         
         curl_setopt($ch,CURLOPT_URL,$url);
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
 
         $results = curl_exec($ch);
         $results = json_decode($results,true);
        //  dd($results );
         $result= $results['status'];
         if($result =='404'){
             $dataAnnounce = array();
         }elseif($result =='200'){
             $dataAnnounce = $results['data'];
         }if($result == null){
            $dataAnnounce = array();
        }
         curl_close($ch);
        return view('livewire.live-announcement',compact('dataAnnounce'));
    }
}
