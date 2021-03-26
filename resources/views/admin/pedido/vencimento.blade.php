@extends('adminlte::page')

@section('title', 'Compra')

@section('content_header')
<h1>Confirmar Compra</h1>
@stop

@section('content')
<div class="box">
    <div class="box-body">
        @include('includes.alerts')
        @include('includes.functions')
        <form method="POST" action="{{ route('compra.store') }}">
            {{csrf_field()}}
            <input type="hidden" name="ped_codigo" value="{{$id}}">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="com_data_vencimento">Data Vencimento:</label>
                        <input type="date" name="com_data_vencimento" id="com_data_vencimento" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Confirmar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop