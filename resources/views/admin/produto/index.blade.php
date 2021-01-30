@extends('adminlte::page')

@section('title', 'Materiais')

@section('content_header')
<h1>Materiais</h1>
@stop

@section('content')
<div class="box">
    <!-- <div class="box-header">
        <div class="">
            <form action="{{route('material.todos')}}" method="POST" class="form form-inline">
                {!! csrf_field()!!}
                <input type="text" name="id" class="form-control" placeholder="ID">
                <input type="text" name="nome" class="form-control" placeholder="Nome">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
        </div>
    </div> -->
    <div class="box-body">
        @include('includes.alerts')
        <form method="POST"  action="" class="form form-inline">
        {!! csrf_field()!!}
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Fornecedor</th>
                    <th>Descrição</th>
                    <th>Custo</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($materiais as $material)
                <tr>
                    <td>{{$material->mat_codigo}}</td>
                    <td>{{$material->mat_nome}}</td>
                    <td>{{$material->fornecedor->for_nome_razao_social}}</td>
                    <td>{{$material->mat_descricao}}</td>
                    <td>{{number_format($material->mat_custo,2,'.',',')}}</td>
                    <td>{{$material->mat_observacao}}</td>
                    <td>
                        <a href="{{route('material.editar',['id' => $material->mat_codigo])}}" class="btn btn-primary">
                            <!-- Editar -->
                            <i class="fa fa-pen"></i>
                        </a>
                        <a href="{{url('material/'.$material->mat_codigo.'/deletar')}}" class="btn btn-danger">
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