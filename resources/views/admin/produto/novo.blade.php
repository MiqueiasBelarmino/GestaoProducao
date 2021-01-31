@extends('adminlte::page')
@if(isset($produto))
@section('title', 'Produto')
@else
@section('title', 'Novo Produto')
@endif

@section('content_header')
<meta name="_token" content="{{ csrf_token() }}">
@stop

@section('content')
<div class="box">
    <div class="box-header">
        @if(isset($produto))
        <h1>Produto</h1>
        @else
        <h1>Novo Produto</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @if(count($materiais)>0)
        @if(isset($produto))
        <!-- <form method="POST" action="{{ route('produto.editar.salvar',['id' =>$produto->mat_codigo]) }}"> -->
        @else
        @endif
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="@if(isset($produto)) {{$produto->mat_nome}} @endif" placeholder="Escreva..." required>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="valor">Valor(R$):</label>
                    <input type="text" name="valor" id="valor" class="form-control" value="@if(isset($produto)) {{$produto->prod_valor}} @endif" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label for="mat_codigo">Material:</label>
                <select name="mat_codigo" id="seletor_material" class="form-control">
                    <option value="">SELECIONE</option>
                    @foreach($materiais as $key => $material)
                    <option value="{{$key}}">{{$material}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="unidade">Unidade:</label>
                    <input type="text" name="unidade" id="unidade" class="form-control" disabled>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="custo_material">Valor(R$):</label>
                    <input type="text" name="custo_material" id="custo_material" class="form-control" readonly>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="text" name="quantidade" id="quantidade" class="form-control" placeholder="Escreva..." required>
                </div>
            </div>
            <div class="col-sm-2">
                <br />
                <button id="add_material" class="btn btn-primary"><i class="fa fa-plus"></i></button>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-hover" id="tabela_materiais">
                    <thead>
                        <tr>
                            <!-- <th >Código</th> -->
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="observacao">Observação:</label>
                    <textarea class="form-control" name="observacao" id="observacao" rows="4" placeholder="Escreva...">@if(isset($produto)){{trim($produto->mat_observacao)}}@endif</textarea>
                </div>
            </div>
        </div>
        <button type="submit" id="MAIN" class="btn btn-primary">Confirmar</button>
        @else
        <h1>Nenhum material encontrado!</h1>
        <h2>Para cadastrar produtos devem existir materiais!</h2>
        @endif
        <!-- </form> -->

    </div>
</div>
@stop