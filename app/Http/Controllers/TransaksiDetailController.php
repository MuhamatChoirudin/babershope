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
       // $this->middleware('auth');
    }
    public function showAllAuthors()
    {
        return response()->json([
            'success'=> 200,
            'message'=> 'User Found!',
            'listItemTransaksi'=>TransaksiDetail::all()
        ]);
    }

    public function showOneAuthor($id)
    {
        try{
            $item = TransaksiDetail::find($id);
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
        
        $status = $request->input('status');
        $name = $request->input('name');
        $item_id = $request->input('item_id');
        $qty = $request->input('qty');
        $total_discount = $request->input('total_discount', 0);
        
        
        $transaksi = Transaksi::create([
                    'name' => $name,
                    'total_tax' => 0,
                    'total_discount' => 0,
                    'total_price' => 0,
                    'status' => $status
        ]);

        for($count = 0; $count < count($item_id); $count++){
            $transaksidetail[] = TransaksiDetail::create([
                        'item_id' => $item_id[$count],
                        'transaksi_id' => $transaksi->id,
                        'qty' => $qty[$count],

                        $item = Item::find($item_id[$count]),
                        $totaltran = ($item->price * $qty[$count]),
                        $hasil=$totaltran++
            ]);
        }
        $idTransaksi = $transaksi->id;
        $transaksi = Transaksi::findOrFail($idTransaksi);
        $transaksi->update([
            'name' => $name,
            'total_tax' => $hasil,
            'total_discount' => $total_discount,
            'total_price' => $hasil- $total_discount,
            'status' => $status
        ]);


        return response()->json(array(
                        'transaksi' => $transaksi,
                        'transaksidetail' => $transaksidetail
        ), 200);

    }

    // public function create(Request $request)
    // {
    //     $item = ItemTransaksi::create($request->all());
        
    //     return response()->json($item, 201);
    // }

    // public function create(Request $request, TransaksiDetail $trantel, Item $item )
    // {
    //     $request->json()->all();
    //     $status = $request->input('status');
    //     $name = $request->input('name');
    //     $item_id = $request->input('item_id');
    //     $qty = $request->input('qty');
        
    //     $transaksi = Transaksi::create([
    //             'name'=>$name,
    //             'total_tax'=>0,
    //             'total_discount'=>0,
    //             'total_price'=>0,
    //             'status'=>$status
    //         ]);

    //         foreach ($trantel as $detail) {
    //             // code
    //                     $transaksidetail = TransaksiDetail::create([
    //                     'item_id' => $detail->item_id,
    //                     'transaction_id'=>$transaksi->id,
    //                     'qty'=>  $detail->qty
    //                 ]);
    //            }
    //        // $detail = $trantel->all();
    //         // $transaksi->details->createMany(TransaksiDetail::all()->map(function ($trantel) use ($transaksi) { 
    //         //     return [
    //         //         'item_id' => $trantel->item_id,
    //         //         'transaksi_id' => $transaksi->id,
    //         //         'qty' => $trantel->qty
    //         //     ];
    //         // })->toArray());

    //     // $transaksi->transaksis()->create([
    //     //     'name'=>$name,
    //     //     'total_tax'=>0,
    //     //     'total_discount'=>0,
    //     //     'total_price'=>0,
    //     //     'status'=>$status
    //     // ]);
    //     // $item_id=$request->input('item_id');
    //     // $qty=$request->input('qty');
    //     // $transaksidetail = TransaksiDetail::create([
    //     //     'item_id' => $item_id,
    //     //     'transaction_id'=>$transaksi->id,
    //     //     'qty'=>$qty
    //     // ]);
    //     // $author->update($request->all());
        
    //     return response()->json($transaksi, 201);
    // }

    public function update($item_id, Request $request)
    {
        $author = TransaksiDetail::findOrFail($id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($id)
    {
        try{
            TransaksiDetail::findOrFail($id)->delete();
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