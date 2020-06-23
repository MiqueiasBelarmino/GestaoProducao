@extends('adminlte::page')

@section('title', 'Endereço')

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h1>Funcionário</h1>
    </div>

    <div class="box-body">
        @include('includes.alerts')
        <form method="POST" action="{{ route('funcionario.store') }}">
            {{csrf_field()}}
            <div class="row">

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_nome">Funcionário:</label>
                        <input type="text" name="fun_nome" id="fun_nome" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_nome}}@endif" disabled>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_rg">RG:</label>
                        <input type="text" name="fun_rg" id="fun_rg" class="form-control" placeholder="Escreva..."
                        value="@if(isset($funcionario)){{$funcionario->fun_rg}}@endif" disabled>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_cpf">CPF:</label>
                        <input type="text" name="fun_cpf" id="fun_cpf" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_cpf}}@endif" disabled>
                    </div>
                </div>
            </div>

            <h2>Endereços</h2>
            <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Rua</th>
                    <th>Número</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>CEP</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                </tr>
            </tbody>
        </table>
            
            <!-- <button type="submit" class="btn btn-primary">Confirmar</button> -->
        </form>
    </div>
</div>
@stop