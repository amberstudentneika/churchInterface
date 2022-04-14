<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
class LiveAdminFeed extends Component
{
    use WithFileUploads;
public $prompt;
protected $listeners=[
'test'
];

public function test(){
    $this->prompt="this is a test";
    dd($this->prompt);
}


    public $textPost=false;
    public $postID, $test=true;
    public $cat, $heading, $contents, $photo;
   
    public function showMedia(){
        $this->textPost = true;        
    }
    public function hideMedia(){
        $this->textPost = false;    
        $this->photo='';    
    }
    protected $rules=[
        'cat' => 'required',
        'contents' => 'required',
        'heading' => 'required',
    ];

    public function clearField(){
        $this->cat='';
        $this->heading='';
        $this->contents='';
        $this->contents='';
        $this->photo=''; 
    }
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function onSubmit(){
      $this->validate();
// dd($this->textPost);
      if($this->textPost == true){
          if($this->photo==null){
            session()->flash('error','Upload photo/video or click "remove" button.');
        }
      }

        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/post/store';
        
        if($this->photo!='' || $this->photo!=null){
            $photo=$this->photo->getClientOriginalName();
            $this->photo->storePubliclyAs('storage',$photo,'gallery');
        }elseif($this->photo=='' || $this->photo==null){
            $result=2;
            // $photo=$this->photo;
        }
        
        $data=array(
            'categoryID'=>$this->cat,
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
        $this->clearField();
    }

    public function showEdit($id){
        $this->postID = $id;
        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/post/show/'.$this->postID;
        
        //$mID=session()->get('memberID');//should be ADMIN not member
      
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        // dd($results);
        curl_close($ch);
    }

    public function delete($id){
        $this->postID= $id;
        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/post/delete/'.$this->postID;
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        // $result = $results['status'];
        // if($result=="201"){
        //     $this->status=true;
        //     return redirect()->route('login');
        // }
        curl_close($ch);
    }
   
    public function render()
    {
        //view category
        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/category/index';
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $result= $results['status'];
        if($result =='404'){
            $data= array();
        }elseif($result =='200'){
            $data = $results['data'];
        }
        curl_close($ch);

        //view posts
        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/post/index';
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $result= $results['status'];
        if($result =='404'){
            $dataPost = array();
        }elseif($result =='200'){
            $dataPost = $results['data'];
            // dd($dataPost);
        }
        curl_close($ch);

        
        return view('livewire.live-admin-feed',compact('data','dataPost'));
    }
}
