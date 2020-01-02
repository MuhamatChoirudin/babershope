<?php

namespace App\Http\Controllers;

use App\RoleUser;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function showAllAuthors()
    {
        return response()->json(RoleUser::all());
    }

    public function showOneAuthor($id)
    {
        return response()->json(RoleUser::find($id));
    }

    public function create(Request $request)
    {
        $role = RoleUser::create($request->all());

        return response()->json($role, 201);
    }

    public function update($id, Request $request)
    {
        $role = RoleUser::findOrFail($id);
        $role->update($request->all());

        return response()->json($role, 200);
    }

    public function delete($id)
    {
        RoleUser::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}