<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Member;
use App\Transaksi;
use App\TransaksiDetail;

class TransaksiController extends Controller
{

    public function showAllAuthors()
    {
        return response()->json([
            'success'=> 200,
            'message'=> 'User Found!',
            'lisTransaksi'=>Transaksi::all()
        ]);
    }

    public function showOneAuthor($id)
    {
        try{
            $transaksi = Transaksi::find($id);
            if(isset($transaksi) and is_null($transaksi)){
                return response()->json([
                'erorrCode'=> 204,
                'message'=> 'Transaksi Not Found!'
            ],204);
            }elseif($user){
                return response()->json([
                    'success'=> 200,
                    'transaksi'=> $transaksi
                ], 200);
            } else{
                return response()->json([
                    'erorrCode'=> 404,
                    'message'=> 'Transaksi Not Found!'
                ], 404);
            }
            
        }catch (\Exception $e) {
            return response()->json([
                'errorCode'=> 400,
                'message'=> $e
            ], 400);
        }
    }

    // public function create(Request $request)
    // {
    //     $author = Transaksi::create($request->all());

    //     return response()->json($author, 201);
    // }
    public function create(Request $request)
    {

    }
    // public function create(Request $request)
    // {
        // $request->json()->all();
        // $name = $request->input('name');
        // $address = $request->input('address');
        // $phone = $request->input('phone');
        // $status = $request->input('status');
        // $item_id = $request->input('item_id');
        // $member = Member::create([
        //     'name' => $name,
        //     'address' => $address,
        //     'phone' => $phone
        // ]); 
        // $member->transaksiss()->create([
        //     'status' => $status,
        //     'member_id' => $member->id,
        //     'total_tax' => 0,
        //     'total_discount' => 0,
        //     'total_price' => 0,
            
        // ]);
    //    $transaksi ->member()->create([
    //         'name' => $name,
    //         'address' => $address,
    //         'phone' => $phone
    //     ]);

        // $detail ->details()->create(
        //    // 'item_id' => $request->item_id,
        //          'qty' => $request->qty,

        // );

        // $transaksidetail ->createMany(Cart::all()->map(function ($request) { 
        //     return [
        //         'item_id' => $request->item_id,
        //         'qty' => $request->qty,
        //        // 'subtotal' => $cart->item->price * $cart->quantity
        //     ];
        // })->toArray());
        // $author = Transaksi::create($request->all());

        // return response()->json($author, 201);
  //  }

    public function update($id, Request $request)
    {
        $author = Transaksi::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        try{
            Transaksi::findOrFail($id)->delete();
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

    public function dasbod()
    {
        //orderBy('id', 'desc')->take(5)->get();
       $data = Transaksi::latest()->take(5)->get();
       $count = Transaksi::count();
    //    $type = Transaksi::details()->get()->unique('type');
    //    $counttype = $type->count();
       return response()->json([
        'success'=> 200,
        'countTransaksi'=> $count,
        'type'=>0,
        'listTransaction'=>$data

    ], 201);
    }
}