@extends('layouts.master')
@section('title', 'Itemler')
@section('content')

    @include('modules.items.index.modals.modal_item_create_update')
    @include('modules.items.index.modals.modal_item_excel_import')

    <div class="row">
        <div class="col-md-12">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title pull-left">Item Listesi</h3>
                    <button class="btn btn-dark btn-sm pull-right"
                            style="margin-left:5px"
                            data-toggle="modal"
                            data-target="#itemExcelModal">Excelden Al
                    </button>
                    <button class="btn btn-primary btn-sm pull-right"
                            style="margin-left:5px"
                            data-toggle="modal"
                            data-target="#itemModal">Oluştur
                    </button>
                    <button id="selectAll"
                            style="margin-left:5px"
                            class="btn btn-danger btn-sm pull-right">Tümünü Seç
                    </button>
                    <button id="deleteSelected"
                            style="margin-left:5px"
                            class="btn btn-danger btn-sm pull-right">Seçilenleri Sil
                    </button>

                </div>
                <div class="box-body with-border">

                    <div class="row">
                        <form action="{{ route('item.index') }}"
                              method="GET">
                            <div class="col-sm-1">
                                <div class="dataTables_length"
                                     id="example1_length">
                                    <label for="name"
                                           class="control-label"
                                           style="visibility:hidden;">İsim
                                    </label>
                                    <select name="per_page"
                                            aria-controls="example1"
                                            class="form-control">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="name"
                                           class="control-label">İsim
                                    </label>
                                    <input id="name"
                                           class="form-control"
                                           name="name"
                                           placeholder="İsim"
                                           value="{{ request('name') }}">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="name"
                                           class="control-label">Server
                                    </label>
                                    <select id="server_id"
                                            class="form-control select2"
                                            name="server_id">
                                        <option value="">Server Seçiniz</option>
                                        @foreach($servers as $server)
                                            <option value="{{ $server->id }}" {{ request('server_id') == $server->id ? 'selected' : '' }}>
                                                {{ $server->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="name"
                                           class="control-label"
                                           style="visibility:hidden;">
                                        Filtreleme İşlemleri
                                    </label>
                                    <div class="btn-group btn-group-justified"
                                         role="group">
                                        <div class="btn-group"
                                             role="group">
                                            <button type="submit"
                                                    class="btn btn-info">Filtrele
                                            </button>
                                        </div>
                                        <div class="btn-group"
                                             role="group">
                                            <a href="{{ route('item.index') }}"
                                               style="margin-left:10px"
                                               class="btn btn-default">Filtreyi Temizle
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                    <table class="table table-responsive table-bordered"
                           id="itemTable">
                        <thead>
                        <tr class="border-bottom-primary">
                            <th></th>
                            <th style="width:11.1%">Item Adı</th>
                            <th style="width:11.1%">Eldeki Miktar</th>
                            <th style="width:11.1%">Son Alış Fiyatı</th>
                            <th style="width:11.1%">Son Satış Fiyatı</th>
                            <th style="width:11.1%">Son işlemden sonra kâr/zarar</th>
                            <th style="width:11.1%">Server</th>
                            <th style="width:11.1%">Oluşturan</th>
                            <th style="width:11.1%">Oluşturma Zamanı</th>
                            <th style="width:11.1%">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr data-id="{{ $item->id }}">
                                <td>
                                    <input type="checkbox"
                                           class="itemCheckbox"
                                           data-id="{{ $item->id }}">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity ?? '0' }}</td>
                                <td>{{ $item->last_purchase_price ?? 'Bulunamadı' }}</td>
                                <td>{{ $item->last_sales_price ?? 'Bulunamadı' }}</td>
                                <td>{{ $item->profit ?? 'Bulunamadı' }}</td>
                                <td>{{ $item->server_name ?? '' }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a class="btn btn-primary btn-xs"
                                       href="{{ route('item.transactions', $item->id) }}">Hareketler
                                    </a>
                                    <a class="btn btn-warning btn-xs"
                                       onclick="getItem({{ $item->id }})">Düzenle
                                    </a>
                                    <a class="btn btn-danger btn-xs"
                                       onclick="deleteItem({{ $item->id }})">Sil
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <span class="pull-left"
                          style="line-height: 45px">
                    {{$items->currentPage() * $items->perPage() - $items->perPage() + 1}} -
                    {{$items->currentPage() * $items->perPage()}} arasındaki kayıtlar gösteriliyor.
                    Toplam Kayıt :
                    {{$items->total()}}
                        </span>
                    <span class="pull-right">{{$items->appends($_GET)->onEachSide(2)->links()}}</span>


                </div>
            </div>
        </div>

@endsection

@section('customStyle')
    @include('modules.items.index.components.style')
@endsection

@section('customScript')
    @include('modules.items.index.components.script')
@endsection
