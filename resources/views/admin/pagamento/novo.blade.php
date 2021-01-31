@extends('adminlte::page')
@section('title', 'Pagamento')

@section('content_header')
<meta name="_token" content="{{ csrf_token() }}">
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h1>Pagamento</h1>
    </div>

    <div class="box-body">
        @include('includes.alerts')
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-4">
                <label for="mat_codigo">Cliente:</label>
                <select name="mat_codigo" id="seletor_cliente" class="form-control">
                    <option value="">SELECIONE</option>
                    <option value="">dgfgdgdg</option>
                </select>
            </div>
        </div>

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
        <button type="submit" id="confirma_pedido" class="btn btn-primary">Confirmar</button>
        <!-- </form> -->
    </div>
</div>
@stop