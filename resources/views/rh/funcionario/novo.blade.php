@extends('adminlte::page')

@section('title', 'Novo Funcionário')

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h1>Novo Funcionário</h1>
    </div>

    <div class="box-body">
        @include('includes.alerts')
        <form method="POST" action="{{ route('funcionario.store') }}">
            {{csrf_field()}}
            <div class="row">

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_nome">Nome:</label>
                        <input type="text" name="fun_nome" id="fun_nome" class="form-control" placeholder="Escreva..." required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_rg">RG:</label>
                        <input type="text" name="fun_rg" id="fun_rg" class="form-control" placeholder="Escreva..." required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_cpf">CPF:</label>
                        <input type="text" name="fun_cpf" id="fun_cpf" class="form-control" placeholder="Escreva..." required>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_email">E-mail:</label>
                        <input type="email" name="fun_email" id="fun_email" class="form-control" placeholder="Escreva...">
                    </div>
                </div>

                <div class="col-sm-3">
                    <label for="car_codigo">Cargo:</label>
                    <select name="car_codigo" class="form-control">
                        <option value="">-- Selecione --</option>
                        @foreach($cargos as $key => $cargo)
                            <option value="{{$key}}">{{$cargo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_comissao">Comissão:</label>
                        <input type="number" step="0.01" min="1" max="100" name="fun_comissao" id="fun_comissao" class="form-control"  required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_telefone">Telefone:</label>
                        <input type="text" name="fun_telefone" id="fun_telefone" class="form-control" placeholder="(XX) XXXXXXXX" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_data_admissao">Data Admissão:</label>
                        <input type="date" name="fun_data_admissao" id="fun_data_admissao" class="form-control" placeholder="Escreva..." required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="fun_observacao">Observação:</label>
                        <textarea class="form-control" name="fun_observacao" id="fun_observacao" rows="4" placeholder="Escreva..."></textarea>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>
@stop