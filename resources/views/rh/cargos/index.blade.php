@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
<h1>Cargos</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <a href="{{route('cargo.novo')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>

        <div class="">
            <form action="{{route('cargo.todos')}}" method="POST" class="form form-inline">
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
                    <th>Descrição</th>
                    <th>Salário Base</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cargos as $cargo)
                <tr>
                    <td>{{$cargo->car_codigo}}</td>
                    <td>{{$cargo->car_nome}}</td>
                    <td>{{$cargo->car_descricao}}</td>
                    <td>{{number_format($cargo->car_salario_base,2,'.',',')}}</td>
                    <td>{{$cargo->car_observacao}}</td>
                    <td>
                        <a href="{{route('cargo.editar',['id' => $cargo->car_codigo])}}" class="btn btn-primary">
                            <!-- Editar -->
                            <i class="fa fa-pen"></i>
                        </a>
                        <a href="{{url('cargo/'.$cargo->car_codigo.'/deletar')}}" class="btn btn-danger">
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