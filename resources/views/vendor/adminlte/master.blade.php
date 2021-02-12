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
        var qtd_produtos = 0;
        var sub_material = 0;
        var total_material = 0;
        $(document).ready(function() {

            $('#tabela_pagamentos').dataTable({
                "searching": true,
                "paging": false,
                "language": {
                    "url": "http://cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"
                }
            });

            Date.prototype.toDateInputValue = (function(date) {
                var local = new Date(date);
                local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                return local.toJSON().slice(0, 10);
            });

            Date.prototype.addDays = function(days) {
                var date = new Date(this.valueOf());
                date.setDate(date.getDate() + days);
                return date;
            }

            document.getElementById('ped_data').value = new Date().toDateInputValue(new Date().addDays(0));
            document.getElementById('ped_data_entrega').value = new Date().toDateInputValue(new Date().addDays(45));
            document.getElementById('ped_data_vencimento').value = new Date().toDateInputValue(new Date().addDays(0));
            // date('d/m/Y', strtotime('+5 days', strtotime('14-07-2014')))
            $('#seletor_material').select2();
            $('#seletor_cliente').select2();
            $('#seletor_produto').select2();
            $('#seletor_cor').select2();

            $('#seletor_material').change(function() {
                fetchRecords($('#seletor_material').val());
            });
            $('#seletor_produto').change(function() {
                getProdutosValor($('#seletor_produto').val());
            });

            $('#seletor_forma_pagamento').change(function() {

                var parcela = $("#pag_numero_parcela");
                var vencimento = $('#ped_data_vencimento');
                if ($('#seletor_forma_pagamento option:selected').text() == "Parcelamento") {
                    document.getElementById('data_venc').textContent = 'Primeiro Vencimento';
                    parcela.prop("disabled", false);
                    vencimento.prop("disabled", false);
                } else if ($('#seletor_forma_pagamento option:selected').text() == "30 dias") {
                    document.getElementById('data_venc').textContent = 'Data Vencimento';
                    parcela.prop("disabled", true);
                    vencimento.prop("disabled", false);
                    document.getElementById('ped_data_vencimento').value = new Date().toDateInputValue(new Date().addDays(30));
                } else {
                    document.getElementById('data_venc').textContent = 'Data Vencimento';
                    parcela.prop("disabled", true);
                    document.getElementById('ped_data_vencimento').value = new Date().toDateInputValue(new Date().addDays(0));
                }

            });

        });


        function removeMaterial(rowId) {
            $('#' + rowId).remove();
            var aux = 0;
            qtd_materiais--;

            $('#tabela_materiais tr').each(function(row, tr) {
                if ($(tr).find('td:eq(0)').text() == "") {} else {
                    aux += parseFloat($(tr).find('td:eq(3)').text());
                }

            });
            // total_material = parseFloat(total_material) - parseFloat($aux);

            $('#valor').val(aux);
        }

        function removeProduto(rowId) {
            $('#' + rowId).remove();
            var aux = 0;
            qtd_materiais--;

            $('#tabela_produtos tr').each(function(row, tr) {
                if ($(tr).find('td:eq(0)').text() == "") {} else {
                    aux += parseFloat($(tr).find('td:eq(3)').text());
                }

            });
            // total_material = parseFloat(total_material) - parseFloat($aux);

            $('#valor').val(aux);
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

        // function desabilitar(valor) {

        // }

        function getProdutosValor(id) {
            $.ajax({
                url: 'pedido/' + id,
                type: 'get',
                dataType: 'json',
                success: function(response) {

                    var len = 0;
                    if (response['data'] != null) {
                        len = response['data'].length;
                    }

                    if (len > 0) {
                        var custo = response['data'][0].prod_valor;
                        $('#custo_produto').val(custo);
                    }
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(function() {

            var setNumber = function($tabela) {
                return table_len = $('#' + $tabela + ' tbody tr').length + 1;
            }

            $('#add_material').click(function() {
                if ($('#unidade').val() == "" || $('#custo_material').val() == "" || $('#quantidade').val() == "") {
                    Swal.fire('Escolha o material e a quantidade!');
                } else {
                    var nome = $('#seletor_material option:selected').text();
                    var quantidade = parseFloat($('#quantidade').val());
                    var valor = parseFloat($('#custo_material').val());
                    sub_material = (parseFloat(valor) * parseFloat(quantidade));
                    total_material += parseFloat(sub_material);
                    $id = setNumber('tabela_materiais');
                    $('#tabela_materiais tbody:last-child').append(
                        '<tr id="' + $id + '">' +
                        '<td style="display:none;">' + $('#seletor_material').val() + '</td>' +
                        '<td>' + nome + '</td>' +
                        '<td>' + quantidade + '</td>' +
                        '<td>' + sub_material + '</td>' +
                        '<td>' +
                        // '<a class="delete_class btn btn-danger" id="' + $('#seletor_material').val() + '">' +
                        '<button onclick="removeMaterial(' + $id + ')">' +
                        '<i class="fa fa-trash"></i>' +

                        '</button>' +
                        // '</a>' +
                        '</td>' +
                        '</tr>'
                    );
                    $('#valor').val(total_material);
                    qtd_materiais++;
                    sub_material = 0;
                }
            });

            $('#MAIN').click(function() {
                if ($('#nome').val() == "") {
                    Swal.fire('Informe o nome do produto!');
                } else if (qtd_materiais) {
                    Swal.fire('Informe os materiais usados no produto!');
                } else {
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
                                'quantidade': $(tr).find('td:eq(2)').text(),
                                'custo_material': $(tr).find('td:eq(3)').text()
                            };
                            table_data.push(sub);
                        }

                    });
                    var dataForm = {
                        'data': table_data
                    };
                    //salvar
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
                        data: dataForm,
                        success: function(data) {
                            total_material = 0;
                            sub_material = 0;
                            qtd_materiais = 0;
                            Swal.fire({
                                title: 'Produto registrado!',
                                icon: 'success',
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                window.location.href = "{{route('produto.novo')}}";
                            })

                        },
                        error: function(data) {
                            Swal.fire('', '', 'error');
                            console.log(data);
                        }

                    });
                    //zerar variéveis de valores
                }

            });


            //js-ajax-search
            $('#MAIN').click(function() {
                if ($('#nome').val() == "") {
                    Swal.fire('Informe o nome do produto!');
                } else if (qtd_materiais) {
                    Swal.fire('Informe os materiais usados no produto!');
                } else {
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
                                'quantidade': $(tr).find('td:eq(2)').text(),
                                'custo_material': $(tr).find('td:eq(3)').text()
                            };
                            table_data.push(sub);
                        }

                    });
                    var dataForm = {
                        'data': table_data
                    };
                    //salvar
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
                        data: dataForm,
                        success: function(data) {
                            total_material = 0;
                            sub_material = 0;
                            qtd_materiais = 0;
                            Swal.fire({
                                title: 'Produto registrado!',
                                icon: 'success',
                                showDenyButton: true,
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                            }).then((result) => {
                                window.location.href = "{{route('produto.novo')}}";
                            })

                        },
                        error: function(data) {
                            Swal.fire('', '', 'error');
                            console.log(data);
                        }

                    });
                    //zerar variéveis de valores
                }

            });


            //AJAX PEDIDO
            $('#add_produto').click(function() {
                if ($('#custo_produto').val() == "" || $('#quantidade').val() == "") {
                    Swal.fire('Escolha o produto e a quantidade!');
                } else {
                    var nome = $('#seletor_produto option:selected').text();
                    var quantidade = $('#quantidade').val();
                    var valor = parseFloat($('#custo_produto').val());
                    var sub_produto = (valor * quantidade);
                    var cor = $('#seletor_produto option:selected').text();
                    var aux = 0;
                    $id = setNumber('tabela_produtos');
                    $('#tabela_produtos tbody:last-child').append(
                        '<tr id="' + $id + '">' +
                        '<td style="display:none;">' + $('#seletor_produto').val() + '</td>' +
                        '<td>' + nome + '</td>' +
                        '<td>' + quantidade + '</td>' +
                        '<td>' + cor + '</td>' +
                        '<td>' + sub_produto + '</td>' +
                        '<td>' +
                        // '<a class="delete_class btn btn-danger" id="' + $('#seletor_material').val() + '">' +
                        '<button onclick="removeProduto(' + $id + ')">' +
                        '<i class="fa fa-trash"></i>' +
                        '</button>' +
                        // '</a>' +
                        '</td>' +
                        '</tr>'
                    );
                    $('#tabela_produtos tr').each(function(row, tr) {
                        if ($(tr).find('td:eq(0)').text() == "") {} else {
                            aux += parseFloat($(tr).find('td:eq(4)').text());
                        }

                    });

                    $('#valor').val(aux);
                    qtd_produtos++;
                    sub_produto = 0;
                }
            });

            $('#confirma_pedido').click(function() {
                //validar se está tudo preenchido

                if ($('#seletor_cliente option:selected').text() == "SELECIONE") {
                    Swal.fire('Selecione o cliente!');
                } else if (qtd_produtos == 0) {
                    Swal.fire('Selecione os produtos!');
                } else {
                    var table_data = [];

                    var pedido = {
                        'cli_codigo': $('#seletor_cliente').val(),
                        'fun_codigo': $('#funcionario').val(),
                        'ped_total': $('#valor').val(),
                        'ped_data': $('#ped_data').val(),
                        'ped_data_entrega': $('#ped_data_entrega').val(),
                        'ped_status_pagamento': "Pendente",
                        'ped_observacao': $('#observacao').val()
                    };
                    table_data.push(pedido);
                    var pagamento = {
                        'pag_forma': $('#seletor_forma_pagamento').val(),
                        'pag_numero_parcela': $('#pag_numero_parcela').val(),
                        'pag_data_vencimento': $('#ped_data').val(),
                        'pag_data_pagamento': $('#ped_data_entrega').val()
                    };
                    table_data.push(pagamento);

                    $('#tabela_produtos tr').each(function(row, tr) {
                        if ($(tr).find('td:eq(0)').text() == "") {

                        } else {
                            var sub = {
                                'prod_codigo': $(tr).find('td:eq(0)').text(),
                                'quantidade': $(tr).find('td:eq(2)').text(),
                                'cor': $(tr).find('td:eq(3)').text(),
                                'custo_produto': $(tr).find('td:eq(4)').text()
                            };
                            table_data.push(sub);
                        }

                    });
                    var dataForm = {
                        'data': table_data
                    };
                    //salvar
                    var _token = $('meta[name="_token"]').attr('content');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': _token
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        url: "{{route('pedido.store')}}",
                        dataType: 'json',
                        data: dataForm,
                        success: function(data) {
                            console.log(data);
                            qtd_produtos = 0;
                            Swal.fire({
                                title: 'Pedido registrado!',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'OK',
                            }).then((result) => {

                            })

                        },
                        error: function(data) {
                            Swal.fire('ERRO', data.message, 'error');
                            console.log(data);
                        }

                    });
                    //zerar variéveis de valores
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
    <script src="//cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json"></script>


    @if(config('adminlte.plugins.chartjs'))
    <!-- ChartJS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    @endif

</body>

</html>