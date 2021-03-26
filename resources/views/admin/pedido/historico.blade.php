@extends('adminlte::page')
@section('title', 'Histórico')

@section('content_header')
<meta name="_token" content="{{ csrf_token() }}">
@stop

@section('content')
<div class="box">
    <div class="box-header">
        <h1>Histórico de Produção</h1>
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @include('includes.functions')
        <!-- <form method="POST"  action="" class="form form-inline"> -->
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-12">
                <div id="tabela_historico_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tabela_historico" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="tabela_historico_info">
                                <thead>
                                    <tr role="row">
                                        <th tabindex="0" rowspan="1" colspan="1">Pedido</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Cliente</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Data Pedido</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Processo</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Entrada</th>
                                        <th tabindex="0" rowspan="1" colspan="1">Saída</th>
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
                                        <td>{{$historico->his_pro_data_saida}}</td>
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
        <a href="{{url('pedido')}}" class="btn btn-success">Voltar</a>
    </div>
</div>
@stop