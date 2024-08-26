@extends('user.layouts.master')
@section('title', 'Personel Oluştur')
@section('content')

    <div class="row">
        <div class="col-md-12">


            @if ($errors->all())
                <div class="alert alert-danger" role="alert">
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
                    <h3 class="box-title">Personel Ekle</h3>
                </div>
                <div class="box-body with-border">
                    <form class="form-horizontal"
                          action="{{isset($employee)? route('user.items.edit',['id'=>$employee->id]) :route('user.items.create')}}"
                          method="POST">
                        @csrf
                        <div class="box-body">

                            <div class="form-group">
                                <label for="inputFullName3" class="col-sm-2 control-label">Ad Soyad</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="full_name" placeholder="Ad Soyad"
                                           value="{{isset($employee) ? $employee->full_name:""}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email" placeholder="Email"
                                           value="{{isset($employee) ? $employee->email:""}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Parola</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="password" name="password" placeholder="Parola"
                                           value="{{isset($employee) ? $employee->password:""}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Departman</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="department_id" style="width: 100%">
                                        <option value={{null}}>Departman Seç</option>
                                        @foreach($departments as $item)
                                            <option
                                                value="{{ $item->id }}" {{ isset($employee) && $employee->department_id == $item->id ? "selected" : "" }}>{{ $item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Pozisyon</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="position_id">
                                        <option value={{null}}>Pozisyon Seç</option>
                                        @foreach($positions as $item)
                                            <option
                                                value="{{ $item->id }}" {{ isset($employee) && $employee->position_id == $item->id ? "selected" : "" }}>{{ $item->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Maaş</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2" name="salary_id">
                                        <option value={{null}}>Maaş Seç</option>
                                        @foreach($salaries as $item)
                                            <option
                                                value="{{ $item->id }}" {{ isset($employee) && $employee->salary_id == $item->id ? "selected" : "" }}>{{ $item->amount}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">İşe Başlama Tarihi</label>
                                <div class="col-sm-10">
                                    <input name="employment_date" class="form-control" type="date"
                                           value="{{isset($employee) ? $employee->employment_date->format('Y-m-d'):date('Y-m-d')}}">
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="button" class="btn btn-default pull-right" style="margin-left: 5px">Vazgeç
                                </button>
                                <button type="submit" class="btn btn-info pull-right">Kaydet</button>

                            </div>

                        </div>


                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('customStyle')
    @include('user.modules.items.item-price.components.style')
@endsection

@section('customScript')
    @include('user.modules.items.item-price.components.script')
@endsection
