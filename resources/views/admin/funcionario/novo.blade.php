@extends('adminlte::page')

@if(isset($funcionario))
    @section('title', 'Editar Funcionário')
@else
    @section('title', 'Novo Funcionário')
@endif

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        @if(isset($funcionario))
            <h1>Editar Funcionário</h1>
        @else
            <h1>Novo Funcionário</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @if(isset($funcionario))
            <form method="POST" action="{{ route('funcionario.editar.salvar',['id' =>$funcionario->fun_codigo]) }}">
        @else
            <form method="POST" action="{{ route('funcionario.store') }}">
        @endif
            {{csrf_field()}}
            <div class="row">

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_nome">Nome:</label>
                        <input type="text" name="fun_nome" id="fun_nome" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_nome}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_rg">RG:</label>
                        <input type="text" name="fun_rg" id="fun_rg" class="form-control" placeholder="Escreva..."
                        value="@if(isset($funcionario)){{$funcionario->fun_rg}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_cpf">CPF:</label>
                        <input type="text" name="fun_cpf" id="fun_cpf" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_cpf}}@endif" required>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_email">E-mail:</label>
                        <input type="email" name="fun_email" id="fun_email" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_email}}@endif">
                    </div>
                </div>

                <div class="col-sm-3">
                    <label for="car_codigo">Cargo:</label>
                    <select name="car_codigo" class="form-control">
                        <option value="">-- Selecione --</option>
                        @foreach($cargos as $key => $cargo)
                            <option value="{{$key}}" @if(isset($funcionario)) {{$funcionario->car_codigo == $key ? 'selected' :''}}  @endif >{{$cargo}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_comissao">Comissão:</label>
                        <input type="number" step="0.01" min="1" max="100" name="fun_comissao" id="fun_comissao" class="form-control" 
                        value="@if(isset($funcionario)){{$funcionario->fun_comissao}}@endif" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_telefone">Telefone:</label>
                        <input type="text" name="fun_telefone" id="fun_telefone" class="form-control" placeholder="(XX) XXXXXXXX" 
                        value="@if(isset($funcionario)){{$funcionario->fun_telefone}}@endif" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="fun_data_admissao">Data Admissão:</label>
                        <input type="date" name="fun_data_admissao" id="fun_data_admissao" class="form-control" placeholder="Escreva..." 
                        value="@if(isset($funcionario)){{$funcionario->fun_data_admissao}}@endif" required>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="form-group">
                        <label for="fun_observacao">Observação:</label>
                        <textarea class="form-control" name="fun_observacao" id="fun_observacao" rows="2" placeholder="Escreva...">@if(isset($funcionario)){{$funcionario->fun_observacao}}@endif</textarea>
                    </div>
                </div>
            </div>

            
            
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script>
    $(document).ready(function () { 
        var $seuCampoCpf = $("#fun_cpf");
        $seuCampoCpf.mask('000.000.000-00', {reverse: true});
    });
</script>
@stop
