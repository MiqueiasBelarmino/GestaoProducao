@extends('adminlte::page')

@if(isset($cliente))
@section('title', 'Cliente')
@else
@section('title', 'Novo Cliente')
@endif

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        @if(isset($cliente))
        <h1>Cliente</h1>
        @else
        <h1>Novo Cliente</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @include('includes.functions')
        @if(isset($cliente))
        <form method="POST" action="{{ route('cliente.editar.salvar',['id' =>$cliente->cli_codigo]) }}">
            @else
            <form method="POST" action="{{ route('cliente.store') }}">
                @endif
                {{csrf_field()}}
                <div class="row">

                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="nome_razao_social">Nome/Razão Social:</label>
                            <input type="text" name="nome_razao_social" id="nome_razao_social" class="form-control" placeholder="Escreva..." value="@if(isset($cliente)){{$cliente->cli_nome_razao_social}}@endif" required>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="nome_social_fantasia">Nome Social/Nome Fantasia:</label>
                            <input type="text" name="nome_social_fantasia" id="nome_social_fantasia" class="form-control" placeholder="Escreva..." value="@if(isset($cliente)){{$cliente->cli_nome_social_fantasia}}@endif">
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="rg_inscricao_estadual">RG/Inscrição Estadual:</label>
                            <input type="text" name="rg_inscricao_estadual" id="rg_inscricao_estadual" class="form-control" placeholder="Escreva..." value="@if(isset($cliente)){{$cliente->cli_rg_inscricao_estadual}}@endif">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="cpf_cnpj">CPF/CNPJ:</label>
                            <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="cpf_cnpj form-control" placeholder="Escreva..." value="@if(isset($cliente)){{$cliente->cli_cpf_cnpj}}@endif" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="telefone">Telefone:</label>
                            <input type="text" name="telefone" id="telefone" class="telefone form-control" placeholder="(XX) XXXXXXXX" value="@if(isset($cliente)){{$cliente->cli_telefone}}@endif" required>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Escreva..." value="@if(isset($cliente)){{$cliente->cli_email}}@endif" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="rua">Rua:</label>
                            <input type="text" name="rua" id="rua" class="form-control" placeholder="Escreva..." value="@if(isset($endereco)){{$endereco->end_rua}}@endif" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="numero">Número:</label>
                            <input type="text" name="numero" id="numero" class="form-control" placeholder="Escreva..." value="@if(isset($endereco)){{$endereco->end_numero}}@endif" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="bairro">Bairro:</label>
                            <input type="text" name="bairro" id="bairro" class="form-control" placeholder="Escreva..." value="@if(isset($endereco)){{$endereco->end_bairro}}@endif" required>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="cidade">Cidade:</label>
                            <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Escreva..." value="@if(isset($endereco)){{$endereco->end_cidade}}@endif" required>
                        </div>
                    </div>
                </div>
                <div class="row">


                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="cep">CEP:</label>
                            <input type="text" name="cep" id="cep" class="form-control" placeholder="Escreva..." value="@if(isset($endereco)){{$endereco->end_cep}}@endif" onkeypress="$(this).mask('00000-000');" required>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <!-- text input -->
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <input type="text" name="estado" id="estado" class="form-control" placeholder="Escreva..." value="@if(isset($endereco)){{$endereco->end_estado}}@endif" onkeypress="$(this).mask('AA');" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="observacao_end">Observação (Endereço):</label>
                            <textarea class="form-control" name="observacao_end" id="observacao_end" rows="2" placeholder="Escreva...">@if(isset($endereco)){{$endereco->end_observacao}}@endif</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="observacao">Observação (Cliente):</label>
                            <textarea class="form-control" name="observacao" id="observacao" rows="2" placeholder="Escreva...">@if(isset($funcionario)){{$funcionario->fun_observacao}}@endif</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </form>
    </div>
</div>
@stop