@extends('adminlte::page')

@if(isset($funcionario))
    @section('title', 'Funcionário')
@else
    @section('title', 'Novo Funcionário')
@endif

@section('content_header')
<!-- <h1>Cadastro de Funcionário</h1> -->
@stop


@section('content')
<div class="box">
<div class="box-header">
        @if(isset($funcionario))
            <h1>Funcionário</h1>
        @else
            <h1>Novo Funcionário</h1>
        @endif
    </div>

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
                        value="@if(isset($funcionario)){{$funcionario->fun_email}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <label for="car_codigo">Cargo:</label>
                    <select name="car_codigo" class="form-control">
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
                        @if(isset($funcionario))
                            <input type="text" name="senha" id="senha" class="form-control" 
                             required disabled>
                        @else
                            <input type="text" name="senha" id="senha" class="form-control" placeholder="Escreva..." 
                             required>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="rua">Rua:</label>
                            <input type="text" name="rua" id="rua" class="form-control" placeholder="Escreva..." 
                            value="@if(isset($endereco)){{$endereco->end_rua}}@endif" required>
                        </div>
                    </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="numero">Número:</label>
                        <input type="text" name="numero" id="numero" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($endereco)){{$endereco->end_numero}}@endif" required>
                    </div>
                </div>
            </div>
                <div class="row">
                    
                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="bairro">Bairro:</label>
                            <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Escreva..." 
                            value="@if(isset($endereco)){{$endereco->end_bairro}}@endif" required>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="cidade">Cidade:</label>
                            <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Escreva..." 
                            value="@if(isset($endereco)){{$endereco->end_cidade}}@endif" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="cep">CEP:</label>
                            <input type="text" name="cep" id="cep" class="form-control" placeholder="Escreva..." 
                            value="@if(isset($endereco)){{$endereco->end_cep}}@endif" onkeypress="$(this).mask('00000-000');" required>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <input type="text" name="estado" id="estado" class="form-control" placeholder="Escreva..." 
                            value="@if(isset($endereco)){{$endereco->end_estado}}@endif" onkeypress="$(this).mask('AA');" required>
                        </div>
                    </div>

                </div>
                <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="observacao">Observação (Funcionário):</label>
                        <textarea class="form-control" name="observacao" id="observacao" rows="2" placeholder="Escreva...">@if(isset($funcionario)){{$funcionario->fun_observacao}}@endif</textarea>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="observacao_end">Observação (Endereço):</label>
                        <textarea class="form-control" name="observacao_end" id="observacao_end" rows="2" placeholder="Escreva...">@if(isset($endereco)){{$endereco->end_observacao}}@endif</textarea>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>

@stop
