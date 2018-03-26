<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;

class UsersController extends Controller
{
    public function index()
    {
        // return response()->json(User::get(), 200);
        $user =User::join('user_addresses', 'users.id', '=', 'user_addresses.user_id')
                ->join('user_roles', 'users.user_roles_id', '=', 'user_roles.id')
                ->get();
        return response()->json($user, 200);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(null, 404);
        }
        return response()->json(User::findOrFail($id), 200);
        // $user = User::where('user.id', '=', '$id')
    }

    public function store(Request $request)
    {
        $rules = [
            'username' => 'required|max:255',
            'email' => 'required|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        } 

        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json($user, 200);
    }

    public function delete(Request $request, User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }

    public function errors()
    {
        return response()->json(['msg' => 'Payment is required'], 501);
    }
}
