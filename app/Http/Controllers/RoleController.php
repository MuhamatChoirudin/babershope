<?php

namespace App\Http\Controllers;

use App\RoleUser;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function showAllAuthors()
    {
        return response()->json([
            'success'=> 200,
            'message'=> 'User Found!',
            'List Role User'=>RoleUser::all()
        ]);
    }

    public function showOneAuthor($id)
    {
        try{
            $role = RoleUser::find($id);
            if(isset($role) and is_null($role)){
                return response()->json([
                'erorrCode'=> 204,
                'message'=> 'Role User Not Found!'
            ],204);
            }elseif($role){
                return response()->json([
                    'success'=> 200,
                    'message'=> 'Role User Found!',
                    'role'=> $role
                ], 200);
            } else{
                return response()->json([
                    'erorrCode'=> 404,
                    'message'=> 'Role User Not Found!'
                ], 404);
            }
            
        }catch (\Exception $e) {
            return response()->json([
                'errorCode'=> 400,
                'message'=> $e
            ], 400);
        }
    }

    public function create(Request $request)
    {
        $request->json()->all();
        try{
            $role = RoleUser::create($request->all());

            return response()->json($role, 201);
            return response()->json([
                'success'=> 201,
                'message'=> 'Insert Role User Success!',
                'user'=>$role
            ], 201);
        }catch (\Exception $e) {
            return response()->json([
                'errorCode'=> 400,
                'message'=> "Insert Role User UnSuccess!",
                'errorr'=>$e
            ], 400);
        }
       
        
    }

    public function update($id, Request $request)
    {

        return response()->json($role, 200);
        $request->json()->all();
        try{

            $role = RoleUser::findOrFail($id);
            $role->update($request->all());
    
            return response()->json([
                'success'=> 200,
                'message'=> 'Success Update Role',
                'user'=> $role
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'errorCode'=> 400,
                'message'=> "Role Not Found!",
                'errorr'=>$e
            ], 400);
        }
    }

    public function delete($id)
    {
        try{
            RoleUser::findOrFail($id)->delete();
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