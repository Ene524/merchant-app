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
                    <h3 class="box-title pull-left">{{ $item->name . " - Hareketler"}}</h3>
                    <input type="hidden"
                           name="item_id"
                           id="item_id"
                           value="{{$item->id}}"/>
                    <button class="btn btn-primary btn-sm pull-right"
                            style="margin-left:5px"
                            data-toggle="modal"
                            data-target="#itemTransactionModal">Hareket Oluştur
                    </button>
                </div>
                <div class="box-body with-border">
                    <table class="table table-responsive"
                           id="itemTransactionTable">
                        <thead>
                        <tr class="border-bottom-primary">
                            <th style="width:16.6%">Fiyat Tipi</th>
                            <th style="width:16.6%">Miktar</th>
                            <th style="width:16.6%">Fiyat</th>
                            <th style="width:16.6%">Tarih</th>
                            <th style="width:16.6%">İşlem Yapan</th>
                            <th style="width:16.6%">İşlemler</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($itemTransactions as $itemTransaction)
                            <tr data-id="{{ $itemTransaction->id }}">

                                <td>{{ $itemTransaction->type==1 ? 'Alış':'Satış' }}</td>
                                <td>{{ $itemTransaction->quantity }}</td>
                                <td>{{ $itemTransaction->price }}</td>
                                <td>{{ $itemTransaction->created_at }}</td>
                                <td>{{ $itemTransaction->user->name }}</td>
                                <td>
                                    <a class="btn btn-warning btn-xs"
                                       onclick="getItemTransaction({{ $itemTransaction->id }})">Düzenle
                                    </a>
                                    <a class="btn btn-danger btn-xs"
                                       onclick="deleteItemTransaction({{$itemTransaction->id}})">Sil
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
