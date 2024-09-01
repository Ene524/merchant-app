<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index()
    {
        $servers = Server::all();
        return view("modules.servers.index.index", compact("servers"));
    }

    public function create()
    {
        return view("modules.servers.create-update.index");
    }

    public function store(ServerRequest $request)
    {
        $server = new Server();
        $server->name = $request->name;
        $server->email = $request->email;
        $server->password = Hash::make($request->password);
        $server->email_verified_at = now();
        $server->save();

        return redirect()->route('server.index')->with('success', 'Kullanıcı başarıyla oluşturuldu');
    }

    public function edit($id)
    {
        $server = Server::findOrfail($id);
        return view('modules.serves.create-update.index', compact('server'));
    }

    public function update(ServerRequest $request, $id)
    {
        $server = Server::findOrfail($id);
        $server->name = $request->name;
        $server->email = $request->email;
        $server->password = Hash::make($request->password);
        $server->email_verified_at = now();
        $server->save();
        $server->syncRoles($request->role);
        return redirect()->route('server.index')->with('success', 'Kullanıcı başarıyla güncellendi');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'serverID' => 'required|exists:server,id',
        ]);
        $server = Server::find($request->serverID);
        $server->delete();
        return response()->json(['status' => 'success']);
    }
}
