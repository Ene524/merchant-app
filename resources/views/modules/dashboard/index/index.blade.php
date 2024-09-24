@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

    <div class="row">
        <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$itemCount}}</h3>
                    <p>Item Adeti</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="#"
                   class="small-box-footer">
                    More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$mostUsedServer->name}}<sup style="font-size: 20px"></sup></h3>
                    <p>En çok itemin bulunduğu server</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#"
                   class="small-box-footer">
                    More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$userCount}}</h3>
                    <p>Sistemde tanımlı kullanıcı adeti</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#"
                   class="small-box-footer">
                    More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6">

            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$bestTransactionItem->item->name}}</h3>
                    <p>En popüler item</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#"
                   class="small-box-footer">
                    More info
                    <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>

@endsection

@section('customStyle')
    @include('modules.dashboard.index.components.style')
@endsection

@section('customScript')
    @include('modules.dashboard.index.components.script')
@endsection
