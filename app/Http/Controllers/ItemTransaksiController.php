<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\ItemTransaksi;
use Illuminate\Http\Request;

class ItemTransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showAllAuthors()
    {
        return response()->json(ItemTransaksi::all());
    }

    public function showOneAuthor($item_id)
    {
        return response()->json(ItemTransaksi::find($item_id));
    }

    // public function create(Request $request)
    // {
    //     $item = ItemTransaksi::create($request->all());
        
    //     return response()->json($item, 201);
    // }

    public function create(Request $request)
    {
        $status = $request->input('status');
        $transaksi= Transaksi::create([
            'total_tax'=>0,
            'total_discount'=>0,
            'total_price'=>0,
            'status'=>$status
        ]);
        // $item_id=$request->input('item_id');
        // $qty=$request->input('qty');
        // $item = ItemTransaksi::create([
        //     'item_id' => $item_id,
        //     'transaction_id'=>1,
        //     'qty'=>$qty
        // ]);
        // $author->update($request->all());
        
        return response()->json($transaksi, 201);
    }

    public function update($item_id, Request $request)
    {
        $author = ItemTransaksi::findOrFail($item_id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($item_id)
    {
        IteItemTransaksi::findOrFail($item_id)->delete();
        return response('Deleted Successfully', 200);
    }
}