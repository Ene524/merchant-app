@extends('layouts.master')
@section('title', 'Personel Listesi')
@section('content')

    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title pull-left">Personel Listesi</h3>
                    <a href="" class="btn btn-primary btn-sm pull-right"
                       style="margin-left:5px">Personel Oluştur</a>
                </div>
                <div class="box-body with-border">
                    <table class="table table-responsive table-striped" id="employeeTable">
                        <thead>
                        <tr class="border-bottom-primary">
                            <th scope="col">Adı Soyadı</th>
                            <th scope="col">Email</th>
                            <th scope="col">Departman</th>
                            <th scope="col">Pozisyon</th>
                            <th scope="col">Maaş</th>
                            <th scope="col">İşe Giriş Tarihi</th>

                        </tr>
                        </thead>

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
