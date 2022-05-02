<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveMemberFeed extends Component
{
    //Comment Variable
    public $comID, $edComment, $comment, $showComments=false, $showCom, $hideCom;
    public $editCommentInput=false;
  
    public function showEditCommentInput(){
        $this->editCommentInput=true;
    }
    public function hideEditCommentInput(){
        $this->editCommentInput=false;
        // $this->clearField();
    }
    
    public function clearField(){
        $this->comment='';
    }

    public function showComment($postID){
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

        public function deleteComment($commentID,$postID){
            $ch=curl_init();
            $url = 'https://api.shaneika.fimijm.com/api/comment/delete/'.$commentID;
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
            http_build_query($data);
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
            $results = curl_exec($ch);
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
        //view posts
        $ch=curl_init();
        $url = 'https://api.shaneika.fimijm.com/api/post/index';
        $memberToken=session()->get('memberToken');
        
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ];
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        $result= $results['status'];
        if($result =='404'){
            $dataPost = array();
            $dataComment = array();
            $dataCategory = array();
            $dataMembers = array();
        }elseif($result =='200'){
            $dataPost = $results['data'];
            $dataComment = $results['commentData'];
            $dataCategory = $results['categoryData'];
            $dataMembers = $results['membersData'];
        }if($result == null){
            $dataPost = array();
            $dataComment = array();
            $dataCategory = array();
            $dataMembers = array();
        }
        curl_close($ch);

        //view  anouncement
        $ch=curl_init();
        $url = 'https://api.shaneika.fimijm.com/api/announcement/recent';
        $memberToken=session()->get('memberToken');
        
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ];
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        // dd($results );
        $results = json_decode($results,true);
        $result= $results['status'];
        if($result =='404'){
            $dataAnnouncement = array();
        }elseif($result =='200'){
            $dataAnnouncement = $results['announcementData'];
        }if($result == null){
            $dataAnnouncement = array();
        }
        curl_close($ch);

        return view('livewire.live-member-feed',compact('dataPost','dataComment','dataCategory','dataMembers','dataAnnouncement'));
    }
}
