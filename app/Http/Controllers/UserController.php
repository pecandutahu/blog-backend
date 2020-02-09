<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->middleware('auth');
    }

    public function show($id){
        $user = User::find($id);

        if($user){
            return response()->json([
                'success' => true,
                'message' => 'User Found',
                'data' => $user
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Not Found',
                'data' => ''
            ], 404);
        }
    }

    public function update(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        if ($request->input('password')) {
            $password = Hash::make($request->input('password'));
            $data = User::whereId($request->id)->update([
                'name' => $name,
                'email' => $email,
                'password' => $password,
            ]);
        }else {
            $data = User::whereId($request->id)->update([
                'name' => $name,
                'email' => $email,
            ]);
        }
        // dd($data);
        if ($data){
            $data = User::whereId($request->id)->first();
            return response()->json([
                'success' => true,
                'message' => 'Update successfull',
                'data' => $data
            ],201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Update Failed user not found',
                'data' => ''
            ], 401);
        }
        
    }
}
