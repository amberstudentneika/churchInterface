<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
class LiveSuperAdminFeed extends Component
{
    use WithFileUploads;
    public $commentText;

    public $viewModal=false;
    public $textPost=false;
    public $postID, $test=true;
    public $cat, $heading, $contents, $photo;
    public $categoryListing;
    //Edit Variables
    public $editPostID, $editCatID, $categoryID, $editHeading;
    public $editContents, $editPhoto, $oldPhoto;
    //Comment Variable
    public $edComment, $comment, $showComments=false, $showCom, $hideCom;
    public $editCommentInput=false;
    //File
    public $ext, $extens, $tempPhoto, $fileError;

    public function showEditCommentInput(){
        $this->editCommentInput=true;
    }
    public function hideEditCommentInput(){
        $this->editCommentInput=false;
        // $this->clearField();
    }
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
        $this->fileError = '';  
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
          if($this->photo==null || $this->photo==''){
              $this->fileError='Please upload a photo.';
            }
            if($this->photo!=null){ 
                $this->fileError ='';
                $fileName=$this->photo->getClientOriginalName();
                $this->ext = substr(strrchr($fileName, '.'), 1);
                $this->ext=strtoupper($this->ext);
                // dd($this->ext);
                if($this->ext == "PNG" || $this->ext == "JPG" || $this->ext == "JPEG"){
                    $ch=curl_init();
                    $url = 'https://api.shaneika.fimijm.com/api/post/store';
                    $photo=$this->photo->getClientOriginalName();
                    $this->photo->storePubliclyAs('storage',$photo,'gallery');
                    $mID=session()->get('memberID');
                    $data=array(
                        'categoryID'=>$this->cat,
                        'heading'=>$this->heading,
                        'contents'=>$this->contents,
                        'photo'=>$photo,
                        'mID'=>$mID,
                    );
                    // dd($data);
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
                    $this->clearField();
                    $this->hideMedia();
                }
                else{
                    $this->fileError = "Unsupported File Format. only jpg,png,jpeg is accepted.";
                    }
            }
            
      }

      if($this->textPost == false){
            $ch=curl_init();
            $url = 'https://api.shaneika.fimijm.com/api/post/store';

            $photo=$this->photo;
            $mID=session()->get('memberID');
            $data=array(
                'categoryID'=>$this->cat,
                'heading'=>$this->heading,
                'contents'=>$this->contents,
                'photo'=>$photo,
                'mID'=>$mID,
            );
            // dd($data);
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
            $this->clearField();

      }
   
    }

    public function showEdit($id){

        $this->viewModal=true;
        $this->postID = $id;
        $ch=curl_init();
        $url = 'https://api.shaneika.fimijm.com/api/post/show/'.$this->postID;
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
        if($this->editCatID == null || $this->editHeading == null || $this->editContents == null )
        {
            session()->flash('error','Please ensure to fill all fields');
        }

        if($this->editPhoto == "no image" || $this->editPhoto == null)
        {
            $ch=curl_init();
            $url = 'https://api.shaneika.fimijm.com/api/post/update/'.$this->editPostID;
            $memberToken=session()->get('memberToken');
            $headers=[
                'Accept: application/json',
                'Authorization: Bearer '.$memberToken
            ]; 

            $data=array(
                'categoryID'=>$this->editCatID,
                'topicID'=>$this->topicID,
                'heading'=>$this->editHeading,
                'contents'=>$this->editContents,
                'photo'=> "no image",
            );
            // dd($data);
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
                if($this->oldPhoto == $this->editPhoto)
                {
                    $editPhoto = $this->oldPhoto;
                }
                elseif($this->oldPhoto != $this->editPhoto)
                {
                    $this->fileError = '';
                    $fileName=$this->editPhoto->getClientOriginalName();
                    $this->ext = substr(strrchr($fileName, '.'), 1);
                    $this->ext=strtoupper($this->ext);
                    if($this->ext == "PNG" || $this->ext == "JPG" || $this->ext == "JPEG")
                    {
                        $editPhoto=$this->editPhoto->getClientOriginalName();
                        $this->editPhoto->storePubliclyAs('storage',$editPhoto,'gallery');
        
                        $ch=curl_init();
                        $url = 'https://api.shaneika.fimijm.com/api/post/update/'.$this->editPostID;
                        $memberToken=session()->get('memberToken');
                        $headers=[
                            'Accept: application/json',
                            'Authorization: Bearer '.$memberToken
                        ]; 
        
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
                        // dd($this->fileError);
                        $this->fileError = "Unsupported File Format. only jpg,png,jpeg is accepted.";
                    }
                }
        }
    }

    public function delete($id){
        $this->postID= $id;
        $ch=curl_init();
        $url = 'https://api.shaneika.fimijm.com/api/post/delete/'.$this->postID;
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
        // $this->comment='';
        curl_close($ch);
    }
   
//END OF CRDU OPERATIONS


    public function like($postID){
        $ch=curl_init();
        $url = 'https://api.shaneika.fimijm.com/api/like/store';
        $memberToken=session()->get('memberToken');
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ]; 
        
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
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        $results = curl_exec($ch);
        $results = json_decode($results,true);
        // dd($results);
        curl_close($ch);
        $this->clearField();
    }
//END OF LIKES CRUD OPERATIONS

        public function submitComment($postID){
            // dd($postID);
            $ch=curl_init();
            $url = 'https://api.shaneika.fimijm.com/api/comment/store';
            $memberToken=session()->get('memberToken');
            $headers=[
                'Accept: application/json',
                'Authorization: Bearer '.$memberToken
            ]; 
        
            $memberID=session()->get('memberID');
            $data=array(
                'postID'=>$postID,
                'memberID'=>$memberID,
                'comment'=>$this->comment,
            );
            // dd($data);
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
        }
        
        public function showComment($postID){
            // dd($postID);
            $this->showCom=$postID;
            $this->showComments=true;
            $this->comment='';
        }
        public function hideComment($postID){
            $this->showCom=null;
            $this->hideCom=$postID;
            $this->showComments=false;
            $this->comment='';
        }


//END OF COMMENTS CRUD OPERATIONS


public function deleteComment($commentID,$postID){
    $ch=curl_init();
    $url = 'https://api.shaneika.fimijm.com/api/comment/delete/'.$commentID;
    
    $memberID=session()->get('memberID');
    $memberToken=session()->get('memberToken');
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ]; 
        
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
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    $results = curl_exec($ch);
    // dd($results);
    $results = json_decode($results,true);
    curl_close($ch);
}

public function showEditComment($commentID){
    $ch=curl_init();
    $url = 'https://api.shaneika.fimijm.com/api/comment/show/'.$commentID;
    
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
    $result=$results['data'];
    $this->edComment = $result['body'];
    $this->comID = $result['id'];
    $this->showEditCommentInput();
    curl_close($ch);
}

public function editComment(){
    $ch=curl_init();
    $url = 'https://api.shaneika.fimijm.com/api/comment/update/'.$this->comID;
    $memberToken=session()->get('memberToken');
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ]; 
        
    $memberID=session()->get('memberID');
    $data=array(
        'comment'=>$this->edComment,
        'memberID'=>$memberID,
    );
    // dd($data);
    http_build_query($data);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_POST,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    $results = curl_exec($ch);
    $results = json_decode($results,true);
    curl_close($ch);
    $this->hideEditCommentInput();
    $this->edComment='';

}
    public function render()
    {
       
        //view category
        $ch=curl_init();
        $url = 'https://api.shaneika.fimijm.com/api/category/index';
        $memberToken=session()->get('memberToken');
        
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ];
        // dd($headers);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        $results = curl_exec($ch);

        $results = json_decode($results,true);
        $result= $results['status'];
        if($result =='404'){
            $data= array();
        }elseif($result =='200'){
            $data = $results['data'];
        }if($result == null){
            $data = array();
        }
        curl_close($ch);

        //view posts
        $ch=curl_init();
        $url = 'https://api.shaneika.fimijm.com/api/post/index';
        
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
        // dd($results );
        $result= $results['status'];
        if($result =='404'){
            $dataPost = array();
            $dataComment = array();
        }elseif($result =='200'){
            $dataPost = $results['data'];
            $dataComment = $results['commentData'];
            // dd($dataComment);
        }if($result == null){
            $dataPost = array();
            $dataComment = array();  
        }
        curl_close($ch);
             
        return view('livewire.live-super-admin-feed',compact('data','dataPost','dataComment'));
    }
}
