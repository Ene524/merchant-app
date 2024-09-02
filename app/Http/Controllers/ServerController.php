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
        $server->save();

        return redirect()->route('server.index')->with('success', 'Server başarıyla oluşturuldu');
    }

    public function edit($id)
    {
        $server = Server::findOrfail($id);
        return view('modules.servers.create-update.index', compact('server'));
    }

    public function update(ServerRequest $request, $id)
    {
        $server = Server::findOrfail($id);
        $server->name = $request->name;
        $server->save();
        return redirect()->route('server.index')->with('success', 'Server başarıyla güncellendi');
    }

    public function delete(Request $request)
    {
        $server = Server::find($request->id);
        $server->delete();
        return response()->json(['status' => 'success']);
    }
}
