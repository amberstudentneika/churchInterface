<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
class LiveSuperAdminAnnouncement extends Component
{
    use WithFileUploads;
    public $viewModal=false, $announceID;
    public $heading, $contents, $photo, $oldPhoto, $editPhoto, $editOldPhoto;
    public $textPost=false;
     //File
     public $ext, $extens, $tempPhoto, $fileError;

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
        $this->fileError ='';
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
        if($this->textPost == true){
            if($this->photo==null)
            {
                $this->fileError='Please upload a photo.';
            }
            if($this->photo!=null)
            { 
                $this->fileError ='';
                $fileName=$this->photo->getClientOriginalName();
                $this->ext = substr(strrchr($fileName, '.'), 1);
                $this->ext=strtoupper($this->ext);
                // dd($this->ext);
                if($this->ext == "PNG" || $this->ext == "JPG" || $this->ext == "JPEG"){
                    $photo=$this->photo->getClientOriginalName();
                    $this->photo->storePubliclyAs('storage',$photo,'gallery');
                    $memberID=session()->get('memberID');
                    $data=array(
                        'memberID'=>$memberID,
                        'heading'=>$this->heading,
                        'contents'=>$this->contents,
                        'photo'=>$photo,
                    );
                    $ch=curl_init();
                    $url = 'http://192.168.0.3:8081/api/announcement/store';
                    $memberToken=session()->get('memberToken');
                    $headers=[
                        'Accept: application/json',
                        'Authorization: Bearer '.$memberToken
                    ];

                    http_build_query($data);
                    curl_setopt($ch,CURLOPT_URL,$url);
                    curl_setopt($ch,CURLOPT_POST,true);
                    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
                    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            
                    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
                    $results = curl_exec($ch);
                    $results = json_decode($results,true);
                    curl_close($ch);
                    $this->textPost = false; 
                    $this->clearField();

                }
                else{
                        $this->fileError = "Unsupported File Format. only jpg,png,jpeg is accepted.";
               
                    }
                }
        }
    }
   
    

public function showEdit($id){
    $this->viewModal=true;
    $this->announceID = $id;
    $ch=curl_init();
    $url = 'http://192.168.0.3:8081/api/announcement/show/'.$this->announceID;
    $memberToken=session()->get('memberToken');
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ]; 
    //$mID=session()->get('memberID');//should be ADMIN not member
  
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    $results = curl_exec($ch);
    $results = json_decode($results,true);
    $data=$results['data'];
    // dd($data);
    $this->announceID=$data['id'];
    $this->heading=$data['topic'];
    $this->contents=$data['message'];
    $this->editPhoto=$data['image'];
    $this->editOldPhoto=$data['image'];
    // dd($this->photo);
    curl_close($ch);
}

    public function edit(){
        if($this->heading == null || $this->contents == null ){
            session()->flash('error','Please ensure to fill all fields');
        }

        if($this->editOldPhoto== $this->editPhoto)
        {
            $editPhoto = $this->editOldPhoto;
        }
        elseif($this->editOldPhoto != $this->editPhoto)
        {
            $this->fileError = '';
                $editPhoto=$this->editPhoto->getClientOriginalName();
                $this->ext = substr(strrchr($editPhoto, '.'), 1);
                $this->ext=strtoupper($this->ext);
                if($this->ext == "PNG" || $this->ext == "JPG" || $this->ext == "JPEG")
                {
                    $editPhoto=$this->editPhoto->getClientOriginalName();
                    $this->editPhoto->storePubliclyAs('storage',$editPhoto,'gallery');
                    $ch=curl_init();
                    $url = 'http://192.168.0.3:8081/api/announcement/update/'.$this->announceID;
                    $memberToken=session()->get('memberToken');
                    $headers=[
                        'Accept: application/json',
                        'Authorization: Bearer '.$memberToken
                    ]; 
                    $data=array(
                        'heading'=>$this->heading,
                        'contents'=>$this->contents,
                        'photo'=>$editPhoto,
                    );
                    http_build_query($data);
                    curl_setopt($ch,CURLOPT_URL,$url);
                    curl_setopt($ch,CURLOPT_POST,true);
                    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
                    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
                    $results = curl_exec($ch);
                     // dd($results);
                    $results = json_decode($results,true);
                    curl_close($ch);
                    $this->clearField();
                    $this->hideModal();
                }
                else
                {
                    $this->fileError = "Unsupported File Format. only jpg,png,jpeg is accepted.";
                }
            }
    }

    public function delete($id){
        $this->announceID= $id;
        $ch=curl_init();
        $url = 'http://192.168.0.3:8081/api/announcement/delete/'.$this->announceID;
        $memberToken=session()->get('memberToken');
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ]; 
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        $results = curl_exec($ch);
        $results = json_decode($results,true);
        curl_close($ch);
    }
    public function render()
    {
         //view Announcements
         $ch=curl_init();
         $url = 'http://192.168.0.3:8081/api/announcement/index';
         $memberToken=session()->get('memberToken');
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ]; 
         curl_setopt($ch,CURLOPT_URL,$url);
         curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
         curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
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
        return view('livewire.live-super-admin-announcement',compact('dataAnnounce'));
    }
}
