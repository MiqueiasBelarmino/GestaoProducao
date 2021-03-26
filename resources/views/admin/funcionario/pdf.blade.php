<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
            margin:auto;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
@include('includes.functions')
<h2 style="text-align: center;">Funcionários</h2>
        <table align=center class="table table-bordered table-hover">
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

                <th>Código</th>
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
                        @if(isset($request->data_admissao))<td>{{dateFormat($funcionario->fun_data_admissao)}}</td>@endif
                        @if(isset($request->observacao))<td>{{$funcionario->fun_observacao}}</td>@endif
                    @endif
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    
</body>
</html>