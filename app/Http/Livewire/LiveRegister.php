<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Hash;
class LiveRegister extends Component
{
    public $firstname, $lastname, $gender, $email, $password, $password_confirmation;

    public function clearfield(){
        $this->firstname='';
        $this->lastname =''; 
        $this->gender=''; 
        $this->email=''; 
        $this->password=''; 
        $this->password_confirmation='';

    }
    protected $rules=[
        'firstname' => 'required',
        'lastname' => 'required',
        'gender' => 'required',
        'email' => 'required|email',
        'password' => 'min:8|same:password_confirmation',
        'password_confirmation' => 'min:8|same:password',
    ];
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function onSubmit(){
        $this->validate();

        $ch=curl_init();
        $url = 'http://192.168.0.4:8081/api/register';
        
        $data=array(
            'firstname'=>$this->firstname,
            'lastname'=>$this->lastname,
            'gender'=>$this->gender,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
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
           return redirect()->route('home');
        }
        curl_close($ch);
        $this->clearfield();

    }
    
    public function render()
    {
        return view('livewire.live-register');
    }
}
