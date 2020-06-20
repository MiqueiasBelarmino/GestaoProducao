@extends('adminlte::page')

@section('title', 'Funcionários')

@section('content_header')
<h1>Funcionários</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <a href="{{route('funcionario.novo')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>

        <div class="">
            <form action="{{route('funcionario.todos')}}" method="POST" class="form form-inline">
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
                    <th>Nome</th>
                    <th>RG</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>Cargo</th>
                    <th>Comissão(%)</th>
                    <th>Telefone</th>
                    <th>Data Admissão</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($funcionarios as $funcionario)
                <tr>
                    <td>{{$funcionario->fun_codigo}}</td>
                    <td>{{$funcionario->fun_nome}}</td>
                    <td>{{$funcionario->fun_rg}}</td>
                    <td>{{$funcionario->fun_cpf}}</td>
                    <td>{{$funcionario->fun_email}}</td>
                    <td>{{$funcionario->cargo->car_nome}}</td>
                    <td>{{$funcionario->fun_comissao}}</td>
                    <td>{{$funcionario->fun_telefone}}</td>
                    <td>{{$funcionario->fun_data_admissao}}</td>
                    <td>{{$funcionario->fun_observacao}}</td>
                    <td>
                        <a href="{{route('funcionario.editar',['id' => $funcionario->fun_codigo])}}" class="btn btn-primary">
                            <!-- Editar -->
                            <i class="fa fa-pen"></i>
                        </a>
                        <a href="{{url('funcionario/'.$funcionario->fun_codigo.'/deletar')}}" class="btn btn-danger">
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