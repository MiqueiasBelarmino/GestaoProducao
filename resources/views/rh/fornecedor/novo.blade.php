@extends('adminlte::page')

@if(isset($fornecedor))
    @section('title', 'Editar Fornecedor')
@else
    @section('title', 'Novo Fornecedor')
@endif

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        @if(isset($fornecedor))
            <h1>Editar Fornecedor</h1>
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
                        <label for="for_nome_razao_social">Nome/Razão Social:</label>
                        <input type="text" name="for_nome_razao_social" id="for_nome_razao_social" 
                        class="form-control" placeholder="Escreva..." required value="@if(isset($fornecedor)){{$fornecedor->for_nome_razao_social}}@endif">
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_nome_social_fantasia">Nome Social/Nome Fantasia:</label>
                        <input type="text" name="for_nome_social_fantasia" id="for_nome_social_fantasia"
                         class="form-control" placeholder="Escreva..." value="@if(isset($fornecedor)){{$fornecedor->for_nome_social_fantasia}}@endif" required>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_rg_inscricao_estadual">RG/Inscrição Estadual:</label>
                        <input type="text" name="for_rg_inscricao_estadual" id="for_rg_inscricao_estadual"
                         class="form-control" placeholder="Escreva..." value="@if(isset($fornecedor)){{$fornecedor->for_rg_inscricao_estadual}}@endif">
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_cpf_cnpj">CPF/CNPJ:</label>
                        <input type="text" name="for_cpf_cnpj" id="for_cpf_cnpj" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($fornecedor)){{$fornecedor->for_cpf_cnpj}}@endif" required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_telefone">Telefone:</label>
                        <input type="text" name="for_telefone" id="for_telefone" class="form-control" placeholder="(XX) XXXXXXXX" 
                        value="@if(isset($fornecedor)){{$fornecedor->for_telefone}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_email">E-mail:</label>
                        <input type="email" name="for_email" id="for_email" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($fornecedor)){{$fornecedor->for_email}}@endif" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="for_observacao">Observação:</label>
                        <textarea class="form-control" name="for_observacao" id="for_observacao"
                         rows="4" placeholder="Escreva...">@if(isset($fornecedor)){{$fornecedor->for_observacao}}@endif</textarea>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>
@stop