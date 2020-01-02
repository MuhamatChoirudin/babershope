<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showAllAuthors()
    {
        return response()->json(User::all());
    }

    public function showOneAuthor($id)
    {
        $user = User::find($id);
        if($user){
            return response()->json([
                'success'=> true,
                'message'=> 'User Found!',
                'data'=> $user
            ], 200);
        }else{
            return response()->json([
                'success'=> false,
                'message'=> 'User Not Found!',
                'data'=> ''
            ], 404);
        }
        
    }


    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }

}