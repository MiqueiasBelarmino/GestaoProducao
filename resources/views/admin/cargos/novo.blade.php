@extends('adminlte::page')
@if(isset($cargo))
    @section('title', 'Cargo')
@else
    @section('title', 'Novo Cargo')
@endif

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        @if(isset($cargo))
            <h1>Cargo</h1>
        @else
            <h1>Novo Cargo</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @include('includes.functions')
        @if(isset($cargo))
            <form method="POST" action="{{ route('cargo.editar.salvar',['id' =>$cargo->car_codigo]) }}">
        @else
            <form method="POST" action="{{ route('cargo.store') }}">
        @endif
            {{csrf_field()}}
            <div class="row">

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control" value="@if(isset($cargo)) {{$cargo->car_nome}} @endif" placeholder="Escreva..." required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="salario_base">Salário Base (R$)</label>
                        <!-- <input type="number" step="0.01" min="1" max="20000" value="@if(isset($cargo)) {{$cargo->car_salario_base}} @endif" name="salario_base" id="salario_base" class="form-control" placeholder="Escreva..."> -->
                        <input type="text" value="@if(isset($cargo)) {{$cargo->car_salario_base}} @endif" name="salario_base" id="salario_base" class="form-control" placeholder="Escreva..." required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="observacao">Observação:</label>
                        <textarea class="form-control" name="observacao" id="observacao" rows="3" placeholder="Escreva...">@if(isset($cargo)){{trim($cargo->car_observacao)}}@endif</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>
@stop