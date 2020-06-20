@extends('adminlte::page')

@section('title', 'Fornecedores')

@section('content_header')
<h1>Fornecedores</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <a href="{{route('fornecedor.novo')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>

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
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Razão Social</th>
                    <th>Nome Fantasia</th>
                    <th>Inscrição Estadual</th>
                    <th>CPF/CNPJ</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fornecedores as $fornecedor)
                <tr>
                    <td>{{$fornecedor->for_codigo}}</td>
                    <td>{{$fornecedor->for_nome_razao_social}}</td>
                    <td>{{$fornecedor->for_nome_social_fantasia}}</td>
                    <td>{{$fornecedor->for_rg_inscricao_estadual}}</td>
                    <td>{{$fornecedor->for_cpf_cnpj}}</td>
                    <td>{{$fornecedor->for_telefone}}</td>
                    <td>{{$fornecedor->for_email}}</td>
                    <td>{{$fornecedor->for_observacao}}</td>
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
    </div>
</div>
@stop