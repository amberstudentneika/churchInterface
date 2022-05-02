<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Hash;
class LiveProfilePhoto extends Component
{
    use WithFileUploads;

    public $firstname, $lastname, $gender, $password, $password_confirmation;
    public $photo, $oldPhoto;
    public $changePassword;

    public function showChangePassword(){
        $this->changePassword=true;
        $this->password="";
        $this->password_confirmation="";
    }
    public function hideChangePassword(){
        $this->changePassword=false;
        $this->password="isinactive";
        $this->password_confirmation="isinactive";
    }

    public function clearField(){
    $this->photo='';
    $this->firstname='';
    $this->lastname =''; 
    $this->gender=''; 
    $this->password=''; 
    $this->password_confirmation='';
    }

    protected $rules=[
        'firstname' => 'required',
        'lastname' => 'required',
        'gender' => 'required',
        'password' => 'min:8',
        'password_confirmation' => 'min:8|same:password',
    ];
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function mount(){// mount renders once when the page loads
    $memberID = session()->get('memberID');
       
        $ch=curl_init();
        $url = 'https://api.shaneika.fimijm.com/api/profile/show/'.$memberID;
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
        //   dd($results);
          $result= $results['status'];
          if($result =='404'){
              $dataMember = array();
          }elseif($result =='200'){
            $dataMember = $results['data'];
            // dd($dataMember);
            $this->photo = $dataMember[0]['image'];
            $this->oldPhoto = $dataMember[0]['image'];
            // dd($this->oldPhoto);
           
            $this->firstname=$dataMember[0]['firstname'];
            $this->lastname=$dataMember[0]['lastname']; 
            $this->gender=$dataMember[0]['gender'];   
            $this->password="isinactive";
            $this->password_confirmation="isinactive";
          } if($result == null){
            $dataMember = array();
         }
          curl_close($ch);
        }

    public function onSubmit(){
        $this->validate();
        $ch=curl_init();
        
        if($this->oldPhoto == $this->photo){
            $photo = $this->oldPhoto;
            }elseif($this->oldPhoto != $this->photo){
                $photo=$this->photo->getClientOriginalName();
                $this->photo->storePubliclyAs('storage',$photo,'profileImage');
        }

        $memberID = session()->get('memberID');
        $url = 'https://api.shaneika.fimijm.com/api/profile/update/'.$memberID;
        $memberToken=session()->get('memberToken');
        $headers=[
            'Accept: application/json',
            'Authorization: Bearer '.$memberToken
        ]; 
        if($this->password!="isinactive")
        {
            $data=array(
                'photo'=>$photo,
                'firstname'=>$this->firstname,
                'lastname'=>$this->lastname,
                'gender'=>$this->gender,   
                'password'=>Hash::make($this->password),
            );
        }else{

            $data=array(
                'photo'=>$photo,
                'firstname'=>$this->firstname,
                'lastname'=>$this->lastname,
                'gender'=>$this->gender,  
                'password'=>$this->password, 
            );
        }
          http_build_query($data);
          curl_setopt($ch,CURLOPT_URL,$url);
          curl_setopt($ch,CURLOPT_POST,true);
          curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
          curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
          curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
          $results = curl_exec($ch); 
          $results = json_decode($results,true);
        //   dd($results);
          $data= $results['data'][0];
  
          curl_close($ch);

          $name = ucwords($this->firstname).' '.ucwords($this->lastname);
          $p=session()->put('memberImage',$photo);
          session()->put('memberName',$name);
          if($data['role']==1){
              return redirect()->route('adminFeed');
          }elseif($data['role']==3){
            return redirect()->route('superAdminFeed');
          }
        $this->clearField();
    }
    public function render()
    {
        if($this->photo == null || $this->photo == 'null'){
            if(session()->has('memberImage')){
             $this->photo = session()->get('memberImage');
             $this->oldPhoto = session()->get('memberImage');
             }
     }
        return view('livewire.live-profile-photo');
    }
}
