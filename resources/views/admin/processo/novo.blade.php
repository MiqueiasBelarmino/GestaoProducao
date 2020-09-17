@extends('adminlte::page')
@if(isset($processo))
    @section('title', 'Editar Processo')
@else
    @section('title', 'Novo Processo')
@endif

@section('content_header')
@stop

@section('content')

<div class="box">
    <div class="box-header">
        @if(isset($processo))
            <h1>Editar Processo</h1>
        @else
            <h1>Novo Processo</h1>
        @endif
    </div>

    <div class="box-body">
        @include('includes.alerts')
        @if(isset($processo))
            <form method="POST" action="{{ route('processo.editar.salvar',['id' =>$processo->proc_codigo]) }}">
        @else
            <form method="POST" action="{{ route('processo.store') }}">
        @endif
            {{csrf_field()}}
            <div class="row">

                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <input type="text" name="descricao" id="descricao" class="form-control" value="@if(isset($processo)) {{$processo->proc_descricao}} @endif" placeholder="Escreva...">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="observacao">Observação:</label>
                        <textarea class="form-control" name="observacao" id="observacao" rows="4" placeholder="Escreva...">@if(isset($processo)){{trim($processo->proc_observacao)}}@endif</textarea>
                    </div>
                </div>
            </div>

          
                
            
            <button type="submit" class="btn btn-primary">Confirmar</button>
        </form>
    </div>
</div>
@stop