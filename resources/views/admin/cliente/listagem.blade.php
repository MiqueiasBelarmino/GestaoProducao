@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
<h1>Clientes</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <!-- <a href="{{route('cliente.novo')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a> -->

        <div class="">
            <form action="{{route('cliente.todos')}}" method="POST" class="form form-inline">
                {!! csrf_field()!!}
                <input type="text" name="id" class="form-control" placeholder="ID">
                <input type="text" name="nome" class="form-control" placeholder="Nome">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
        </div>
    </div>
    <div class="box-body">
        @include('includes.alerts')
        <form method="POST"  action="{{route('cliente.pdf',[$request])}}" class="form form-inline">
        {!! csrf_field()!!}
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    @if(!isset($request->codigo) 
                    && !isset($request->nome)
                    && !isset($request->nome_social)
                    && !isset($request->rg)
                    && !isset($request->cpf)
                    && !isset($request->telefone)
                    && !isset($request->email)
                    && !isset($request->observacao)) 

                        <th>Código</th>
                        <th>Razão Social</th>
                        <th>Nome Social/Fantasia</th>
                        <th>RG/Inscricão Estadual</th>
                        <th>CPF/CNPJ</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Observação</th>
                    @else

                        @if(isset($request->codigo))<th>Código</th>@endif
                        @if(isset($request->nome))<th>Nome</th>@endif
                        @if(isset($request->nome_social))<th>Nome Social/Fantasia</th>@endif
                        @if(isset($request->rg))<th>RG</th>@endif
                        @if(isset($request->cpf))<th>CPF</th>@endif
                        @if(isset($request->telefone))<th>Telefone</th>@endif
                        @if(isset($request->email))<th>E-mail</th>@endif
                        @if(isset($request->observacao))<th>Observação</th>@endif
                    @endif
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                <tr>
                    @if(!isset($request->codigo) 
                    && !isset($request->nome)
                    && !isset($request->nome_social)
                    && !isset($request->rg)
                    && !isset($request->cpf)
                    && !isset($request->telefone)
                    && !isset($request->email)
                    && !isset($request->observacao)) 

                        <td>{{$cliente->cli_codigo}}</td>
                        <td>{{$cliente->cli_nome_razao_social}}</td>
                        <td>{{$cliente->cli_nome_social_fantasia}}</td>
                        <td>{{$cliente->cli_rg_inscricao_estadual}}</td>
                        <td>{{$cliente->cli_cpf_cnpj}}</td>
                        <td>{{$cliente->cli_telefone}}</td>
                        <td>{{$cliente->cli_email}}</td>
                        <td>{{$cliente->cli_observacao}}</td>

                    @else
                        @if(isset($request->codigo))<td>{{$cliente->cli_codigo}}</td>@endif
                        @if(isset($request->nome))<td>{{$cliente->cli_nome_razao_social}}</td>@endif
                        @if(isset($request->nome_social))<td>{{$cliente->cli_nome_social_fantasia}}</td>@endif
                        @if(isset($request->rg))<td>{{$cliente->cli_rg_inscricao_estadual}}</td>@endif
                        @if(isset($request->cpf))<td>{{$cliente->cli_cpf_cnpj}}</td>@endif
                        @if(isset($request->telefone))<td><td>{{$cliente->cli_telefone}}</td></td>@endif
                        @if(isset($request->email))<td>{{$cliente->cli_email}}</td>@endif
                        @if(isset($request->observacao))<td>{{$cliente->cli_observacao}}</td>@endif
                    @endif
                    
                    <td>
                        <a href="{{route('cliente.editar',['id' => $cliente->cli_codigo])}}" class="btn btn-primary">
                            <!-- Editar -->
                            <i class="fa fa-pen"></i>
                        </a>
                        <a href="{{url('cliente/'.$cliente->cli_codigo.'/deletar')}}" class="btn btn-danger">
                            <!-- Deletar -->
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        <a href="{{route('cliente.pdf',[$request])}}" class="btn btn-primary" target="_blank">Exportar PDF</a>
        <a href="{{route('cliente.excel',[$request])}}" class="btn btn-primary">Exportar Planilha</a>
        </form>
    </div>
</div>
@stop