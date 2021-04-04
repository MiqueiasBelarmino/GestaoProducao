@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
<h1>Pedidos</h1>
@stop

@section('content')
<div class="box">
    <div class="box-body">
        @include('includes.alerts')
        @include('includes.functions')
        <form method="POST" action="" class="form form-inline">
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
                            <div class="" id="produtos_detalhes"></div>
                            <!-- <table id="table_modal_prod" class="table"> -->
                                <!-- <thead>
                                    <tr class="">
                                        <th class="">Produto</th>
                                        <th class="">Quantidade</th>
                                        <th class="">Cor</th>
                                        <th class="">Valor(R$)</th>
                                    </tr>
                                </thead> -->
                                <!-- <tbody>

                                </tbody>
                            </table> -->
                            <!-- FIM TABLE PRODUTOS -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div><!-- FIM MODAL PEDIDO-->
            {!! csrf_field()!!}
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tabela_pedidos" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="tabela_pedidos_info">
                            <thead>
                                <tr role="row">
                                    <th tabindex="0" rowspan="1" colspan="1">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Cliente</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Total(R$)</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Data</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Aprovação</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Entrega</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pedidos as $pedido)
                                <tr>
                                    <td>{{$pedido->ped_codigo}}</td>
                                    <td>{{$pedido->cliente->cli_nome_razao_social}}</td>
                                    <td>{{number_format($pedido->ped_total,2,'.',',')}}</td>
                                    <td>{{dateFormat($pedido->ped_data)}}</td>
                                    <td>{{dateFormat($pedido->ped_data_aprovacao)}}</td>
                                    <td>{{dateFormat($pedido->ped_data_entrega)}}</td>
                                    <td>
                                        <!-- <a href="{{url('pedido/'.$pedido->ped_codigo.'/historico')}}" class="btn btn-primary">
                                            <i class="fa fa-bars"></i>
                                        </a> -->
                                            <a class="btn btn-success view_pedido" data-toggle="modal"
                                                data-target="#modalPedido" id=" {{$pedido->ped_codigo}}">
                                                <i class="fas fa-bars"></i>
                                            </a>
                                        <a href="{{url('pedido/'.$pedido->ped_codigo.'/deletar')}}" class="btn btn-danger">
                                            <!-- Deletar -->
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-5"></div>
                            <div class="pagination">
                                {{ $pedidos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <a href="" class="btn btn-primary" target="_blank">Exportar PDF</a>
            <a href="" class="btn btn-primary">Exportar Planilha</a> -->
        </form>
    </div>

</div>
@stop