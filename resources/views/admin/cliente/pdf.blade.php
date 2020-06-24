<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>
</head>
<body>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                @if(!isset($request->codigo) 
                && !isset($request->nome)
                && !isset($request->nome_social)
                && !isset($request->rg)
                && !isset($request->cpf)
                && !isset($request->telefone)
                && !isset($request->email)
                && !isset($request->observacao)) 

                    <th>Código</th>
                    <th>Razão Social</th>
                    <th>Nome Social/Fantasia</th>
                    <th>RG/Inscricão Estadual</th>
                    <th>CPF/CNPJ</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Observação</th>
                @else

                    @if(isset($request->codigo))<th>Código</th>@endif
                    @if(isset($request->nome))<th>Nome</th>@endif
                    @if(isset($request->nome_social))<th>Nome Social/Fantasia</th>@endif
                    @if(isset($request->rg))<th>RG</th>@endif
                    @if(isset($request->cpf))<th>CPF</th>@endif
                    @if(isset($request->telefone))<th>Telefone</th>@endif
                    @if(isset($request->email))<th>E-mail</th>@endif
                    @if(isset($request->observacao))<th>Observação</th>@endif
                @endif
        </tr>
            </thead>
            <tbody>
            @forelse($clientes as $cliente)
                <tr>
                    @if(!isset($request->codigo) 
                    && !isset($request->nome)
                    && !isset($request->nome_social)
                    && !isset($request->rg)
                    && !isset($request->cpf)
                    && !isset($request->telefone)
                    && !isset($request->email)
                    && !isset($request->observacao)) 

                        <td>{{$cliente->cli_codigo}}</td>
                        <td>{{$cliente->cli_nome_razao_social}}</td>
                        <td>{{$cliente->cli_nome_social_fantasia}}</td>
                        <td>{{$cliente->cli_rg_inscricao_estadual}}</td>
                        <td>{{$cliente->cli_cpf_cnpj}}</td>
                        <td>{{$cliente->cli_telefone}}</td>
                        <td>{{$cliente->cli_email}}</td>
                        <td>{{$cliente->cli_observacao}}</td>

                    @else
                        @if(isset($request->codigo))<td>{{$cliente->cli_codigo}}</td>@endif
                        @if(isset($request->nome))<td>{{$cliente->cli_nome_razao_social}}</td>@endif
                        @if(isset($request->nome_social))<td>{{$cliente->cli_nome_social_fantasia}}</td>@endif
                        @if(isset($request->rg))<td>{{$cliente->cli_rg_inscricao_estadual}}</td>@endif
                        @if(isset($request->cpf))<td>{{$cliente->cli_cpf_cnpj}}</td>@endif
                        @if(isset($request->telefone))<td><td>{{$cliente->cli_telefone}}</td></td>@endif
                        @if(isset($request->email))<td>{{$cliente->cli_email}}</td>@endif
                        @if(isset($request->observacao))<td>{{$cliente->cli_observacao}}</td>@endif
                    @endif
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    
</body>
</html>