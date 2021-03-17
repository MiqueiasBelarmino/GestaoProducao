@extends('adminlte::page')
@if(isset($material))
@section('title', 'Material')
@else
@section('title', 'Novo Material')
@endif

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        @if(isset($material))
        <h1>Material</h1>
        @else
        <h1>Novo Material</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @if(count($fornecedores)>0)
        @if(isset($material))
        <form method="POST" action="{{ route('material.editar.salvar',['id' =>$material->mat_codigo]) }}">
            @else
            <form method="POST" action="{{ route('material.store') }}">
                @endif
                {{csrf_field()}}

                <div class="row">
                    <div class="col-sm-6">
                        <label for="for_codigo">Fornecedor:</label>
                        <select name="for_codigo" class="form-control">
                            @foreach($fornecedores as $key => $fornecedor)
                            <option value="{{$key}}" @if(isset($material)) {{$material->for_codigo == $key ? 'selected' :''}} @endif>{{$fornecedor}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="@if(isset($material)) {{$material->mat_nome}} @endif" placeholder="Escreva..." required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="custo">Custo(R$):</label>

                            <input type="text" value="@if(isset($material)) {{$material->mat_custo}} @endif" name="custo" id="custo" class="form-control" placeholder="Escreva...">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="unidade">Unidade:</label>

                            <input type="text" value="@if(isset($material)) {{$material->mat_unidade}} @endif" name="unidade" id="unidade" class="form-control" placeholder="Escreva...">
                        </div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="observacao">Observação:</label>
                            <textarea class="form-control" name="observacao" id="observacao" rows="4" placeholder="Escreva...">@if(isset($material)){{trim($material->mat_observacao)}}@endif</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Confirmar</button>
                @else
                <h1>Nenhum fornecedor encontrado!</h1>
                <h2> Os materias devem possuir fornecedores cadastrados!</h2>
                @endif
            </form>
    </div>
</div>
@stop