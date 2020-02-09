<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use  App\User;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */


    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'username' => 'required|unique:user',
            'email' => 'required|unique:user',
            'fk_role_code' => 'required|string',
            'password' => 'required||unique:user',
        ]);
        try {
            
            $name = $request->input('name');
            $username = $request->input('username');
            $email = $request->input('email');
            $fk_role_code= $request->input('fk_role_code');
            $status = $request->input('status');
            //$password = $request->input('password');
            $password = Hash::make($request->input('password'));
            $api_token = base64_encode(Str::random(30));
           
            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'fk_role_code' => $fk_role_code,
                'status' => $status,
                'api_token' => $api_token
            ]);

            return response()->json([
                'success'=> 201,
                'message'=> 'Register Success!',
                'user'=>$user
            ], 201);

        }catch (\Exception $e) {

            return response()->json([
                'errorCode'=> 400,
                'message'=> $e
            ], 400);
        }

    }

    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

       $username = $request->input('username');
       $password = $request->input('password');

        $user = User::where('username', $username)->first();

       if($user && Hash::check($password, $user->password)){
           $apiToken = base64_encode(Str::random(30));
           Log::info('Showing user profile for user: '.$username);
           $user->update([
               'api_token'=> $apiToken
           ]);

           return response()->json([
            'success'=> 201,
            'message'=> 'Login Success!',
            'name'=> $user->name,
            'username'=> $user->username, 
            'email'=> $user->email,
            'fk_role_code'=> $user->fk_role_code,
            'status'=> $user->status, 
            'created_at'=> $user->created_at,
            'updated_at'=> $user->updated_at,
            'apiToken'=> $apiToken
        ], 201);
       } else{
        return response()->json([
            'errorCode'=> 204,
            'message'=> 'Your username or password is incorrect'
             ]);
       }
    
    }

}