@extends('adminlte::page')

@section('title', 'Cargos')

@section('content_header')
<h1>Cargos</h1>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <form action="{{route('historic.search')}}" method="POST" class="form form-inline">
            {!! csrf_field()!!}
            <input type="text" name="id" class="form-control" placeholder="ID">
            <input type="text" name="nome" class="form-control" placeholder="Nome">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>
    </div>
    <div class="box-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Salário Base</th>
                    <th>Observação</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cargos as $cargo)
                <tr>
                    <td>{{$cargo->car_codigo}}</td>
                    <td>{{$cargo->car_nome}}</td>
                    <td>{{number_format($cargo->car_salario_base,2,'.',',')}}</td>
                    <td>{{$cargo->car_observacao}}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        <!-- não perder o filtro na paginação -->
    </div>
</div>
@stop