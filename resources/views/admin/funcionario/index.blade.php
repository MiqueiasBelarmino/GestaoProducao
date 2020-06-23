@extends('adminlte::page')

@section('title', 'Configurar Listagem')

@section('content_header')
<h1>Funcionários</h1>
@stop



@section('content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Configurar Listagem</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
  @include('includes.alerts')
    <form method="POST" action="{{route('funcionario.todos')}}">
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
            Nome
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="rg" type="checkbox">
            RG
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="cpf" type="checkbox">
            CPF
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
            <input name="cargo" type="checkbox">
            Cargo
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="comissao" type="checkbox">
            Comissão
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
            <input name="data_admissao" type="checkbox">
            Data de Admissão
          </label>
        </div>

        <div class="checkbox">
          <label>
            <input name="observacao" type="checkbox">
            Observação sobre o Funcionário
          </label>
        </div>

      </div>
      <button type="submit" class="btn btn-primary">Visualizar</button>
    </form>
  </div>
  <!-- /.box-body -->
</div>


@stop