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
        return response()->json(Item::all());
    }

    public function showOneAuthor($item_id)
    {
        return response()->json(Item::find($item_id));
    }

    public function create(Request $request)
    {
        $item = Item::create($request->all());

        return response()->json($item, 201);
    }

    public function update($item_id, Request $request)
    {
        $author = Item::findOrFail($item_id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function delete($item_id)
    {
        Item::findOrFail($item_id)->delete();
        return response('Deleted Successfully', 200);
    }
}