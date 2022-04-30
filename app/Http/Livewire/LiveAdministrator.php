<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LiveAdministrator extends Component
{
    public  $viewMember, $viewAdmin=false, $viewDeactivatedUsers;

    public function showDeactivatedUsers(){
        $this->viewAdmin=true;
        $this->viewMember=false;
        $this->viewDeactivatedUsers=true;


    }
    public function hideDeactivatedUsers(){
        $this->viewAdmin=false;
        $this->viewMember=false;
        $this->viewDeactivatedUsers=false;
    }
    public function showMemberMode(){
        $this->viewAdmin=true;
        $this->viewMember=true;
    }
    public function hideMemberMode(){
        $this->viewMember=false;
        $this->viewAdmin=false;
    }
    public function removeUser($id){
        $ch=curl_init();
        $url = 'http://192.168.100.38:8081/api/deactivate/user/'.$id;
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
        // dd($results);
        session()->put('success',$results['message']);
        curl_close($ch);
}

public function makeAdmin($id){
    $ch=curl_init();
    $url = 'http://192.168.100.38:8081/api/member/role/update/admin/'.$id;
    $memberToken=session()->get('memberToken');
    $headers=[
        'Accept: application/json',
        'Authorization: Bearer '.$memberToken
    ]; 
     
       $data=array(
        'role'=>1,
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

    public function revokeRole($id){
    $ch=curl_init();
    $url = 'http://192.168.100.38:8081/api/admin/role/update/member/'.$id;
    $memberToken=session()->get('memberToken');
    $headers=[
        'Accept: application/json',
        'Authorization: Bearer '.$memberToken
    ]; 
     
       $data=array(
        'role'=>0,
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
    public function ReactivateUsers($id){
    $ch=curl_init();
    $url = 'http://192.168.100.38:8081/api/reactivate/user/'.$id;
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
    // dd($results);
    $results = json_decode($results,true);
    curl_close($ch);

    }

    public function render()
    {
         //view Users
         $ch=curl_init();
         $url = 'http://192.168.100.38:8081/api/member/index';
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
             $userData = array();
             $inactiveUserData = array();
         }elseif($result =='200'){
             $userData = $results['data'];
             $inactiveUserData = $results['inactiveUser'];
         }if($result == null){
            $userData = array();
            $inactiveUserData = array();
        }
         curl_close($ch);
        return view('livewire.live-administrator',compact('userData','inactiveUserData'));
    }
}
