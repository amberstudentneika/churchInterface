<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveAdminFeed extends Component
{
    public $textPost=false;
    public $cat, $heading, $contents, $uploadedFile;

    
    public function showMedia(){
        $this->textPost = true;        
    }
    public function hideMedia(){
        $this->textPost = false;        
    }
    protected $rules=[
        'cat' => 'required',
        'contents' => 'required',
        'heading' => 'required',
        // 'uploadedFile' => 'required',
    ];

    public function clearField(){
        $this->cat='';
        $this->heading='';
        $this->contents='';
        $this->contents='';
        $this->uploadedFile='';
    }
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function onSubmit(){
      $this->validate();
// dd($this->textPost);
      if($this->textPost == true){
          if($this->uploadedFile==null){
            session()->flash('error','Upload photo/video or click "remove" button.');
        }
      }

        $ch=curl_init();
        $url = 'http://192.168.0.5:8081/api/post/store';
        
        $data=array(
            'categoryID'=>$this->cat,
            'heading'=>$this->heading,
            'contents'=>$this->contents,
        );
        // dd($data);
        http_build_query($data);
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        // $result = $results['status'];
        // if($result=="201"){
        //     $this->status=true;
        //     return redirect()->route('login');
        // }
        curl_close($ch);
        $this->clearField();
    }
   
    public function render()
    {
        //view category
        $ch=curl_init();
        $url = 'http://192.168.0.5:8081/api/category/index';
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $data = $results['data'];
        curl_close($ch);

        //view posts
        $ch=curl_init();
        $url = 'http://192.168.0.5:8081/api/post/index';
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $dataPost = $results['data'];
        // dd($dataPost);
        curl_close($ch);

        return view('livewire.live-admin-feed',compact('data','dataPost'));
    }
}
