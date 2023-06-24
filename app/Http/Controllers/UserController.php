<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class UserController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function forgot(){
        return view('auth.forgot');
    }

    public function reset(){
        return view('auth.reset');
    }

    public function saveUser(Request $request){
        //validate all the fields
        $validator = FacadesValidator::make($request->all(),[
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:100', //users is a table
            'password' => 'required|min:6|max:50',
            'cpassword' => 'required|min:6|same:password'
        ],[
            //define some custom message
            'cpassword.same' => 'Password did not matched!',
            'cpassword.required' => 'Confirm password is required!',
        ]); 

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'status' => 200,
                'messages' => 'Registered successfully!'
            ]);
        }
    }
}
