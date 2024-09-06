@extends('layouts.master')
@section('title', 'Dashboard')
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
                    <h3 class="box-title pull-left">Dashboard</h3>
                </div>
                <div class="box-body with-border">
                    {{--                    <canvas id="itemChart" width="400" height="150"></canvas>--}}
                </div>
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
