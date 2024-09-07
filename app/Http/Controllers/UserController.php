<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view("modules.users.index.index", compact("users"));
    }

    public function create()
    {
        return view("modules.users.create-update.index");
    }

    public function store(UserCreateRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->is_admin = $request->is_admin != null ? 1 : 0;
        $user->save();

        return redirect()->route('user.index')->with('success', 'Kullanıcı başarıyla oluşturuldu');
    }

    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('modules.users.create-update.index', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        //dd($request->all());
        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        $user->email_verified_at = now();
        $user->is_admin = $request->is_admin != null ? 1 : 0;
        $user->save();
        return redirect()->route('user.index')->with('success', 'Kullanıcı başarıyla güncellendi');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'userID' => 'required|exists:users,id',
        ]);
        $user = User::find($request->userID);
        $user->delete();
        return response()->json(['status' => 'success']);
    }
}
