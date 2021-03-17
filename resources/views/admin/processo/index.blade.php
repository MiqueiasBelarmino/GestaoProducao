@extends('adminlte::page')

@section('title', 'Processos')

@section('content_header')
<h1>Cargos</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <a href="{{route('processo.novo')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>

        <div class="">
            <form action="{{route('processo.todos')}}" method="POST" class="form form-inline">
                {!! csrf_field()!!}
                <input type="text" name="id" class="form-control" placeholder="ID">
                <input type="text" name="nome" class="form-control" placeholder="Nome">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
        </div>
    </div>
    <div class="box-body">
        @include('includes.alerts')
        <form method="POST"  action="" class="form form-inline">
        {!! csrf_field()!!}
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($processos as $processo)
                <tr>
                    <td>{{$processo->proc_codigo}}</td>
                    <td>{{$processo->proc_nome}}</td>
                    <td>{{$processo->proc_observacao}}</td>
                    <td>
                        <a href="{{route('processo.editar',['id' => $processo->proc_codigo])}}" class="btn btn-primary">
                            <!-- Editar -->
                            <i class="fa fa-pen"></i>
                        </a>
                        <a href="{{url('processo/'.$processo->proc_codigo.'/deletar')}}" class="btn btn-danger">
                            <!-- Deletar -->
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        <a href="" class="btn btn-primary" target="_blank">Exportar PDF</a>
        <a href="" class="btn btn-primary">Exportar Planilha</a>
        </form>
    </div>
    
</div>
@stop