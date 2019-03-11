<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\View;





class RegisterController extends Controller
{

    protected $username = '';
    protected $password = '';
    protected $user_id = '';


    public function Registerform()
    {
        return view('register');
    }

    public function Loginform()
    {
        return view('login');
    }



    public function Registerauth(Request $request, UserModel $usermodel)
    {


        if ($request->has('register')) {
            $validation = $this->validate($request, [
                'username' => 'min:4|max:20|unique:users,username',
                'email' => 'email|unique:users,user_email',
                'password' => 'min:10',
                'gender' => 'required|in:Male,Female'
            ], [
                'username.min' => 'Username is too short!',
                'username.max' => 'Username is too long!',
                'username.exists' => 'This username is already taken!',
                'email.exists' => 'This email is already taken!'
            ]);
            $password = Hash::make($validation['password']);
            $this->password = $password;

            if ($validation) {
                $usermodel->Insertuserdata($validation['username'], $validation['email'], $password, $validation['gender']);

                return view('login')->with('reg_suc', 'You registered successfully!');
            }
        }
    }

    public function Loginauth(Request $request, UserModel $usermodel, View $view)
    {

        if ($request->has('login')) {



            $validationflogin = $this->validate($request, [
                'username' => 'exists:users,username',
                $this->password => 'exists:users,password'
            ]);

            if ($validationflogin) {




                $username = $validationflogin['username'];
                $this->username = $username;

                $user_id = $usermodel->select($username);
                $this->user_id = $user_id;
                $usermodel->setSess('username', $this->username);
                $usermodel->setSess('user_id',$this->user_id);



                return redirect('/');
            }

            // to hash the password when trying ot login too maybe !!
        }


    }
}