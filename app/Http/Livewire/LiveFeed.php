<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveFeed extends Component
{
    public $textPost=false;
    public $contentsTextOnly,$uploadedFile,$contents;

    public function showVideo(){
        $this->textPost=true;
    }
    public function removeVideo(){
        $this->textPost=false;
    }

    protected $rules=[
        'uploadedFile' => 'required',
        'contents' => 'required',
    ];

    public function clearField(){
        $this->contentsTextOnly='';
        $this->uploadedFile='';
        $this->contents='';
    }
    public function updated($propertyName){
        // $this->validateOnly($propertyName);
    }

    public function onSubmitText(){
        // if($this->contentsTextOnly==''){
        //     session()->flash('error','Field is empty');
        // }
        // $ch=curl_init();
        // $url = 'http://192.168.0.2:8081/api/';
        
        // $data=array(
        //     'contents'=>$this->contentsTextOnly,
        // );
        // http_build_query($data);
        
        // curl_setopt($ch,CURLOPT_URL,$url);
        // curl_setopt($ch,CURLOPT_POST,true);
        // curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        // $results = curl_exec($ch);
        // $results = json_decode($results,true);
        // dd($results);
        // $result = $results['status'];
        // if($result=="201"){
        //     $this->status=true;
        //     return redirect()->route('login');
        // }
        // curl_close($ch);
        // dd($contentsTextOnly);
        // $this->clearField();
    }
    public function onSubmit(){
        // $this->validate();
           // $identificationCard=$this->firstname." ".$this->lastname." ".$this->identificationCard->getClientOriginalName();
        // $trn=$this->firstname." ".$this->lastname." ".$this->trn->getClientOriginalName();
        // $this->identificationCard->storePubliclyAs('storage',$identificationCard,'parentUploads');
        // $this->trn->storePubliclyAs('storage',$trn,'parentUploads');
        
        // $this->clearField();
    }
    public function render()
    {
         //view posts
        // $ch=curl_init();
        // $url = 'http://192.168.0.4:8081/api/post/index';
        
        // curl_setopt($ch,CURLOPT_URL,$url);
        // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        // $results = curl_exec($ch);
        // $results = json_decode($results,true);
        // dd($results);
        // // $dataPost = $results['data'];
        // curl_close($ch);
        // return view('livewire.live-feed',compact('dataPost'));
        return view('livewire.live-feed');
    }
}
