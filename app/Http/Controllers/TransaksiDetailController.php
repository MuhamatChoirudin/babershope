<?php

namespace App\Http\Controllers;

use App\Transaksi;
use App\Item;
use App\TransaksiDetail;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class TransaksiDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showAllAuthors()
    {
        return response()->json(TransaksiDetail::all());
    }

    public function showOneAuthor($item_id)
    {
        return response()->json(TransaksiDetail::find($item_id));
    }

    // public function create(Request $request)
    // {
    //     $item = ItemTransaksi::create($request->all());
        
    //     return response()->json($item, 201);
    // }

    public function create(Request $request, TransaksiDetail $trantel, Item $item )
    {
        $request->json()->all();
        $status = $request->input('status');
        $name = $request->input('name');
        $item_id = $request->input('item_id');
        $qty = $request->input('qty');
        
        $transaksi = Transaksi::create([
                'name'=>$name,
                'total_tax'=>0,
                'total_discount'=>0,
                'total_price'=>0,
                'status'=>$status
            ]);

            foreach ($trantel as $detail) {
                // code
                        $transaksidetail = TransaksiDetail::create([
                        'item_id' => $detail->item_id,
                        'transaction_id'=>$transaksi->id,
                        'qty'=>  $detail->qty
                    ]);
               }
           // $detail = $trantel->all();
            // $transaksi->details->createMany(TransaksiDetail::all()->map(function ($trantel) use ($transaksi) { 
            //     return [
            //         'item_id' => $trantel->item_id,
            //         'transaksi_id' => $transaksi->id,
            //         'qty' => $trantel->qty
            //     ];
            // })->toArray());

        // $transaksi->transaksis()->create([
        //     'name'=>$name,
        //     'total_tax'=>0,
        //     'total_discount'=>0,
        //     'total_price'=>0,
        //     'status'=>$status
        // ]);
        // $item_id=$request->input('item_id');
        // $qty=$request->input('qty');
        // $transaksidetail = TransaksiDetail::create([
        //     'item_id' => $item_id,
        //     'transaction_id'=>$transaksi->id,
        //     'qty'=>$qty
        // ]);
        // $author->update($request->all());
        
        return response()->json($transaksi, 201);
    }

    public function update($item_id, Request $request)
    {
        $author = TransaksiDetail::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        TransaksiDetail::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}