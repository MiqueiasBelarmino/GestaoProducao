@extends('adminlte::page')
@if(isset($pedido))
@section('title', 'Pedido')
@else
@section('title', 'Novo Pedido')
@endif

@section('content_header')
<meta name="_token" content="{{ csrf_token() }}">
@stop

@section('content')
<div class="box">
    <div class="box-header">
        @if(isset($pedido))
        <h1>Pedido</h1>
        @else
        <h1>Novo Pedido</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @if(count($produtos)>0)
        @if(isset($pedido))
        <!-- <form method="POST" action="{{ route('pedido.editar.salvar',['id' =>$pedido->mat_codigo]) }}"> -->
        @else
        @endif
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-4">
                <label for="mat_codigo">Cliente:</label>
                <select name="mat_codigo" id="seletor_cliente" class="form-control">
                    <option value="">SELECIONE</option>
                    @foreach($clientes as $key => $cliente)
                    <option value="{{$key}}">{{$cliente}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="nome">Funcionário:</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="@if(isset($pedido)) {{$pedido->mat_nome}}@else {{Auth::user()->fun_nome}} @endif" placeholder="Escreva..." readonly>
                    <input type="hidden" name="funcionario" id="funcionario"  value="{{Auth::user()->fun_codigo}}">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="valor">Valor(R$):</label>
                    <input type="text" name="valor" id="valor" class="form-control" value="@if(isset($pedido)) {{$pedido->prod_valor}} @endif" readonly>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="ped_data">Data:</label>
                    <input type="date" name="ped_data" id="ped_data" class="form-control" @if(isset($pedido)) value="{{$pedido->ped_data}}" @endif readonly>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="ped_data_entrega">Data Entrega:</label>
                    <input type="date" name="ped_data_entrega" id="ped_data_entrega" class="form-control" @if(isset($pedido)) value="{{$pedido->ped_data_entrega}}" @endif required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label for="prod_codigo">Produto:</label>
                <select name="prod_codigo" id="seletor_produto" class="form-control">
                    <option value="">SELECIONE</option>
                    @foreach($produtos as $key => $produto)
                    <option value="{{$key}}">{{$produto}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="custo_produto">Valor(R$):</label>
                    <input type="text" name="custo_produto" id="custo_produto" class="form-control" readonly>
                </div>
            </div>
            <div class="col-sm-2">
                <label for="ite_ped_cor">Cor:</label>
                <select name="ite_ped_cor" id="seletor_cor" class="form-control">
                    <option value="Branco">Branco</option>
                    <option value="Azul Royal">Azul Royal</option>
                    <option value="Azul Marinho">Azul Marinho</option>
                    <option value="Vermelho">Vermelho</option>
                </select>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="text" name="quantidade" id="quantidade" class="form-control" placeholder="Escreva..." required>
                </div>
            </div>
            <div class="col-sm-2">
                <br />
                <button id="add_produto" class="btn btn-primary"><i class="fa fa-plus"></i></button>
            </div>

        </div>

        <hr />
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-hover" id="tabela_produtos">
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
        <hr />

        <div class="row">
            <div class="col-sm-2">
                <label for="ite_ped_cor">Forma pagamento:</label>
                <select name="ite_ped_cor" id="seletor_forma_pagamento" class="form-control">
                    <option value="1">À Vista</option>
                    <option value="2">30 dias</option>
                    <option value="3">Parcelamento</option>
                </select>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="pag_parcela">Nº Parcelas:</label>
                    <input type="text" name="pag_parcela" id="pag_parcela" class="form-control" placeholder="Escreva..." disabled="true">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="ped_data_vencimento">Data Vencimento:</label>
                    <input type="date" name="ped_data_vencimento" id="ped_data_vencimento" class="form-control" @if(isset($pedido)) value="{{$pedido->ped_data_vencimento}}" @endif required>
                </div>
            </div>
            <div class="col-sm-2">
                <br />
                <button id="add_produto" class="btn btn-primary"><i class="fa fa-plus"></i></button>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="observacao">Observação:</label>
                    <textarea class="form-control" name="observacao" id="observacao" rows="4" placeholder="Escreva...">@if(isset($pedido)){{trim($pedido->mat_observacao)}}@endif</textarea>
                </div>
            </div>
        </div>
        <button type="submit" id="confirma_pedido" class="btn btn-primary">Confirmar</button>
        @else
        <h1>Nenhum produto encontrado!</h1>
        <h2>Para efetuar pedidos devem existir produtos!</h2>
        @endif
        <!-- </form> -->

    </div>
</div>
@stop