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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
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


        // $(".view_data").on("click", function() {
        //     $.ajax({
        //         url: 'producao/' + $(this).attr("id") + '/historico',
        //         type: 'get',
        //         dataType: 'json',
        //         success: function(response) {

        //             var len = 0;
        //             $('#table_modal tbody').empty();
        //             if (response['data'] != null) {
        //                 len = response['data'].length;
        //             }

        //             for (var i = 0; i < len; i++) {
        //                 $("#table_modal tbody").append(
        //                     "<tr>" +
        //                     "<td>" + response['data'][i].proc_nome; + "</td>" +
        //                     "<td>" + response['data'][i].his_pro_data_entrada; + "</td>" +
        //                     "<td>" + response['data'][i].his_pro_data_saida; + "</td>" +
        //                     "<td>" + response['data'][i].dias_processo; + "</td>" +
        //                     "</tr>"
        //                 );
        //             }

        //         }
        //     });
        // });

        // var ped_codigo = $(this).attr("id");
        // alert(ped_codigo);
        // // if(ped_codigo !== ''){
        // //     var dados = {
        // //         ped_codigo: ped_codigo
        // //     };
        // //     $.post('',dados,function(retorna){var table = $("#table tbody");
        // $.each(data, function(idx, elem) {
        //     table.append("<tr><td>" + elem.username + "</td><td>" + elem.name +
        //         "</td>   <td>" + elem.lastname + "</td></tr>");
        // });

        // //     });
        // // }


        $('#seletor_material').select2();
        $('#seletor_cliente').select2();
        $('#seletor_produto').select2();
        $('#seletor_cor').select2();
        $('#detalhes_calca').hide();

        $('#seletor_material').change(function() {
            fetchRecords($('#seletor_material').val());
        });

        $('.view_data').on('click', function() {
            var id = $(this).attr("id");
            fetchHistory(id);
        });

        $('.view_pedido').on('click', function() {
            var id = $(this).attr("id");
            fetchPedidoDetalhes(id);
        });

        $('#seletor_produto').change(function() {
            getProdutosValor($('#seletor_produto').val());
        });

        $('#seletor_grupo').change(function() {
            if ($('#seletor_grupo').val() === '1') {
                $('#detalhes_camiseta').show();
                $('#detalhes_calca').hide();
            } else if ($('#seletor_grupo').val() === '2') {
                $('#detalhes_calca').show();
                $('#detalhes_camiseta').hide();
            }
        });

        $('#tabela_pagamentos').dataTable({
            "searching": true,
            "paging": false,
            "language": {
                "url": "{{ asset('json/Portuguese-Brasil.json') }}"
            },
            ordering: false
        });

        $('#tabela_pedidos').dataTable({
            "searching": true,
            "paging": false,
            "language": {
                "url": "{{ asset('json/Portuguese-Brasil.json') }}"
            },
            ordering: false
        });

        $('#tabela_processos').dataTable({
            "searching": true,
            "paging": false,
            "language": {
                "url": "{{ asset('json/Portuguese-Brasil.json') }}"
            },
            ordering: false
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
        var pedData = document.getElementById('ped_data');
        var pedDataEntrega = document.getElementById('ped_data_entrega');
        var pedDataVencimento = document.getElementById('ped_data_vencimento');
        if (pedData !== null)
            document.getElementById('ped_data').value = new Date().toDateInputValue(new Date().addDays(0));
        if (pedDataEntrega !== null)
            document.getElementById('ped_data_entrega').value = new Date().toDateInputValue(new Date().addDays(
                45));
        if (pedDataVencimento !== null)
            document.getElementById('ped_data_vencimento').value = new Date().toDateInputValue(new Date()
                .addDays(0));
        // date('d/m/Y', strtotime('+5 days', strtotime('14-07-2014')))


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
                document.getElementById('ped_data_vencimento').value = new Date().toDateInputValue(
                    new Date().addDays(30));
            } else {
                document.getElementById('data_venc').textContent = 'Data Vencimento';
                parcela.prop("disabled", true);
                document.getElementById('ped_data_vencimento').value = new Date().toDateInputValue(
                    new Date().addDays(0));
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
        qtd_produtos--;

        $('#tabela_produtos tr').each(function(row, tr) {
            if ($(tr).find('td:eq(0)').text() == "") {} else {
                aux += parseFloat($(tr).find('td:eq(3)').text());
            }

        });
        // total_material = parseFloat(total_material) - parseFloat($aux);

        $('#valor').val(aux);
    }

    function formataStringData(data) {
        if(data === null || data === ""){
            return "";
        }else{
            var separador = "-";
            var ano = data.split("-")[0];
            var mes = data.split("-")[1];
            var dia = data.split("-")[2];

            return ("0" + dia).slice(-2) + '-' + ("0" + mes).slice(-2) + '-' + ano;
        }
        // Utilizo o .slice(-2) para garantir o formato com 2 digitos.
    }

    function fetchHistory(id) {
        $.ajax({
            url: 'producao/' + id + '/historico',
            type: 'get',
            dataType: 'json',
            success: function(response) {

                var len = 0;
                $('#table_modal tbody').empty();
                if (response['data'] != null) {
                    len = response['data'].length;
                }

                var entrada ='';
                var saida ='';
                for (var i = 0; i < len; i++) {
                    
                    var aux = response['data'][i].his_pro_data_entrada;
                    entrada = (aux===null) ? '': formataStringData(aux);
                    aux = response['data'][i].his_pro_data_saida;
                    saida = (aux===null) ? '': formataStringData(aux);
                    
                   
                    $("#table_modal tbody").append(
                        '<tr  class="tr">' +
                        '<td class="td">' + response['data'][i].proc_nome + '</td>' +
                        '<td class="td">' + entrada + '</td>' +
                        '<td class="td">' + saida + '</td>' +
                        '<td class="td">' + response['data'][i].dias_processo + '</td>' +
                        '</tr>'
                    );
                    entrada = '';
                    saida = '';
                }

            }
        });
    }

    function fetchPedidoDetalhes(id) {
        $.ajax({
            url: 'producao/' + id + '/pedido',
            type: 'get',
            dataType: 'json',
            success: function(response) {

                console.log(response);
                var len = 0;
                $('#produtos_detalhes').empty();
                $('#table_modal_pedido tbody').empty();
                if (response['pedido'] != null) {
                    len = response['pedido'].length;
                }

                if(len>0){
                    $("#table_modal_pedido tbody").append(
                        '<tr  class="tr">' +
                        '<td class="td">' + response['pedido'][0].ped_codigo + '</td>' +
                        '<td class="td">' + response['pedido'][0].cli_nome_razao_social+ '</td>' +
                        '<td class="td">' + response['pedido'][0].ped_total + '</td>' +
                        '<td class="td">' + formataStringData(response['pedido'][0].ped_data) + '</td>' +
                        '<td class="td">' + formataStringData(response['pedido'][0].ped_data_aprovacao) + '</td>' +
                        '<td class="td">' + formataStringData(response['pedido'][0].ped_data_entrega) + '</td>' +
                        '<td class="td">' + response['pedido'][0].ped_status_pagamento + '</td>' +
                        '</tr>'
                    );

                    for(var i=0; i<(response['detalhes'].length);i++){
                        $("#produtos_detalhes").append(
                            '<table id="table_det_ite'+i+'" class="table">'+
                            '<tbody>'+
                            '<tr>' +
                            '<td><strong>Produto: </strong></td>' +
                            '<td>' +response['detalhes'][i].prod_nome + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><strong>Quantidade: </strong></td>' +
                            '<td>' +response['detalhes'][i].ite_ped_quantidade + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><strong>Cor: </strong></td>' +
                            '<td>' +response['detalhes'][i].ite_ped_cor + '</td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td><strong>Valor(R$): </strong></td>' +
                            '<td>' +response['detalhes'][i].ite_ped_valor+ '</td>' +
                            '</tr>'+
                            '</tbody>'
                            // +'<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'
                            +'</table>'
                        );
                        if(response['pedido'][i].det_cal_codigo !== null && response['pedido'][i].det_cam_codigo === null){
                            $("#produtos_detalhes").append(
                                '<table id="table_det_cal'+i+'" class="table">' +
                                '<tbody><tr>'+
                                    '<td><strong>Passadores: </strong></td>' +
                                    '<td>' +(response['detalhes'][i].det_cal_passadores===1? "Sim":"Não")+ '</td>' +
                                    '<td><strong>Elástico: </strong></td>' +
                                    '<td>' +(response['detalhes'][i].det_cal_elastico===1? "Sim":"Não") + '</td>' +
                                    '<td><strong>Bolso Frente: </strong></td>' +
                                    '<td>' +(response['detalhes'][i].det_cal_bolso_frente===1? "Sim":"Não") + '</td>' +
                                    '<td><strong>Bolso Costas: </strong></td>' +
                                    '<td>' +(response['detalhes'][i].det_cal_bolso_costas===1? "Sim":"Não") + '</td>' +
                                    '<td><strong>Refletiva: </strong></td>' +
                                    '<td>' +(response['detalhes'][i].det_cal_refletiva==1? "Sim":"Não") + '</td>' +
                                '</tr>'+
                                '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'+
                                '<tbody>'+'</table>'
                            );
                        } 
                        else if(response['pedido'][i].det_cam_codigo !== null && response['pedido'][i].det_cal_codigo === null){
                            $("#produtos_detalhes").append(
                                '<table id="table_det_cam'+i+'" class="table">' +
                                '<tbody><tr>'+
                                '<td><strong>Tipo Manga: </strong></td>' +
                                '<td>' +auxiliar("det_cam_manga_tipo",response,i)+ '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><strong>Tamanho Manga: </strong></td>' +
                                '<td>' +auxiliar("det_cam_manga_tamanho",response,i)+ '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><strong>Cor Manga: </strong></td>' +
                                '<td>' +auxiliar("det_cam_manga_cor",response,i)+ '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><strong>Galão: </strong></td>' +
                                '<td>' +response['detalhes'][i].det_cam_manga_galao===1? "Sim":"Não" + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><strong>Gola: </strong></td>' +
                                '<td>' +auxiliar("det_cam_gola_tipo",response,i) + '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><strong>Decote: </strong></td>' +
                                '<td>' +auxiliar("det_cam_gola_decote",response,i)+ '</td>' +
                                '</tr>' +
                                '<tr>' +
                                '<td><strong>Refletiva: </strong></td>' +
                                '<td>' +response['detalhes'][i].det_cam_bolso_frente==1? "Sim":"Não" + '</td>' +
                                '</tr>' +
                                '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'+
                                '<tbody>'+'</table>'
                            );
                        }
                        
                    }
                }

            }
        });
    }

    function auxiliar(value, response,i){
        if(value==="det_cam_manga_tipo"){
            var aux = response['detalhes'][i].det_cam_manga_tipo;
            if(aux===0)
                return "Padrão";
            else if(aux===1)
                return "Raglã";
            else if(aux===2)
                return "Regata";
            else if(aux===2)
                return "Machão";
        }else if(value==="det_cam_manga_tamanho"){
            var aux = response['detalhes'][i].det_cam_manga_tamanho;
            if(aux===0)
                return "Curta";
            else if(aux===1)
                return "Longa";
        }else if(value==="det_cam_gola_tipo"){
            var aux = response['detalhes'][i].det_cam_gola_tipo;
            if(aux===0)
                return "Viés";
            else if(aux===1)
                return "Ribana";
            else if(aux===2)
                return "Polo";
        }else if(value==="det_cam_gola_decote"){
            var aux = response['detalhes'][i].det_cam_manga_tamanho;
            if(aux===0)
                return "Redondo";
            else if(aux===1)
                return "Vê";
        }
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
            if ($('#unidade').val() == "" || $('#custo_material').val() == "" || $('#quantidade')
                .val() == "") {
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

        $('#confirma_produto').click(function() {
            if ($('#nome').val() == "") {
                Swal.fire('Informe o nome do produto!');
            } else if (qtd_materiais == 0) {
                Swal.fire('Informe os materiais usados no produto!');
            } else {
                var table_data = [];

                var prod = {
                    'nome': $('#nome').val(),
                    'valor': $('#valor').val(),
                    'observacao': $('#observacao').val(),
                    'grupo': $('#seletor_grupo').val(),
                    'manga_tipo': $('#seletor_tipo_manga').val(),
                    'manga_tamanho': $('#seletor_tamanho_manga').val(),
                    'manga_cor': $('#manga_cor').val(),
                    'manga_galao': $('#manga_galao').val(),
                    'gola_tipo': $('#seletor_gola').val(),
                    'gola_decote': $('#seletor_decote').val(),
                    'bolso_frente_cam': $('#bolso_frente_cam').val(),
                    'passadores': $('#passadores').val(),
                    'elastico': $('#elastico').val(),
                    'elastico_costa': $('#elastico_costa').val(),
                    'bolso_frente': $('#bolso_frente').val(),
                    'bolso_costas': $('#bolso_costas').val(),
                    'refletiva': $('#refletiva').val()
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
                var cor = $('#seletor_cor option:selected').text();
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
                    'pag_data_vencimento': $('#ped_data_vencimento').val(),
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
                        Swal.fire('ERRO', data.responseJSON.message, 'error');
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