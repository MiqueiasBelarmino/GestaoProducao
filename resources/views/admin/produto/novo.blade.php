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
        @include('includes.functions')
        @if(count($materiais)>0)
        @if(isset($produto))
        <!-- <form method="POST" action="{{ route('produto.editar.salvar',['id' =>$produto->mat_codigo]) }}"> -->
        @else
        @endif
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-7">
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
            <div class="col-sm-3">
                <label for="seletor_grupo">Grupo:</label>
                <select name="seletor_grupo" id="seletor_grupo" class="form-control">
                    <option value="1">Camisetas</option>
                    <option value="2">Calças</option>
                </select>
            </div>
        </div>

        <hr />

        <div class="row" id="detalhes_camiseta">
            <div class="col-sm-2">
                <label for="manga_tipo">Tipo Manga:</label>
                <select name="manga_tipo" id="seletor_tipo_manga" class="form-control">
                    <option value="0">Padrão</option>
                    <option value="1">Raglã</option>
                    <option value="2">Regata</option>
                    <option value="3">Machão</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="manga_tamanho">Tamanho Manga:</label>
                <select name="manga_tamanho" id="seletor_tamanho_manga" class="form-control">
                    <option value="0">Curta</option>
                    <option value="1">Longa</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="manga_cor">Cor Manga:</label>
                <input type="text" name="manga_cor" id="manga_cor" class="form-control" value="" placeholder="Escreva..." required>
            </div>
            <div class="col-sm-1">
                <label for="manga_galao">Galão:</label>
                <input type="number" step="1" min="0" max="2" name="manga_galao" id="manga_galao" class="form-control">
                
            </div>
            <div class="col-sm-2">
                <label for="gola_tipo">Gola:</label>
                <select name="gola_tipo" id="seletor_gola" class="form-control">
                    <option value="0">Viés</option>
                    <option value="1">Ribana</option>
                    <option value="2">Polo</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="gola_decote">Decote:</label>
                <select name="gola_decote" id="seletor_decote" class="form-control">
                    <option value="0">Redondo</option>
                    <option value="1">Vê</option>
                </select>
            </div>

            <div class="col-sm-1">
                <label for="bolso_frente_cam">Bolso:</label>
                <input type="number" step="1" min="0" max="2" name="bolso_frente_cam" id="bolso_frente_cam" class="form-control">
            </div>

        </div>

        <div class="row" id="detalhes_calca">
            <div class="col-sm-2">
                <div class="checkbox">
                    <label>
                        <input id="passadores" name="passadores" type="checkbox">
                        Passadores
                    </label>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="checkbox">
                    <label>
                        <input id="elastico" name="elastico" type="checkbox">
                        Elástico
                    </label>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="checkbox">
                    <label>
                        <input id="bolso_frente" name="bolso_frente" type="checkbox">
                        Bolso Frente
                    </label>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="checkbox">
                    <label>
                        <input id="bolso_costas" name="bolso_costas" type="checkbox">
                        Bolso Costas
                    </label>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="checkbox">
                    <label>
                        <input id="refletiva" name="refletiva" type="checkbox">
                        Refletiva
                    </label>
                </div>
            </div>


        </div>


        <hr />

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
        <hr />
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="observacao">Observação:</label>
                    <textarea class="form-control" name="observacao" id="observacao" rows="4" placeholder="Escreva...">@if(isset($produto)){{trim($produto->mat_observacao)}}@endif</textarea>
                </div>
            </div>
        </div>
        <button type="submit" id="confirma_produto" class="btn btn-primary">Confirmar</button>
        @else
        <h1>Nenhum material encontrado!</h1>
        <h2>Para cadastrar produtos devem existir materiais!</h2>
        @endif
        <!-- </form> -->

    </div>
</div>
@stop