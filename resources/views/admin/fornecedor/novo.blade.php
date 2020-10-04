@extends('adminlte::page')

@if(isset($fornecedor))
    @section('title', 'Fornecedor')
@else
    @section('title', 'Novo Fornecedor')
@endif

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        @if(isset($fornecedor))
            <h1>Fornecedor</h1>
        @else
            <h1>Novo Fornecedor</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        
        @if(isset($fornecedor))
            <form method="POST" action="{{ route('fornecedor.editar.salvar',['id' =>$fornecedor->for_codigo]) }}">
        @else
            <form method="POST" action="{{ route('fornecedor.store') }}">
        @endif
            {{csrf_field()}}
            <div class="row">

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="nome_razao_social">Nome/Razão Social:</label>
                        <input type="text" name="nome_razao_social" id="nome_razao_social" 
                        class="form-control" placeholder="Escreva..." value="@if(isset($fornecedor)){{$fornecedor->for_nome_razao_social}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="nome_social_fantasia">Nome Social/Nome Fantasia:</label>
                        <input type="text" name="nome_social_fantasia" id="nome_social_fantasia"
                         class="form-control" placeholder="Escreva..." value="@if(isset($fornecedor)){{$fornecedor->for_nome_social_fantasia}}@endif" required>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="rg_inscricao_estadual">RG/Inscrição Estadual:</label>
                        <input type="text" name="rg_inscricao_estadual" id="rg_inscricao_estadual"
                         class="form-control" placeholder="Escreva..." value="@if(isset($fornecedor)){{$fornecedor->for_rg_inscricao_estadual}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="cpf_cnpj">CPF/CNPJ:</label>
                        <input type="text" name="cpf_cnpj" id="cpf_cnpj" class="cpf_cnpj form-control" placeholder="Escreva..." 
                        value="@if(isset($fornecedor)){{$fornecedor->for_cpf_cnpj}}@endif"  required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" name="telefone" id="telefone" class="telefone form-control" placeholder="(XX) XXXXXXXX" 
                        value="@if(isset($fornecedor)){{$fornecedor->for_telefone}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($fornecedor)){{$fornecedor->for_email}}@endif" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="observacao">Observação:</label>
                        <textarea class="form-control" name="observacao" id="observacao"
                         rows="4" placeholder="Escreva...">@if(isset($fornecedor)){{$fornecedor->for_observacao}}@endif</textarea>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>
@stop