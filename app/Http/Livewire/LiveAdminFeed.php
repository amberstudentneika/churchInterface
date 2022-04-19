<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
class LiveAdminFeed extends Component
{
    use WithFileUploads;


    public $viewModal=false;
    public $textPost=false;
    public $postID, $test=true;
    public $cat, $heading, $contents, $photo;
    public $categoryListing;
//Edit Variables
    public $editPostID, $editCatID, $categoryID, $editHeading;
    public $editContents, $editPhoto, $oldPhoto;
//Comment Variable
    public $comment, $showComments=false, $showCom, $hideCom;


    public function viewModal(){
        $this->viewModal=true;
    }
       public function hideModal(){
        $this->viewModal=false;
        $this->editPostID=''; 
        $this->editCatID='';
        $this->categoryName=''; 
        $this->categoryID='';
        $this->editHeading='';
        $this->editContents=''; 
        $this->editPhoto='';
        $this->oldPhoto;
    }
    
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
        $this->editPostID=''; 
        $this->editCatID='';
        $this->categoryID='';
        $this->editHeading='';
        $this->editContents=''; 
        $this->editPhoto='';
        $this->oldPhoto='';
        $this->comment='';
    }
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
        $url = 'http://192.168.0.2:8081/api/post/store';
        
        if($this->photo!='' || $this->photo!=null){
            $photo=$this->photo->getClientOriginalName();
            $this->photo->storePubliclyAs('storage',$photo,'gallery');
        }elseif($this->photo=='' || $this->photo==null){
            $photo=$this->photo;
        }
        $mID=session()->get('memberID');
        $data=array(
            'categoryID'=>$this->cat,
            'heading'=>$this->heading,
            'contents'=>$this->contents,
            'photo'=>$photo,
            'mID'=>$mID,
        );
        // dd($data);
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
        $this->viewModal=true;
        $this->postID = $id;
        $ch=curl_init();
        $url = 'http://192.168.0.2:8081/api/post/show/'.$this->postID;
        
        //$mID=session()->get('memberID');//should be ADMIN not member
      
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $data=$results['data'][0];
        // dd($data);
        $categoryName=$results['category']['name'];

        $this->editPostID=$data['id'];
        $this->categoryID=$data['topic']['categoryID'];
        $this->topicID=$data['topic']['id'];
        $this->editHeading=$data['topic']['name'];
        $this->editContents=$data['body'];
        $this->editPhoto=$data['image'];
        $this->oldPhoto=$data['image'];
        $this->categoryListing=array_slice($results,3,1);
        curl_close($ch);
    }

    public function edit($categID){
        if($this->editCatID == null || $this->editHeading == null || $this->editContents == null ){
            session()->flash('error','Plese ensure to fill all fields');
        }

        $ch=curl_init();
        $url = 'http://192.168.0.2:8081/api/post/update/'.$this->editPostID;
        
        if($this->oldPhoto == $this->editPhoto){
            $editPhoto = $this->oldPhoto;
            }elseif($this->oldPhoto != $this->editPhoto){
                $editPhoto=$this->editPhoto->getClientOriginalName();
                $this->editPhoto->storePubliclyAs('storage',$editPhoto,'gallery');
        }
        
        $data=array(
            'categoryID'=>$this->editCatID,
            'topicID'=>$this->topicID,
            'heading'=>$this->editHeading,
            'contents'=>$this->editContents,
            'photo'=>$editPhoto,
        );
        // dd($data);
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
        $this->postID= $id;
        $ch=curl_init();
        $url = 'http://192.168.0.2:8081/api/post/delete/'.$this->postID;
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        curl_close($ch);
    }
   
//END OF CRDU OPERATIONS


    public function like($postID){
        $ch=curl_init();
        $url = 'http://192.168.0.2:8081/api/like/store';
        
        $memberID=session()->get('memberID');
        $data=array(
            'postID'=>$postID,
            'memberID'=>$memberID,
        );
        // dd($data);
        http_build_query($data);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        // dd($results);
        curl_close($ch);
        $this->clearField();
    }
//END OF LIKES CRUD OPERATIONS

        public function submitComment($postID){
            $ch=curl_init();
            $url = 'http://192.168.0.2:8081/api/comment/store';
            
            $memberID=session()->get('memberID');
            $data=array(
                'postID'=>$postID,
                'memberID'=>$memberID,
                'comment'=>$this->comment,
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
        }
        
        public function showComment($postID){
            // dd($postID);
            $this->showCom=$postID;
            $this->showComments=true;
        }
        public function hideComment($postID){
            $this->hideCom=$postID;
            $this->showComments=false;
        }


//END OF COMMENTS CRUD OPERATIONS
    public function render()
    {
        //view category
        $ch=curl_init();
        $url = 'http://192.168.0.2:8081/api/category/index';
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
        $url = 'http://192.168.0.2:8081/api/post/index';
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        // dd($results );
        $result= $results['status'];
        if($result =='404'){
            $dataPost = array();
            $dataComment = array();
        }elseif($result =='200'){
            $dataPost = $results['data'];
            $dataComment = $results['commentData'];
            // dd($dataComment);
        }
        curl_close($ch);

             
        return view('livewire.live-admin-feed',compact('data','dataPost','dataComment'));
    }
}
