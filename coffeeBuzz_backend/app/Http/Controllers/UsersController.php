<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function showAllUsers() {
        return User::all();
    }

    public function showUserById($id) {
        return User::find($id);
    }

    public function deleteUser($id) {
        User::where('id', $id)->delete();
    }

    public function addUser(Request $request) {
        $user = new User;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->password = $request->password;
        $user->save();
    }

    public function updateUser (Request $request, $id) {
        $user = User::find($id);
        $user->username = $request->input('username');
        $user->role = $request->input('role');
        $user->password = Hash::make($request->input('password'));
        $user->save();
    }
}
