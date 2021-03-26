@extends('adminlte::page')

@section('title', 'Editar Cargo')

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h1>Editar Cargo</h1>
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @include('includes.functions')
        <form method="POST" action="{{ route('cargo.store') }}">
            {{csrf_field()}}
            <div class="row">

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="car_nome">Nome:</label>
                        <input type="text" name="car_nome" id="car_nome" class="form-control" placeholder="Escreva...">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="car_salario_base">Salário Base (R$)</label>
                        <!-- <input type="number" step="0.01" min="1" max="20000" name="car_salario_base" id="car_salario_base" class="form-control" placeholder="Escreva..."> -->
                        <input type="text" name="car_salario_base" id="car_salario_base" class="form-control" placeholder="Escreva...">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="car_descricao">Descrição:</label>
                        <input type="text" name="car_descricao" id="car_descricao" class="form-control" placeholder="Escreva...">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="car_observacao">Observação:</label>
                        <textarea class="form-control" name="car_observacao" id="car_observacao" rows="4" placeholder="Escreva..."></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>
@stop