@extends('adminlte::page')
@section('title', 'Compra')

@section('content_header')
<meta name="_token" content="{{ csrf_token() }}">
<style type="text/css">
    .tbl {
        border-collapse: collapse;
        width: 100%;
        margin: auto;
    }

    .thl,
    .tdl {
        text-align: left;
        padding: 8px;
    }

    .trl:nth-child(even) {
        background-color: #f2f2f2
    }

    .thl {
        background-color: #4CAF50;
        color: white;
    }
</style>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        @if(isset($itens_compra[0]->ped_codigo))
        <h1>Materiais para pedido "{{$itens_compra[0]->ped_codigo}}"</h1>
        @else
        <h1>Materiais necessários para todos os pedidos</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @include('includes.functions')
        <!-- <form method="POST" action="{{url('compra/confirmar')}}" class="form form-inline"> -->
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-12">
                    <div id="tabela_compra_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tabela_compra" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="tabela_compra_info">
                                    <thead>
                                        <tr role="row">
                                            @if(isset($itens_compra[0]->ped_codigo))
                                            <th tabindex="0" rowspan="1" colspan="1">Data Pedido</th>
                                            @endif
                                            <th tabindex="0" rowspan="1" colspan="1">Fornecedor</th>
                                            <th tabindex="0" rowspan="1" colspan="1">Material</th>
                                            <th tabindex="0" rowspan="1" colspan="1">Unidade</th>
                                            <th tabindex="0" rowspan="1" colspan="1">Quantidade</th>
                                            <th tabindex="0" rowspan="1" colspan="1">Custo</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($itens_compra as $itens)
                                        <tr>
                                            @if(isset($itens->ped_codigo))
                                            <td>{{dateFormat($itens->ped_data)}}</td>
                                            @endif
                                            <td>{{$itens->fornecedor}}</td>
                                            <td>{{$itens->mat_nome}}</td>
                                            <td>{{$itens->mat_unidade}}</td>
                                            <td>{{$itens->quantidade}}</td>
                                            <td>{{$itens->valor}}</td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5"></div>
                            <div class="pagination">
                                {{$itens_compra->links()}}
                            </div>
                        </div>
                        
                        @if(isset($itens_compra[0]->ped_codigo))
                        <a href="{{url('compra/'.$itens_compra[0]->ped_codigo.'/PDF')}}" class="btn btn-primary" target="_blank">Exportar PDF</a>
                        <a href="{{url('compra/'.$itens_compra[0]->ped_codigo.'/confirmar')}}" class="btn btn-success">Comprar</a>
                        @else
                        <a href="{{url('compra/PDF')}}" class="btn btn-primary" target="_blank">Exportar PDF</a>
                        <a href="{{url('producao/materiais/confirmar')}}" class="btn btn-success">Comprar</a>
                        @endif
                    </div>
                </div>
            </div>
        <!-- </form> -->
    </div>
</div>
@stop