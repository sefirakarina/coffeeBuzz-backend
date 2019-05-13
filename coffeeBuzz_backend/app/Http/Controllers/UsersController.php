<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->middleware('auth:api', ['except' => ['store']]);
        $this->user = $user;
    }

    public function index()
    {
        $user = User::all();
        $array = Array();
        $array['data'] = $user;
        if (count($user) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        $array = Array();
        $array['data'] = $user;
        if (count($user) > 0) {
            return response()->json($array, 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        if ($user != null) {
            return response()->json($user, 200);
        } else {
            return response()->json(['error' => 'User cannot be deleted'], 404);
        }
    }

    public function store(Request $request)
    {
        $newUser = [
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role,
            'password' => Hash::make($request->password),
        ];

        if ($newUser != null) {
            try{
                $new = $this->user->create($newUser);
                $array = Array();
                $array['data'] = $new;
                return response()->json($array, 200);
            }catch (\Exception $e){
                return response()->json(['error' => 'Username duplication'], 422);
            }
        } else {
            return response()->json(['error' => 'User not added'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $request->id)->update([
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        if ($user != null) {
            return response()->json($user, 200);
        } else {
            return response()->json(['error' => 'User not updated'], 404);
        }
    }

    public function adminUpdateUser(Request $request)
    {
        $user = User::where('id', $request->id)->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);
        if ($user != null) {
            return response()->json($user, 200);
        } else {
            return response()->json(['error' => 'User not updated'], 404);
        }
    }
}
