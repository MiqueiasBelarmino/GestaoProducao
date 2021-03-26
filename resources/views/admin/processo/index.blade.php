@extends('adminlte::page')

@section('title', 'Processos')

@section('content_header')
<h1>Processos</h1>
@stop

@section('content')
<div class="box">
    <div class="box-body">
        @include('includes.alerts')
        @include('includes.functions')
        <form method="POST" action="" class="form form-inline">
            {!! csrf_field()!!}
            <div class="row">
                <div class="col-sm-12">
                    <div id="tabela_processos_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="tabela_processos" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="tabela_processos_info">
                                    <thead>
                                        <tr role="row">
                                            <th tabindex="0" rowspan="1" colspan="1">#</th>
                                            <th tabindex="0" rowspan="1" colspan="1">Nome</th>
                                            <th tabindex="0" rowspan="1" colspan="1">Observação</th>
                                            <th tabindex="0" rowspan="1" colspan="1">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($processos as $processo)
                                        <tr>
                                            <td>{{$processo->proc_codigo}}</td>
                                            <td>{{$processo->proc_nome}}</td>
                                            <td>{{$processo->proc_observacao}}</td>
                                            <td>
                                                <a href="{{route('processo.editar',['id' => $processo->proc_codigo])}}" class="btn btn-primary">
                                                    <!-- Editar -->
                                                    <i class="fa fa-pen"></i>
                                                </a>
                                                <a href="{{url('processo/'.$processo->proc_codigo.'/deletar')}}" class="btn btn-danger">
                                                    <!-- Deletar -->
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div><!-- row table -->
                        <div class="row">
                            <div class="col-sm-5"></div>
                            <div class="pagination">
                                {{ $processos->links() }}
                            </div>
                        </div><!-- row pagination -->
                        <a href="{{route('processo.pdf')}}" class="btn btn-primary" target="_blank">Exportar PDF</a>
                        <a href="{{route('processo.excel')}}" class="btn btn-primary">Exportar Planilha</a>
                    </div><!-- row wrapper -->
                </div><!-- row col-md -->
            </div><!-- row main -->

        </form>
    </div>

</div>
@stop