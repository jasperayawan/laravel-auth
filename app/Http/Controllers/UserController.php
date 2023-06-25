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

    public function logUser(){
        return view('auth.login');
    }

    //handle login user ajax request
    public function loginUser(Request $request){
        $validator = FacadesValidator::make($request->all(),[
            'email' => 'required|email|max:100',
            'password' => 'required|min:6|max:50',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'messages' => $validator->getMessageBag()
            ]);
        } else {
            $user = User::where('email', $request->email)->first(); //first method to get only one row
            if($user){
                if(Hash::check($request->password, $user->password)){
                    $request->session()->put('loggedInUser', $user->id); // put('KEY', value)
                    return response()->json([
                        'status' => 200,
                        'messages' => 'success'
                    ]);
                } else {
                    return response()->json([
                        'status' => 401,
                        'messages' => 'Email or password is incorrect!'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 401,
                    'messages' => 'User not found!'
                ]);
            }
        }
    }

    public function profile(){
        return view('profile');
    }
}
