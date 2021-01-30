<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 2'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Select2 -->
    <!-- <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/select2/css/select2.min.css') }}"> -->

    @include('adminlte::plugins', ['type' => 'css'])

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">

    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition @yield('body_class')">

    @yield('body')

    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.slimscroll.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script> -->
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.mask.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/custom.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- <script src="{{ asset('vendor/adminlte/vendor/select2/dist/js/select2.min.js') }}"></script> -->
    <script type="text/javascript">
        var qtd_materiais = 0;
        var sub_material = 0;
        var total_material = 0;
        $(document).ready(function() {
            $('#seletor_material').select2();

            $('#seletor_material').change(function() {
                fetchRecords($('#seletor_material').val());
            });

        });

        function remove(rowId) {
            $('#' + rowId).remove();
        }

        function isEmpty() {
            if ($('#nome').val() == "") {
                return 1;
            } else if (qtd_materiais == 0) {
                return 2;
            }
            return 0;
        }

        function isProduto() {
            if ($('#unidade').val() == "") {
                return 1;
            } else if ($('#custo_material').val() == "") {
                return 2;
            } else if ($('#quantidade').val() == "") {
                return 3;
            }
            return 0;
        }

        function fetchRecords(id) {
            $.ajax({
                url: 'produto/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {

                    var len = 0;
                    // $('#userTable tbody').empty(); // Empty <tbody>
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        var unidade = response['data'][0].mat_unidade;
                        var custo = response['data'][0].mat_custo;

                        $('#unidade').val(unidade);
                        $('#custo_material').val(custo);
                    }

                }
            });
        }

        function savaData($data) {
            var _token = $('meta[name="_token"]').attr('content');

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': _token

                }

            });
            $.ajax({
                type: 'POST',
                url: "{{route('produto.store')}}",
                // url: "produto/novo",
                dataType: 'json',
                data: $data,
                success: function(data) {
                    console.log(data);
                },
                error: function(data){
                    console.log(data);
                }

            });
        }
    </script>
    <script type="text/javascript">
        $(function() {

            $('#add_material').click(function() {
                // console.log(isProduto());
                if (isProduto() == 0) {
                    var nome = $('#seletor_material option:selected').text();
                    var quantidade = $('#quantidade').val();
                    var valor = $('#custo_material').val();
                    sub_material = (valor * quantidade);
                    total_material += sub_material;
                    $('#tabela_materiais tbody:last-child').append(
                        '<tr id="' + $('#seletor_material').val() + '">' +
                        '<td style="display:none;">' + $('#seletor_material').val() + '</td>' +
                        '<td>' + nome + '</td>' +
                        '<td>' + quantidade + '</td>' +
                        '<td>' + sub_material + '</td>' +
                        '<td>' +
                        // '<a class="delete_class btn btn-danger" id="' + $('#seletor_material').val() + '">' +
                        '<button onclick="remove(' + $('#seletor_material').val() + ')">' +
                        '<i class="fa fa-trash"></i>' +
                        //remover da table em tela : https://stackoverflow.com/questions/34956481/ajax-delete-row-in-table-with-php-id-selected
                        //https://www.google.com/search?q=ajax+jquery+remove+line+from+table&oq=ajax+jquery+remove+line+from+table&aqs=chrome..69i57.12700j0j1&sourceid=chrome&ie=UTF-8 
                        '</button>' +
                        // '</a>' +
                        '</td>' +
                        '</tr>'
                    );
                    qtd_materiais++;
                } else {
                    Swal.fire('Escolha o material e a quantidade!');
                }
            });

            $('#MAIN').click(function() {
                //validar se está tudo preenchido

                let _token = $('meta[name="csrf-token"]').attr('content');

                if (isEmpty() == 0) {
                    var table_data = [];

                    var prod = {
                        'nome': $('#nome').val(),
                        'valor': $('#valor').val(),
                        'observacao': $('#observacao').val()
                    };
                    table_data.push(prod);

                    $('#tabela_materiais tr').each(function(row, tr) {
                        if ($(tr).find('td:eq(0)').text() == "") {

                        } else {
                            var sub = {
                                'material': $(tr).find('td:eq(0)').text(),
                                'quantidade': $(tr).find('td:eq(1)').text(),
                                'valor': $(tr).find('td:eq(2)').text()
                            };
                            table_data.push(sub);
                        }

                    });
                    var data = {
                        'data': table_data
                    };
                    //salvar
                    savaData(data);


                    //zerar variéveis de valores
                } else if (isEmpty() == 1) {
                    Swal.fire('Informe o nome do produto!');
                } else if (isEmpty() == 2) {
                    Swal.fire('Informe os materiais usados no produto!');
                }

            });
        });
    </script>

    @include('adminlte::plugins', ['type' => 'js'])

    @yield('adminlte_js')

    @if(config('adminlte.plugins.select2'))
    <!-- Select2 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    @endif

    @if(config('adminlte.plugins.datatables'))
    <!-- DataTables with bootstrap 3 renderer -->
    <script src="//cdn.datatables.net/v/bs/dt-1.10.18/datatables.min.js"></script>
    @endif

    @if(config('adminlte.plugins.chartjs'))
    <!-- ChartJS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    @endif

</body>

</html>