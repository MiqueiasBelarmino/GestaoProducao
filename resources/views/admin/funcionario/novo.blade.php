@extends('adminlte::page')

@if(isset($funcionario))
    @section('title', 'Editar Funcionário')
@else
    @section('title', 'Novo Funcionário')
@endif

@section('content_header')
<h1>Cadastro de Funcionário</h1>
@stop


@section('content')
<div class="box">
<!-- <div class="box-header">
        @if(isset($funcionario))
            <h1>Editar Funcionário</h1>
        @else
            <h1>Novo Funcionário</h1>
        @endif
    </div> -->

    <div class="box-body">
        @include('includes.alerts')
        @if(isset($funcionario))
            <form method="POST" action="{{ route('funcionario.editar.salvar',['id' =>$funcionario->fun_codigo]) }}">
        @else
            <form method="POST" action="{{ route('funcionario.store') }}">
        @endif
            {{csrf_field()}}
            <div class="row">

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_nome}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="rg">RG:</label>
                        <input type="text" name="rg" id="rg" class="form-control" placeholder="Escreva..."
                        value="@if(isset($funcionario)){{$funcionario->fun_rg}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" id="cpf" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_cpf}}@endif" onkeypress="$(this).mask('000.000.000-00');" required>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_email}}@endif">
                    </div>
                </div>

                <div class="col-sm-3">
                    <label for="car_codigo">Cargo:</label>
                    <select name="car_codigo" class="form-control">
                        <option value="">-- Selecione --</option>
                        @foreach($cargos as $key => $cargo)
                            <option value="{{$key}}" @if(isset($funcionario)) {{$funcionario->car_codigo == $key ? 'selected' :''}}  @endif >{{$cargo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="comissao">Comissão:</label>
                        <input type="number" step="0.5" min="0" max="100" name="comissao" id="comissao" class="form-control" 
                        value="@if(isset($funcionario)){{$funcionario->fun_comissao}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" id="telefone" class="telefone form-control" placeholder="(XX) XXXXXXXX" 
                        value="@if(isset($funcionario)){{$funcionario->fun_telefone}}@endif" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="data_admissao">Data Admissão:</label>
                        <input type="date" name="data_admissao" id="data_admissao" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_data_admissao}}@endif" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="text" name="senha" id="senha" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_senha}}@endif" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="observacao">Observação:</label>
                        <textarea class="form-control" name="observacao" id="observacao" rows="2" placeholder="Escreva...">@if(isset($funcionario)){{$funcionario->fun_observacao}}@endif</textarea>
                    </div>
                </div>
            </div>

            
            
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>

@stop
