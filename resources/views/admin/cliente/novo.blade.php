@extends('adminlte::page')

@if(isset($cliente))
    @section('title', 'Editar Cliente')
@else
    @section('title', 'Novo Cliente')
@endif

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        @if(isset($cliente))
            <h1>Editar Cliente</h1>
        @else
            <h1>Novo Cliente</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        
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
                        <label for="cli_nome_razao_social">Nome/Razão Social:</label>
                        <input type="text" name="cli_nome_razao_social" id="cli_nome_razao_social" 
                        class="form-control" placeholder="Escreva..." required value="@if(isset($cliente)){{$cliente->cli_nome_razao_social}}@endif">
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="cli_nome_social_fantasia">Nome Social/Nome Fantasia:</label>
                        <input type="text" name="cli_nome_social_fantasia" id="cli_nome_social_fantasia"
                         class="form-control" placeholder="Escreva..." value="@if(isset($cliente)){{$cliente->cli_nome_social_fantasia}}@endif" required>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="cli_rg_inscricao_estadual">RG/Inscrição Estadual:</label>
                        <input type="text" name="cli_rg_inscricao_estadual" id="cli_rg_inscricao_estadual"
                         class="form-control" placeholder="Escreva..." value="@if(isset($cliente)){{$cliente->cli_rg_inscricao_estadual}}@endif">
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="cli_cpf_cnpj">CPF/CNPJ:</label>
                        <input type="text" name="cli_cpf_cnpj" id="cli_cpf_cnpj" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($cliente)){{$cliente->cli_cpf_cnpj}}@endif" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="cli_telefone">Telefone:</label>
                        <input type="text" name="cli_telefone" id="cli_telefone" class="form-control" placeholder="(XX) XXXXXXXX" 
                        value="@if(isset($cliente)){{$cliente->cli_telefone}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="cli_email">E-mail:</label>
                        <input type="email" name="cli_email" id="cli_email" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($cliente)){{$cliente->cli_email}}@endif" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="cli_observacao">Observação:</label>
                        <textarea class="form-control" name="cli_observacao" id="cli_observacao"
                         rows="4" placeholder="Escreva...">@if(isset($cliente)){{$cliente->cli_observacao}}@endif</textarea>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>
@stop