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
                <th>Observação</th>
            </tr>
            </thead>
            <tbody>
                @forelse($processos as $processo)
                    <tr>
                        <td>{{$processo->proc_codigo}}</td>
                        <td>{{$processo->proc_nome}}</td>
                        <td>{{$processo->proc_observacao}}</td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    
</body>
</html>