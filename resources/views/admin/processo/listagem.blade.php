@extends('adminlte::page')

@section('title', 'Funcionários')

@section('content_header')
<h1>Funcionários</h1>
@stop

@section('content')
<div class="box">
    <!-- <div class="box-header">
         <a href="{{route('funcionario.novo')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Novo</a>

        <div class="">
            <form action="{{route('funcionario.todos')}}" method="POST" class="form form-inline">
                {!! csrf_field()!!}
                <input type="text" name="id" class="form-control" placeholder="ID"> 
                <input type="text" name="nome" class="form-control" placeholder="Nome">
                <button type="submit" class="btn btn-primary">Pesquisar</button>
            </form>
        </div>
    </div> -->
    <div class="box-body">
        @include('includes.alerts')
        <form method="POST"  action="{{route('funcionario.pdf',[$request])}}" class="form form-inline">
        {!! csrf_field()!!}
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        @if(!isset($request->codigo) 
                        && !isset($request->nome)
                        && !isset($request->rg)
                        && !isset($request->cpf)
                        && !isset($request->email)
                        && !isset($request->cargo)
                        && !isset($request->comissao)
                        && !isset($request->telefone)
                        && !isset($request->data_admissao)
                        && !isset($request->observacao)) 

                            <th>#</th>
                            <th>Nome</th>
                            <th>RG</th>
                            <th>CPF</th>
                            <th>E-mail</th>
                            <th>Cargo</th>
                            <th>Comissão(%)</th>
                            <th>Telefone</th>
                            <th>Data Admissão</th>
                            <th>Observação</th>
                        @else

                            @if(isset($request->codigo))<th>Código</th>@endif
                            @if(isset($request->nome))<th>Nome</th>@endif
                            @if(isset($request->rg))<th>RG</th>@endif
                            @if(isset($request->cpf))<th>CPF</th>@endif
                            @if(isset($request->email))<th>E-mail</th>@endif
                            @if(isset($request->cargo))<th>Cargo</th>@endif
                            @if(isset($request->comissao))<th>Comissão(%)</th>@endif
                            @if(isset($request->telefone))<th>Telefone</th>@endif
                            @if(isset($request->data_admissao))<th>Data Admissão</th>@endif
                            @if(isset($request->observacao))<th>Observação</th>@endif
                        @endif
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($funcionarios as $funcionario)
                    <tr>
                        @if(!isset($request->codigo) 
                        && !isset($request->nome)
                        && !isset($request->rg)
                        && !isset($request->cpf)
                        && !isset($request->email)
                        && !isset($request->cargo)
                        && !isset($request->comissao)
                        && !isset($request->telefone)
                        && !isset($request->data_admissao)
                        && !isset($request->observacao))

                            <td>{{$funcionario->fun_codigo}}</td>
                            <td>{{$funcionario->fun_nome}}</td>
                            <td>{{$funcionario->fun_rg}}</td>
                            <td>{{$funcionario->getFunCpf($funcionario->fun_cpf)}}</td>
                            <td>{{$funcionario->fun_email}}</td>
                            <td>{{$funcionario->cargo->car_nome}}</td>
                            <td>{{$funcionario->fun_comissao}}</td>
                            <td>{{$funcionario->fun_telefone}}</td>
                            <td>{{$funcionario->formatarData($funcionario->fun_data_admissao)}}</td>
                            <td>{{$funcionario->fun_observacao}}</td>

                        @else
                            @if(isset($request->codigo))<td>{{$funcionario->fun_codigo}}</td>@endif
                            @if(isset($request->nome))<td>{{$funcionario->fun_nome}}</td>@endif
                            @if(isset($request->rg))<td>{{$funcionario->fun_rg}}</td>@endif
                            @if(isset($request->cpf))<td>{{$funcionario->getFunCpf($funcionario->fun_cpf)}}</td>@endif
                            @if(isset($request->email))<td>{{$funcionario->fun_email}}</td>@endif
                            @if(isset($request->cargo))<td>{{$funcionario->cargo->car_nome}}</td>@endif
                            @if(isset($request->comissao))<td>{{$funcionario->fun_comissao}}</td>@endif
                            @if(isset($request->telefone))<td>{{$funcionario->fun_telefone}}</td>@endif
                            @if(isset($request->data_admissao))<td>{{$funcionario->formatarData($funcionario->fun_data_admissao)}}</td>@endif
                            @if(isset($request->observacao))<td>{{$funcionario->fun_observacao}}</td>@endif
                        @endif
                        <td>
                            <a href="{{route('funcionario.editar',['id' => $funcionario->fun_codigo])}}" class="btn btn-primary">
                                <!-- Editar -->
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="{{route('funcionario.endereco',['id' => $funcionario->fun_codigo])}}" class="btn btn-primary">
                                <!-- Editar -->
                                <i class="fa fa-home"></i>
                            </a>
                            <a href="{{url('funcionario/'.$funcionario->fun_codigo.'/deletar')}}" class="btn btn-danger">
                                <!-- Deletar -->
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <!-- <button type="submit" class="btn btn-primary">Exportar</button> -->
            <a href="{{route('funcionario.pdf',[$request])}}" class="btn btn-primary" target="_blank">Exportar PDF</a>
            <a href="{{route('funcionario.excel',[$request])}}" class="btn btn-primary">Exportar Planilha</a>
        </form>
        
    </div>
</div>
@stop