<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveCategory extends Component
{
    public $heading, $detail, $catID;
    public $viewMode=false, $addMode;

    public function clearField(){
        $this->heading = '';
        $this->detail  = '';
    }
    public function viewMode(){
        $this->addMode  = false;
        $this->viewMode = false;
        $this->editMode = false;
    }
    public function addMode(){
        $this->viewMode = true;
        $this->addMode  = true;
    }
    protected $rules=[
        'heading'=> 'required',
        'detail'=> 'required'
    ];
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function goSubmit(){
        $this->validate();
        $ch=curl_init();
        $url = 'http://192.168.0.5:8081/api/category/store';
        
        $data=array(
            'heading'=>$this->heading,
            'detail'=>$this->detail,
        );
        http_build_query($data);
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $result = $results['status'];
        if($result=="201"){
           session()->flash('success',$results['message']);
           $this->viewMode();
        }
        curl_close($ch);
        $this->clearfield();
    }

    public function edit($id){
        $this->id=$id;
        $this->viewMode=true;
        $this->addMode=false;
        $this->editMode=true;
        
        $ch=curl_init();
        $url = 'http://192.168.0.5:8081/api/category/show/'.$id;

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $results = curl_exec($ch);
        $results = json_decode($results,true);
        
        $data=$results['data'];
        $this->catID=$data['id'];
        $this->heading=$data['name'];
        $this->detail=$data['desc'];
    }
    public function update(){
        $this->validate();
        $ch=curl_init();
        $url = 'http://192.168.0.5:8081/api/category/update/'.$this->catID;
        
        $data=array(
            'heading'=>$this->heading,
            'detail'=>$this->detail,
        );
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $this->viewMode();
    }

    public function delete($id){
        $ch=curl_init();
        $url = 'http://192.168.0.5:8081/api/category/delete/'.$id;
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $results = curl_exec($ch);
        $results = json_decode($results,true);
        if($results['status']==204){
            session()->flash('deleted',$results['message']);
        }
        $this->viewMode();
    }
    public function render()
    {
        $ch=curl_init();
        $url = 'http://192.168.0.5:8081/api/category/index';
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $data=$results['data'];
        // dd($data);
        curl_close($ch);

        return view('livewire.live-category',compact('data'));
    }
}
