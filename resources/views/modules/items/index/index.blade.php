@extends('layouts.master')
@section('title', 'Itemler')
@section('content')

    @include('modules.items.index.modals.modal_item_create_update')

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title pull-left">Item Listesi</h3>
                    <button class="btn btn-primary btn-sm pull-right"
                            style="margin-left:5px"
                            data-toggle="modal"
                            data-target="#itemModal">Item Oluştur
                    </button>
                </div>
                <div class="box-body with-border">
                    <table class="table table-responsive table-striped"
                           id="employeeTable">
                        <thead>
                        <tr class="border-bottom-primary">
                            <th style="width:14.2%">Item Adı</th>
                            <th style="width:14.2%">Eldeki Miktar</th>
                            <th style="width:14.2%">Son Alış Fiyatı</th>
                            <th style="width:14.2%">Son Satış Fiyatı</th>
                            <th style="width:14.2%">Son işlemden sonra kâr/zarar</th>
                            <th style="width:14.2%">Oluşturan</th>
                            <th style="width:14.2%">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr data-id="{{ $item->id }}">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity ?? "0" }}</td>
                                <td>{{ $item->last_purchase_price ?? "Bulunamadı"  }}</td>
                                <td>{{ $item->last_sales_price ?? "Bulunamadı" }}</td>
                                <td>{{ $item->profit ?? "Bulunamadı"  }}</td>
                                <td>{{ $item->user_name }}</td>
                                <td>
                                    <a class="btn btn-primary"
                                       href="{{route('item.transactions', $item->id)}}">Hareketler
                                    </a>
                                    <a class="btn btn-warning"
                                       onclick="getItem({{ $item->id }})">Düzenle
                                    </a>
                                    <a class="btn btn-danger"
                                       onclick="deleteItem({{$item->id}})">Sil
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <span class="pull-right"></span>
                </div>
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
