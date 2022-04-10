<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {

        $users = User::all();
        echo $users;
    }

    public function store(Request $request)
    {
        $users = new User();
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->address = $request->input('address');
        $users->phone = $request->input('phone');
        $users->random_code = $request->input('random_code');
        $users->avatar = $request->file('avatar')->store("users");
        $users->password = ($request->input("password"));
        $users->save();

        return $users;
    }

    public function login(Request $request)
    {
        $users = User::where('email', $request->email)->where('password', $request->password)->first();
        if ($users != null) {
            return $users;
        }
        return response()->json([
            'status' => 202,
            'message' => 'Add Success',
        ]);
    }

    public function loginAdmin(Request $request)
    {
        $users = User::where('email', $request->email)->where('password', $request->password)->where('random_code', "123")->first();
        return $users;
    }

    public function getUser($id)
    {
        return User::where("id", $id)->first();
    }

    public function updateUser($id, Request $request)
    {
        $users = User::where("id", $id)->first();
        // if ($users != null) {
        $users->name = $request->input('name');
        $users->address = $request->input('address');
        $users->phone = $request->input('phone');
        if ($request->file('avatar')) {
            $users->avatar = $request->file('avatar')->store('users');
        }
        $users->save();
        // }

        return $request->input('name');
    }

    public function changePassword($id, Request $request)
    {
        $users = User::where("id", $id)->first();
        if ($request->input("password") == $users->password) {
            $users->password = ($request->input("new_password"));
            $users->save();
            return response()->json([
                'status' => 201,
                'message' => 'Add Success',
            ]);
        }

        return response()->json([
            'status' => 202,
            'message' => 'Add Success',
        ]);
    }
}
