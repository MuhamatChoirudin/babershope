<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showAllAuthors()
    {
        return response()->json([
            'success'=> 200,
            'message'=> 'User Found!',
            'List User'=>Item::all()
        ]);
    }

    public function showOneAuthor($id)
    {
        try{
            $item = Item::find($id);
            if(isset($item) and is_null($item)){
                return response()->json([
                'erorrCode'=> 204,
                'message'=> 'Item Not Found!'
            ],204);
            }elseif($user){
                return response()->json([
                    'success'=> 200,
                    'message'=> 'Item Found!',
                    'user'=> $item
                ], 200);
            } else{
                return response()->json([
                    'erorrCode'=> 404,
                    'message'=> 'Item Not Found!'
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
    try{
        $item = Item::create($request->all());

        return response()->json([
            'success'=> 201,
            'message'=> 'Register Success!',
            'user'=>$item
        ], 201);
    }catch (\Exception $e) {

        return response()->json([
            'errorCode'=> 400,
            'message'=> $e
        ], 400);
    }
    }

    public function update($id, Request $request)
    {
        $item = Item::findOrFail($id);
        $item->update($request->all());

        $request->json()->all();
        try{
            $item = Item::findOrFail($id);
            $item->update($request->all());
            return response()->json([
                'success'=> 200,
                'message'=> 'Success Update User',
                'List Item'=> $item
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
            Item::findOrFail($id)->delete();
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