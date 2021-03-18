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
            margin: auto;
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
    <h2 style="text-align: center;">Materiais</h2>
    <table align=center class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Fornecedor</th>
                <th>Unidade</th>
                <th>Custo</th>
                <th>Observação</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materiais as $material)
            <tr>
                <td>{{$material->mat_codigo}}</td>
                <td>{{$material->mat_nome}}</td>
                <td>{{$material->fornecedor->for_nome_razao_social}}</td>
                <td>{{$material->mat_unidade}}</td>
                <td>{{number_format($material->mat_custo,2,'.',',')}}</td>
                <td>{{$material->mat_observacao}}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>

</body>

</html>