@extends('adminlte::page')
@section('title', 'Produção')

@section('content_header')
<meta name="_token" content="{{ csrf_token() }}">
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h1>Produção</h1>
    </div>

    <div class="box-body">
        @include('includes.alerts')
        <!-- <form method="POST"  action="" class="form form-inline"> -->
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-12">
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
                                        <th tabindex="0" rowspan="1" colspan="1">Pedido</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Cliente</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Data Pedido</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Processo</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Entrada</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Saída</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($historicos as $historico)
                                    <tr>
                                        <td>{{$historico->ped_codigo}}</td>
                                        <td>{{$historico->cli_nome_razao_social}}</td>
                                        <td>{{$historico->ped_data}}</td>
                                        <td>{{$historico->proc_nome}}</td>
                                        <td>{{$historico->his_pro_data_entrada}}</td>
                                        <td>{{$historico->getHisProDataSaida($historico->his_pro_data_saida)}}</td>
                                        <td><a href="" class="btn btn-success">
                                                <i class="fas fa-fast-forward"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Cliente</th>
                                        <th rowspan="1" colspan="1">Total Pedido(R$)</th>
                                        <th rowspan="1" colspan="1">Produção</th>
                                        <th rowspan="1" colspan="1">Ações</th>
                                    </tr>
                                </tfoot> -->
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