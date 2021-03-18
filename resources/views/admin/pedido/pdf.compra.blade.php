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
    <h2 style="text-align: center;">Materiais necessários comprados para produção dos pedidos</h2>
        <table align=center class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Material</th>
                    <th>Unidade</th>
                    <th>Quantidade</th>
                    <th>Custo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($itens_compra as $itens)
                <tr>
                    <td>{{$itens->mat_nome}}</td>
                    <td>{{$itens->mat_unidade}}</td>
                    <td>{{$itens->mat_pro_quantidade}}</td>
                    <td>{{$itens->valor}}</td>
                </tr>
                @empty
                @endforelse
            </tbody>
        </table>

</body>

</html>