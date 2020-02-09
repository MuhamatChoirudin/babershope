<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\TransaksiDetail;

class TransaksiController extends Controller
{

    public function showAllAuthors()
    {
        return response()->json(Transaksi::all());
    }

    public function showOneAuthor($id)
    {
        return response()->json(Transaksi::find($id));
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
        Transaksi::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}