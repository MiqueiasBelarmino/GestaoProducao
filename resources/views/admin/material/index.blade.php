@extends('adminlte::page')

@section('title', 'Materiais')

@section('content_header')
<h1>Materiais</h1>
@stop

@section('content')
<div class="box">
    <!-- <div class="box-header">
        <div class="">
            <form action="{{route('material.todos')}}" method="POST" class="form form-inline">
                {!! csrf_field()!!}
                <input type="text" name="id" class="form-control" placeholder="ID">
                <input type="text" name="nome" class="form-control" placeholder="Nome">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
        </div>
    </div> -->
    <div class="box-body">
        @include('includes.alerts')
        <form method="POST" action="" class="form form-inline">
            {!! csrf_field()!!}
            <div id="tabela_materiais_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table id="tabela_materiais" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="tabela_processos_info">
                            <thead>
                                <tr role="row">
                                    <th tabindex="0" rowspan="1" colspan="1">#</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Nome</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Fornecedor</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Unidade</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Custo</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Observação</th>
                                    <th tabindex="0" rowspan="1" colspan="1">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($materiais as $material)
                                <tr>
                                    <td>{{$material->mat_codigo}}</td>
                                    <td>{{$material->mat_nome}}</td>
                                    <td>{{$material->fornecedor->for_nome_razao_social}}</td>
                                    <td>{{$material->mat_unidade}}</td>
                                    <td>{{number_format($material->mat_custo,2,'.',',')}}</td>
                                    <td>{{$material->mat_observacao}}</td>
                                    <td>
                                        <a href="{{route('material.editar',['id' => $material->mat_codigo])}}" class="btn btn-primary">
                                            <!-- Editar -->
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a href="{{url('material/'.$material->mat_codigo.'/deletar')}}" class="btn btn-danger">
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
                </div>
                <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="pagination">
                        {{ $materiais->links() }}
                    </div>
                </div>
            </div>


            <a href="{{url('material/PDF')}}" class="btn btn-primary" target="_blank">Exportar PDF</a>
        </form>
    </div>

</div>
@stop