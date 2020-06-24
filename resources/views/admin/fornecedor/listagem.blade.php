@extends('adminlte::page')

@section('title', 'Fornecedores')

@section('content_header')
<h1>Fornecedores</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <!-- <a href="{{route('fornecedor.novo')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a> -->

        <div class="">
            <form action="{{route('fornecedor.todos')}}" method="POST" class="form form-inline">
                {!! csrf_field()!!}
                <input type="text" name="id" class="form-control" placeholder="ID">
                <input type="text" name="nome" class="form-control" placeholder="Nome">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
        </div>
    </div>
    <div class="box-body">
        @include('includes.alerts')
        <form method="POST"  action="{{route('fornecedor.pdf',[$request])}}" class="form form-inline">
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
                @forelse($fornecedores as $fornecedor)
                <tr>
                    @if(!isset($request->codigo) 
                    && !isset($request->nome)
                    && !isset($request->nome_social)
                    && !isset($request->rg)
                    && !isset($request->cpf)
                    && !isset($request->telefone)
                    && !isset($request->email)
                    && !isset($request->observacao)) 

                        <td>{{$fornecedor->for_codigo}}</td>
                        <td>{{$fornecedor->for_nome_razao_social}}</td>
                        <td>{{$fornecedor->for_nome_social_fantasia}}</td>
                        <td>{{$fornecedor->for_rg_inscricao_estadual}}</td>
                        <td>{{$fornecedor->for_cpf_cnpj}}</td>
                        <td>{{$fornecedor->for_telefone}}</td>
                        <td>{{$fornecedor->for_email}}</td>
                        <td>{{$fornecedor->for_observacao}}</td>

                    @else
                        @if(isset($request->codigo))<td>{{$fornecedor->for_codigo}}</td>@endif
                        @if(isset($request->nome))<td>{{$fornecedor->for_nome_razao_social}}</td>@endif
                        @if(isset($request->nome_social))<td>{{$fornecedor->for_nome_social_fantasia}}</td>@endif
                        @if(isset($request->rg))<td>{{$fornecedor->for_rg_inscricao_estadual}}</td>@endif
                        @if(isset($request->cpf))<td>{{$fornecedor->for_cpf_cnpj}}</td>@endif
                        @if(isset($request->telefone))<td><td>{{$fornecedor->for_telefone}}</td></td>@endif
                        @if(isset($request->email))<td>{{$fornecedor->for_email}}</td>@endif
                        @if(isset($request->observacao))<td>{{$fornecedor->for_observacao}}</td>@endif
                    @endif
                    
                    <td>
                        <a href="{{route('fornecedor.editar',['id' => $fornecedor->for_codigo])}}" class="btn btn-primary">
                            <!-- Editar -->
                            <i class="fa fa-pen"></i>
                        </a>
                        <a href="{{url('fornecedor/'.$fornecedor->for_codigo.'/deletar')}}" class="btn btn-danger">
                            <!-- Deletar -->
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        <a href="{{route('fornecedor.pdf',[$request])}}" class="btn btn-primary" target="_blank">Exportar PDF</a>
        <a href="{{route('fornecedor.excel',[$request])}}" class="btn btn-primary">Exportar Planilha</a>
        </form>
    </div>
</div>
@stop