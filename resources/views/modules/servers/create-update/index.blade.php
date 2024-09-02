@extends('layouts.master')
@section('title', 'Server Oluştur')
@section('content')

    <div class="row">
        <div class="col-md-12">


            @if ($errors->all())
                <div class="alert alert-danger"
                     role="alert">
                    <h4 class="alert-heading">Dikkat!</h4>
                    <p>İşleminiz gerçekleştirilemedi</p>
                    <hr>
                    @foreach ($errors->all() as $error)
                        <ul>
                            <li><i class="fa fa-angle-double-right txt-white m-r-10"></i>{{ $error }}</li>
                        </ul>
                    @endforeach
                </div>
            @endif

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Server Ekle</h3>
                </div>
                <div class="box-body with-border">
                    <form class="form-horizontal"
                          action="{{ isset($server) ? route('server.edit', ['id' => $server->id]) : route('server.create') }}"
                          method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputFullName3"
                                       class="col-sm-2 control-label">Adı
                                </label>
                                <div class="col-sm-10">
                                    <input class="form-control"
                                           type="text"
                                           name="name"
                                           placeholder="Adı"
                                           value="{{ isset($server) ? $server->name : '' }}">
                                </div>
                            </div>
                        </div>


                        <div class="box-footer">
                            <button type="button"
                                    class="btn btn-default pull-right"
                                    style="margin-left: 5px">Vazgeç
                            </button>
                            <button type="submit"
                                    class="btn btn-info pull-right">Kaydet
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('customStyle')
    @include('modules.servers.create-update.components.style')
@endsection

@section('customScript')
    @include('modules.servers.create-update.components.script')
@endsection
