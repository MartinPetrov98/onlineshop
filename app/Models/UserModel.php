<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class UserModel{
    
  
    
    public function select($username){
    
      $data   = DB::select('select `user_id` from users where  `username` = ? ',[$username]);
         return $data;
    }


     

    public function Insertuserdata($username,$user_email,$password,$gender){
       DB::insert('insert into users (username,user_email,password,gender) values (?, ?,?,?)', [$username,$user_email,$password,$gender]);
    }
    
    public function setSess($key,$val){
      
       Session::put($key,$val);
    
    }

    public function pushSess($key,$val){
        Session::push($key,$val);
    }
    
    
    
    public function sessdestroy(){
       session()->flush();
       session()->forget('username');
         
    }
    
    
    
    
     
     
     
     
    
}
