<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveMemberFeed extends Component
{
    //Comment Variable
    public $comment, $showComments=false, $showCom, $hideCom;

    public function clearField(){
        $this->comment='';
    }

    public function showComment($postID){
        $this->showCom=$postID;
        $this->showComments=true;
    }
    public function hideComment($postID){
        $this->hideCom=$postID;
        $this->showComments=false;
    }


    public function like($postID){
        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/like/store';
        
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
            $url = 'http://192.168.0.12:8081/api/comment/store';
            
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


    public function render()
    {
        //view posts
        $ch=curl_init();
        $url = 'http://192.168.0.12:8081/api/post/index';
        
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch);
        $results = json_decode($results,true);
        // dd($results );
        $result= $results['status'];
        if($result =='404'){
            $dataPost = array();
            $dataComment = array();
            $dataCategory = array();
            $dataMembers = array();
            $dataAnnouncement = array();
        }elseif($result =='200'){
            $dataPost = $results['data'];
            $dataComment = $results['commentData'];
            $dataCategory = $results['categoryData'];
            $dataMembers = $results['membersData'];
            $dataAnnouncement = $results['announcementData'];
            // dd($dataPost);
        }if($result == null){
            $dataPost = array();
            $dataComment = array();
            $dataCategory = array();
            $dataMembers = array();
            $dataAnnouncement = array();
        }
        curl_close($ch);

        return view('livewire.live-member-feed',compact('dataPost','dataComment','dataCategory','dataMembers','dataAnnouncement'));
    }
}
