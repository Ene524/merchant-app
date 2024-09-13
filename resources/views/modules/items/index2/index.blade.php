@extends('layouts.master')
@section('title', 'Itemler')
@section('content')

    @include('modules.items.index2.modals.modal_item_create_update')
    @include('modules.items.index2.modals.modal_item_excel_import')

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
                    <button id="deleteSelected"
                            style="margin-left:5px"
                            class="btn btn-danger btn-sm pull-right">Seçilenleri Sil
                    </button>

                </div>
                <div class="box-body with-border">
                    <table class="table table-responsive table-bordered"
                           id="items-table"
                           class="display">
                        <thead>
                        <tr>
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
                    </table>

                </div>
            </div>
        </div>

@endsection

@section('customStyle')
    @include('modules.items.index2.components.style')
@endsection

@section('customScript')
    @include('modules.items.index2.components.script')
@endsection
