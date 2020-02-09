<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function register(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));

        $data = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ]);
        if ($data){
            return response()->json([
                'success' => true,
                'message' => 'Successfull',
                'data' => $data,
            ],201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Fail',
                'data' => '',
            ],400);
        }
    }

    public function login(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email',$email)->first();
        if (Hash::check($password, $user['password'])){

            $apiToken = base64_encode(str_random(40));
            $user->update([
                'api_token' => $apiToken
            ]);

            return response()->json([
                'success' =>true,
                'message' => 'Login Success',
                'data' => [
                    'user' => $user,
                    'api_token' => $apiToken
                ]
                ], 201);
        }else{
            return response()->json([
                'success' =>false,
                'message' => 'Login Failed!',
                'data' => ''
                ], 401);
        }
    }

    
}
