@extends('adminlte::page')
@section('title', 'Controle de Produção')

@section('content_header')
<meta name="_token" content="{{ csrf_token() }}">

<style type="text/css">
.table_modal {
    border-collapse: collapse;
    width: 100%;
    margin: auto;
}

.th,
.td {
    text-align: left;
    padding: 8px;
}

.tr:nth-child(even) {
    background-color: #f2f2f2
}

.th {
    background-color: #4CAF50;
    color: white;
}
</style>
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h1>Controle de Produção</h1>
    </div>

    <div class="box-body">
        @include('includes.alerts')
        <!-- <form method="POST"  action="" class="form form-inline"> -->
        {{csrf_field()}}
        <div class="row">

            <!-- INÍCIO MODAL HISTÓRICO-->
            <div id="modalHistorico" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Histórico do Pedido</h4>
                        </div>
                        <div class="modal-body">
                            <table id="table_modal" class="table_modal table table-bordered table-hover">
                                <thead>
                                    <tr class="tr">
                                        <th class="th">Processo</th>
                                        <th class="th">Data Entrada</th>
                                        <th class="th">Data Saída</th>
                                        <th class="th">Dias no Processo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div><!-- FIM MODAL HISTÓRICO-->

            <!-- INÍCIO MODAL PEDIDO-->
            <div id="modalPedido" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center">Detalhes do Pedido</h4>
                        </div>
                        <div class="modal-body">

                            <!-- INÍCIO TABLE PEDIDO -->
                            <table id="table_modal_pedido" class="table_modal table table-bordered table-hover">
                                <thead>
                                    <tr class="tr">
                                        <th class="th">#</th>
                                        <th class="th">Cliente</th>
                                        <th class="th">Total(R$)</th>
                                        <th class="th">Data Pedido</th>
                                        <th class="th">Data Aprovação</th>
                                        <th class="th">Data Entrega</th>
                                        <th class="th">Status Pagamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <!-- FIM TABLE PEDIDO -->
                            <br />
                            <!-- INÍCIO TABLE PRODUTOS -->
                            <table id="table_modal_prod" class="table">
                                <!-- <thead>
                                    <tr class="">
                                        <th class="">Produto</th>
                                        <th class="">Quantidade</th>
                                        <th class="">Cor</th>
                                        <th class="">Valor(R$)</th>
                                    </tr>
                                </thead> -->
                                <tbody>
                                    
                                </tbody>
                            </table>
                            <!-- FIM TABLE PRODUTOS -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div><!-- FIM MODAL PEDIDO-->


            <div class="col-sm-12">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tabela_pedidos" class="table table-bordered table-striped dataTable" role="grid"
                                aria-describedby="tabela_pedidos_info">
                                <thead>
                                    <tr role="row">
                                        <th tabindex="0" rowspan="1" colspan="1">Pedido</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Data Pedido</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Data de Entrega</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Prazo Até a Entrega</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Status</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($historicos as $historico)
                                    <tr>
                                        <td>
                                            <a class="view_pedido" data-toggle="modal" data-target="#modalPedido"
                                                id="{{$historico->ped_codigo}}">
                                                {{$historico->ped_codigo}}
                                            </a>
                                        </td>
                                        <td>{{$historico->getDataFormatada($historico->ped_data)}}</td>
                                        <td>{{$historico->getDataFormatada($historico->ped_data_entrega)}}</td>
                                        <td>{{$historico->prazo}} dias</td>
                                        <td>{{$historico->proc_nome}}</td>
                                        <td>

                                            <a @if($historico->proc_nome != "Compra") disabled @endif
                                                href="{{url('producao/'.$historico->ped_codigo.'/materiais')}}"
                                                class="btn btn-primary">
                                                <!-- Editar -->
                                                <i class="fa fa-cart-plus"></i>
                                            </a>
                                            <a class="btn btn-success view_data" data-toggle="modal"
                                                data-target="#modalHistorico" id="{{$historico->ped_codigo}}">
                                                <i class="fas fa-history"></i>
                                            </a>
                                            <a href="{{url('producao/'.$historico->his_pro_codigo.'')}}"
                                                class="btn btn-success">
                                                <i class="fas fa-fast-forward"></i>
                                            </a>
                                        </td>
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
                            <!-- links paginação aqui -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </form> -->
    </div>
</div>
@stop