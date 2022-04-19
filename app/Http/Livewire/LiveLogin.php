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
        $url = 'http://192.168.0.12:8081/api/login';
        
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
           
        }
        elseif($result=="404"){
           session()->flash('failed',$results['message']);
           return redirect()->route('login');
        }
        curl_close($ch);
        // $this->clearfield();

    }

    public function render()
    {
        return view('livewire.live-login');
    }
}
