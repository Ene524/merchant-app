@extends('layouts.master')
@section('title', 'Itemler')
@section('content')

    @include('modules.transactions.index.modals.modal_item_transaction_create_update')

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title pull-left">{{"Item Adı : ". $item->name}}</h3>
                    <button class="btn btn-primary btn-sm pull-right"
                            style="margin-left:5px"
                            data-toggle="modal"
                            data-target="#itemTransactionModal">Hareket Oluştur
                    </button>
                </div>
                <div class="box-body with-border">
                    <table class="table table-responsive table-striped"
                           id="employeeTable">
                        <thead>
                        <tr class="border-bottom-primary">
                            <th scope="col">Fiyat Tipi</th>
                            <th scope="col">Fiyat</th>
                            <th scope="col">Tarih</th>
                            <th scope="col">Fiyatı Giren</th>
                            <th scope="col">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itemTransactions as $itemTransaction)
                            <tr data-id="{{ $itemTransaction->id }}">
                                <td>{{ $itemTransaction->type }}</td>
                                <td>{{ $itemTransaction->quantity ?? "0" }}</td>
                                <td>{{ $itemTransaction->last_purchase_price ?? "0.00" }}</td>
                                <td>{{ $itemTransaction->last_sales_price ?? "0.00" }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('item.transactions')}}">Fiyat</a>
                                    <a class="btn btn-warning"
                                            onclick="getItem({{ $itemTransaction->id }})">Düzenle
                                    </a>
                                    <a class="btn btn-danger"
                                            onclick="deleteItem({{$itemTransaction->id}})">Sil
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
    @include('modules.transactions.index.components.style')
@endsection

@section('customScript')
    @include('modules.transactions.index.components.script')
@endsection
