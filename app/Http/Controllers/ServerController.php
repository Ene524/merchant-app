<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServerController extends Controller
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

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('user.index')->with('success', 'Kullanıcı başarıyla oluşturuldu');
    }

    public function edit($id)
    {
        $user = User::findOrfail($id);
        return view('modules.user.create-update.index', compact('user'));
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = now();
        $user->save();
        $user->syncRoles($request->role);
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
