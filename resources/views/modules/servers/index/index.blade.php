@extends('layouts.master')
@section('title', 'Kullanıcı Listesi')
@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif


            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title pull-left">Server Listesi</h3>
                    <a href="{{ route('server.create') }}"
                       class="btn btn-primary btn-sm btn-square
                    pull-right">Server
                        Oluştur
                    </a>
                </div>
                <div class="box-body with-border">
                    <table class="table table-responsive table-striped">
                        <thead>
                        <tr class="border-bottom-primary">
                            <th style="width:33.3%">#</th>
                            <th style="width:33.3%">Adı</th>
                            <th style="width:33.3%">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($servers as $server)
                            <tr data-id="{{ $server->id }}">
                                <th>{{ $server->id }}</th>
                                <td>{{ $server->name }}</td>

                                <td>
                                    <a href="{{ route('server.edit', ['id' => $server->id]) }}"
                                       class="btn btn-primary btn-xs"
                                       data-id="{{ $server->id }}"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Düzenle"><i
                                            class="fa fa-edit"></i></a>
                                    <a class="btn btn-danger btn-xs"
                                       onclick="deleteItem({{$server->id}})">Sil
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyle')
    @include('modules.servers.index.components.style')
@endsection

@section('customScript')
    @include('modules.servers.index.components.script')
@endsection
