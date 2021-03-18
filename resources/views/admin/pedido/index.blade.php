@extends('adminlte::page')

@section('title', 'Pedidos')

@section('content_header')
<h1>Pedidos</h1>
@stop

@section('content')
<div class="box">
    <div class="box-body">
        @include('includes.alerts')
        <form method="POST" action="" class="form form-inline">
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
                                    <td>{{$pedido->getDataFormatada($pedido->ped_data)}}</td>
                                    <td>{{$pedido->getDataFormatada($pedido->ped_data_aprovacao)}}</td>
                                    <td>{{$pedido->getDataFormatada($pedido->ped_data_entrega)}}</td>
                                    <td>
                                        <a href="{{url('pedido/'.$pedido->ped_codigo.'/historico')}}" class="btn btn-primary">
                                            <!-- Editar -->
                                            <i class="fa fa-bars"></i>
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