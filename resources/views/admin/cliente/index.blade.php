@extends('adminlte::page')

@section('title', 'Configurar Listagem')

@section('content_header')
<h1>Clientes</h1>
@stop



@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Configurar Listagem</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    @include('includes.alerts')
    <form method="POST" action="{{route('cliente.todos')}}">
    {{csrf_field()}}
      <!-- checkbox -->
      <div class="form-group">
            <!-- <label> -->
              <h4><strong>Para listagem completa não marcar nenhuma opção</strong></h4>
            <!-- </label> -->

        <div class="checkbox">
          <label>
            <input name="codigo" type="checkbox">
            Código
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="nome" type="checkbox">
            Nome/Razão Social
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="nome_social" type="checkbox">
            Nome Social/Fantasia
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="rg" type="checkbox">
            RG/Inscrição Estadual
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="cpf" type="checkbox">
            CPF/CNPJ
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="telefone" type="checkbox">
            Telefone
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="email" type="checkbox">
            E-mail
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="observacao" type="checkbox">
            Observação sobre o cliente
          </label>
        </div>

      </div>
      <button type="submit" class="btn btn-primary">Visualizar</button>
    </form>
  </div>
  <!-- /.box-body -->
</div>


@stop