<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showAllAuthors()
    {
        return response()->json(Cart::all());
    }

    public function showOneAuthor($id)
    {
        return response()->json(Cart::find($id));
    }

    public function create(Request $request)
    {
        $cart = Cart::create($request->all());

        return response()->json($cart, 201);
    }

    public function update($id, Request $request)
    {
        $cart = Cart::findOrFail($id);
        $cart->update($request->all());

        return response()->json($cart, 200);
    }

    public function delete($id)
    {
        Cart::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}