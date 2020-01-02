<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Member;
use App\Transaksi;

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

    public function create(Request $request, Cart $cart)
    {
        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $status = $request->input('status');
        $member = Member::create([
            'name' => $name,
            'address' => $address,
            'phone' => $phone
        ]);

        // $transaksi = Transaksi::create

        // $tansaksi = 
        $member->transaksiss()->create([
            'status' => $status,
            'member_id' => $member->id,
            'total_tax' => 0,
            'total_discount' => 0,
            'total_price' => 0,
            
        ]);
    //    $transaksi ->member()->create([
    //         'name' => $name,
    //         'address' => $address,
    //         'phone' => $phone
    //     ]);

        // $detail ->details()->create(
        //  //   'item_id'=>$request->input('item_id');

        // );

        $detail ->details() ->createMany(Cart::all()->map(function ($cart) { 
            return [
                'item_id' => $cart->item_id,
                'qty' => $cart->qty,
               // 'subtotal' => $cart->item->price * $cart->quantity
            ];
        })->toArray());
        // $author = Transaksi::create($request->all());

        // return response()->json($author, 201);
    }

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