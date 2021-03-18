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