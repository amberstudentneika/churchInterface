<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Hash;
class LiveLogin extends Component
{
    public $email, $password;
    public function clearfield(){
        $this->email=''; 
        $this->password=''; 
    }
    protected $rules=[
        'email' => 'required|email',
        'password' => 'required',
    ];
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function onSubmit(){
        $this->validate();

        $ch=curl_init();
        $url = 'https://api.shaneika.fimijm.com/api/login';
        
        $data=array(
            'email'=>$this->email,
            'password'=>$this->password,
        );
        http_build_query($data);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $results = curl_exec($ch); 
        // dd($results);
        $results = json_decode($results,true);
        $result = $results['status'];
        if($result=="200"){
            session()->put('memberToken',$results['token']);
            if($results['role']== 0){
                session()->put('role',$results['role']);
                session()->put('memberID',$results['memberID']);
                session()->put('memberName',$results['memberName']);
                session()->put('memberImage',$results['memberImage']);
                return redirect()->route('memberFeed');
            }
            elseif($results['role']== 1){
                session()->put('role',$results['role']);
                session()->put('memberID',$results['memberID']);
                session()->put('memberName',$results['memberName']);
                session()->put('memberImage',$results['memberImage']);
                return redirect()->route('adminFeed');
            }
            elseif($results['role']== 3){
                session()->put('role',$results['role']);
                session()->put('memberID',$results['memberID']);
                session()->put('memberName',$results['memberName']);
                session()->put('memberImage',$results['memberImage']);
                return redirect()->route('superAdminFeed');
            }
        }
        elseif($result =="404"){
            session()->flash('failedLogin',$results['message']);
            return redirect()->back();          
        }if($result == null){
            return redirect()->route('errorAlert');
        }
        curl_close($ch);
        // $this->clearfield();

    }

    public function render()
    {
        return view('livewire.live-login');
    }
}
