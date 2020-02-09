<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
      //  $this->middleware('auth');
    }
    public function showAllAuthors()
    {
        return response()->json([
            'success'=> 200,
            'message'=> 'User Found!',
            'List User'=>User::all()
        ]);
    }

    public function showOneAuthor($id)
    {
        try{
            $user = User::find($id);
            if(isset($user) and is_null($user)){
                return response()->json([
                'erorrCode'=> 204,
                'message'=> 'User Not Found!'
            ],204);
            }elseif($user){
                return response()->json([
                    'success'=> 200,
                    'message'=> 'User Found!',
                    'user'=> $user
                ], 200);
            } else{
                return response()->json([
                    'erorrCode'=> 404,
                    'message'=> 'User Not Found!'
                ], 404);
            }
            
        }catch (\Exception $e) {
            return response()->json([
                'errorCode'=> 400,
                'message'=> $e
            ], 400);
        }
       
    }


    public function update($id, Request $request)
    {
        $request->json()->all();
        try{

           Hash::make($request->input('password'));

            $user = User::findOrFail($id);
            $user->update([$request->all()]);
    
            return response()->json([
                'success'=> 200,
                'message'=> 'Success Update User',
                'user'=> $user
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'errorCode'=> 400,
                'message'=> "User Not Found!",
                'errorr'=>$e
            ], 400);
        }
       
    }

    public function delete($id)
    {
        try{
            User::findOrFail($id)->delete();
            return response()->json([
                'success'=> 200,
                'message'=> 'Deleted Successfully',
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'errorCode'=> 400,
                'message'=> "Deleted Unsucess"
            ], 400);
        }
    }

}