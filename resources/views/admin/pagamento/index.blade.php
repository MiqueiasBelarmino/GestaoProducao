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
        <!-- <div class="row">
            <div class="col-sm-4">
                <label for="mat_codigo">Cliente:</label>
                <select name="mat_codigo" id="seletor_cliente" class="form-control">
                    <option value="">SELECIONE</option>
                    <option value="">dgfgdgdg</option>
                </select>
            </div>
        </div> -->

        <!-- <div class="row">
            <div class="col-sm-12">
                <table class="table table-bordered table-hover" id="tabela_pagamentos">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

        </div> -->

        <div class="row">
            <div class="col-sm-12">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="tabela_pagamentos" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="tabela_pagamentos_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="tabela_pagamentos" rowspan="1" colspan="1" aria-sort="ascending">Cliente</th>
                                        <th class="sorting" tabindex="0" aria-controls="tabela_pagamentos" rowspan="1" colspan="1">Total Pedido(R$)</th>
                                        <th class="sorting" tabindex="0" aria-controls="tabela_pagamentos" rowspan="1" colspan="1">Parcela Nº</th>
                                        <th class="sorting" tabindex="0" aria-controls="tabela_pagamentos" rowspan="1" colspan="1">Total Pagamento(R$)</th>
                                        <th class="sorting" tabindex="0" aria-controls="tabela_pagamentos" rowspan="1" colspan="1">Vencimento</th>
                                        <th class="sorting" tabindex="0" aria-controls="tabela_pagamentos" rowspan="1" colspan="1">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pagamentos as $pagamento)
                                    <tr>
                                        <td>{{$pagamento->pedido->cliente->cli_nome_razao_social}}</td>
                                        <td>{{$pagamento->pedido->ped_total}}</td>
                                        <td>{{$pagamento->pag_numero_parcela}}</td>
                                        <td>{{$pagamento->pag_valor}}</td>
                                        <td>{{$pagamento->pag_data_vencimento->format("d-m-Y")}}</td>
                                        <td><a href="" class="btn btn-success">
                                                <!-- Deletar -->
                                                <i class="fa fa-cash-register"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Cliente</th>
                                        <th rowspan="1" colspan="1">Total Pedido(R$)</th>
                                        <th rowspan="1" colspan="1">Parcela Nº</th>
                                        <th rowspan="1" colspan="1">Total Pagamento(R$)</th>
                                        <th rowspan="1" colspan="1">Vencimento</th>
                                        <th rowspan="1" colspan="1">Ações</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5"></div>
                        <div class="pagination">
                            {{ $pagamentos->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- </form> -->
    </div>
</div>
@stop