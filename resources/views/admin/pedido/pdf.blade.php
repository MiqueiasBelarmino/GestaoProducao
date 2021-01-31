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
                <th>#</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Salário Base</th>
                <th>Observação</th>
            </tr>
            </thead>
            <tbody>
                @forelse($cargos as $cargo)
                    <tr>
                        <td>{{$cargo->car_codigo}}</td>
                        <td>{{$cargo->car_nome}}</td>
                        <td>{{$cargo->car_descricao}}</td>
                        <td>{{number_format($cargo->car_salario_base,2,'.',',')}}</td>
                        <td>{{$cargo->car_observacao}}</td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    
</body>
</html>