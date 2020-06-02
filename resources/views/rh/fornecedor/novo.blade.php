@extends('adminlte::page')

@section('title', 'Novo Fornecedor')

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h1>Novo Fornecedor</h1>
    </div>

    <div class="box-body">
        @include('includes.alerts')
        <form method="POST" action="{{ route('fornecedor.store') }}">
            {{csrf_field()}}
            <div class="row">

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_nome_razao_social">Nome/Razão Social:</label>
                        <input type="text" name="for_nome_razao_social" id="for_nome_razao_social" class="form-control" placeholder="Escreva..." required>
                    </div>
                </div>

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_nome_social_fantasia">Nome Social/Nome Fantasia:</label>
                        <input type="text" name="for_nome_social_fantasia" id="for_nome_social_fantasia" class="form-control" placeholder="Escreva..." required>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_rg_inscricao_estadual">RG/Inscrição Estadual:</label>
                        <input type="text" name="for_rg_inscricao_estadual" id="for_rg_inscricao_estadual" class="form-control" placeholder="Escreva...">
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_cpf_cnpj">CPF/CNPJ:</label>
                        <input type="text" name="for_cpf_cnpj" id="for_cpf_cnpj" class="form-control" placeholder="Escreva..." required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_telefone">Telefone:</label>
                        <input type="text" name="for_telefone" id="for_telefone" class="form-control" placeholder="(XX) XXXXXXXX" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="for_email">E-mail:</label>
                        <input type="email" name="for_email" id="for_email" class="form-control" placeholder="Escreva..." required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="for_observacao">Observação:</label>
                        <textarea class="form-control" name="for_observacao" id="for_observacao" rows="4" placeholder="Escreva..."></textarea>
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>
@stop