<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class AuthController extends Controller
{


    public function register(Request $request){

        
        $this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:users,email',
            'phone'=>'unique:users',
            'photo'=>'required|string',
            'password'=>'required|confirmed',
            'password'=>'required|same:password',
            'role'=>'required|string',
        ]);
        $user = User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'role'=>$request['role'],
            'photo'=>$request['photo'],
            'phone'=>$request['phone'],
            'password'=>bcrypt($request['password']),
        ]);
        
        $token = $user->createToken('garagiToken')->plainTextToken;
        $response = [
            'user'=> $user,
            'token'=> $token
        ];

        return response($response,201);
    }



    public function login(Request $request){

        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        // check email 
        $user = User::where('email',$request['email'])->first();
        


        // check password
        if(!$user || !Hash::check($request['password'], $user->password)){
            return response([
                "message"=>'Bad creds'
            ],401);
        }   


        $token = $user->createToken('garagiToken')->plainTextToken;
        $response = [
            'user'=> $user,
            'token'=> $token
        ];

        return response($response,201);
    }



    public function logout(Request $request){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
