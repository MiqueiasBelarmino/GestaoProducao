@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard - Tasks</h1>
@stop

@section('content')

    <li><strike>add botão exclusão</strike></li>
    <li><strike>add botão edição</strike></li>
    <li><strike>separar cadastros de listagens</strike></li>
    <li><strike>formatar datas</strike></li>
    <li><strike>remover rg/cpf/data_admissao das listagens</strike></li>
    <li>add máscara para telefone</li>
    <li><strike>'configurar' listagem antes de gerar</strike></li>
    <li>exportar listagem (<strike>PDF</strike>, CSV, XLS)</li>

    <br><br>
    CARGO: car_codigo, car_nome, car_descricao, car_salario_base, car_observacao
    <br>
    FUNCIONÁRIO: fun_codigo, fun_nome, fun_rg, fun_cpf, fun_email, car_codigo, fun_comissao, fun_telefone, fun_data_admissao, fun_senha, fun_observacao
    <br>
    FORNECEDOR: for_codigo, for_nome_razao_social, for_nome_social_fantasia,for_rg_inscricao_estadual, for_cpf_cnpj, for_telefone, for_email, for_observacao
    <br>
    ENDEREÇO: end_codigo, end_rua, end_numero, end_bairro, end_cidade, end_estado, end_cep, end_observacao
    <br>
    CLIENTE: cli_codigo, cli_nome_razao_social, cli_nome_social_fantasia, cli_rg_incricao_estadual, cli_cpf_cnpj, cli_telefone, cli_email, cli_observacao

@stop