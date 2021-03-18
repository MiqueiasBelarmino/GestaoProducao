<?php

use App\Http\Middleware\CheckLogin;

$this->group(['middleware' => ['auth:funcionario']], function () {

    $this->get('admin', 'AdminController@index')->name('admin.home');

    $this->get('/', 'AdminController@index')->name('admin.raiz');
    // Route::get('/',function(){
    //     dd(Hash::make('123456'));
    // });



    $this->any('cargo/PDF', 'CargoController@gerarPDF')->name('cargo.pdf');
    $this->any('cargo/xlsx', 'CargoController@gerarXLSX')->name('cargo.excel');
    $this->any('cargo/csv', 'CargoController@gerarCSV')->name('cargo.csv');

    //editar e deletar cargo
    $this->get('cargo', 'CargoController@todos')->name('cargo.todos');
    $this->get('cargo/novo', 'CargoController@novo')->name('cargo.novo');
    $this->post('cargo/novo', 'CargoController@store')->name('cargo.store');
    $this->get('cargo/{id}/editar', 'CargoController@novo')->name('cargo.editar');
    $this->post('cargo/{id}/editar', 'CargoController@updatePost')->name('cargo.editar.salvar');
    $this->get('cargo/{id}/deletar', 'CargoController@delete')->name('cargo.deletar');



    //material
    $this->get('material', 'MaterialController@todos')->name('material.todos');
    $this->get('material/novo', 'MaterialController@novo')->name('material.novo');
    $this->any('material/PDF', 'MaterialController@gerarPDF')->name('material.pdf');
    $this->post('material/novo', 'MaterialController@store')->name('material.store');
    $this->get('material/{id}/editar', 'MaterialController@novo')->name('material.editar');
    $this->post('material/{id}/editar', 'MaterialController@updatePost')->name('material.editar.salvar');
    $this->get('material/{id}/deletar', 'MaterialController@delete')->name('material.deletar');

    //produto
    $this->get('produto', 'ProdutoController@todos')->name('produto.todos');
    $this->get('produto/novo', 'ProdutoController@novo')->name('produto.novo');
    $this->post('produto/novo', 'ProdutoController@store')->name('produto.store');
    $this->get('produto/{id}/editar', 'ProdutoController@novo')->name('produto.editar');
    $this->post('produto/{id}/editar', 'ProdutoController@updatePost')->name('produto.editar.salvar');
    $this->get('produto/{id}/deletar', 'ProdutoController@delete')->name('produto.deletar');
    $this->get('produto/produto/{id}', 'ProdutoController@getMateriais');

    //processo
    $this->get('processo', 'ProcessoController@todos')->name('processo.todos');
    $this->get('processo/novo', 'ProcessoController@novo')->name('processo.novo');
    $this->post('processo/novo', 'ProcessoController@store')->name('processo.store');
    $this->get('processo/{id}/editar', 'ProcessoController@novo')->name('processo.editar');
    $this->post('processo/{id}/editar', 'ProcessoController@updatePost')->name('processo.editar.salvar');
    $this->get('processo/{id}/deletar', 'ProcessoController@delete')->name('processo.deletar');
    $this->any('processo/PDF', 'ProcessoController@gerarPDF')->name('processo.pdf');
    $this->any('processo/xlsx', 'ProcessoController@gerarXLSX')->name('processo.excel');
    $this->any('processo/csv', 'ProcessoController@gerarCSV')->name('processo.csv');



    $this->get('fornecedor', 'FornecedorController@index')->name('fornecedor');
    $this->post('fornecedor/todos', 'FornecedorController@todos')->name('fornecedor.todos');
    $this->any('fornecedor/PDF', 'FornecedorController@gerarPDF')->name('fornecedor.pdf');
    $this->any('fornecedor/xlsx', 'FornecedorController@gerarXLSX')->name('fornecedor.excel');
    $this->any('fornecedor/csv', 'FornecedorController@gerarCSV')->name('fornecedor.csv');
    $this->get('fornecedor/novo', 'FornecedorController@novo')->name('fornecedor.novo');
    $this->post('fornecedor/novo', 'FornecedorController@store')->name('fornecedor.store');
    //editar e deletar fornecedor
    $this->get('fornecedor/{id}/editar', 'FornecedorController@novo')->name('fornecedor.editar');
    $this->post('fornecedor/{id}/editar', 'FornecedorController@updatePost')->name('fornecedor.editar.salvar');
    $this->get('fornecedor/{id}/deletar', 'FornecedorController@delete')->name('fornecedor.deletar');


    $this->get('cliente', 'ClienteController@index')->name('cliente');
    $this->post('cliente/todos', 'ClienteController@todos')->name('cliente.todos');
    $this->any('cliente/PDF', 'ClienteController@gerarPDF')->name('cliente.pdf');
    $this->any('cliente/xlsx', 'ClienteController@gerarXLSX')->name('cliente.excel');
    $this->any('cliente/csv', 'ClienteController@gerarCSV')->name('cliente.csv');
    $this->get('cliente/novo', 'ClienteController@novo')->name('cliente.novo');
    $this->post('cliente/novo', 'ClienteController@store')->name('cliente.store');
    //editar e deletar fornecedor
    $this->get('cliente/{id}/editar', 'ClienteController@novo')->name('cliente.editar');
    $this->post('cliente/{id}/editar', 'ClienteController@updatePost')->name('cliente.editar.salvar');
    $this->get('cliente/{id}/deletar', 'ClienteController@delete')->name('cliente.deletar');


    $this->get('funcionario', 'FuncionarioController@index')->name('funcionario');
    $this->post('funcionario/todos', 'FuncionarioController@todos')->name('funcionario.todos');
    $this->any('funcionario/PDF', 'FuncionarioController@gerarPDF')->name('funcionario.pdf');
    $this->any('funcionario/xlsx', 'FuncionarioController@gerarXLSX')->name('funcionario.excel');
    $this->any('funcionario/csv', 'FuncionarioController@gerarCSV')->name('funcionario.csv');
    $this->get('funcionario/novo', 'FuncionarioController@novo')->name('funcionario.novo');
    $this->post('funcionario/novo', 'FuncionarioController@store')->name('funcionario.store');
    //editar e deletar funcionário
    $this->get('funcionario/{id}/editar', 'FuncionarioController@novo')->name('funcionario.editar');
    $this->post('funcionario/{id}/editar', 'FuncionarioController@updatePost')->name('funcionario.editar.salvar');
    $this->get('funcionario/{id}/endereco', 'FuncionarioController@endereco')->name('funcionario.endereco');
    $this->post('funcionario/{id}/endereco', 'FuncionarioController@updatePost')->name('funcionario.endereco.salvar');
    $this->get('funcionario/{id}/deletar', 'FuncionarioController@delete')->name('funcionario.deletar');


    $this->get('pedido', 'PedidoController@index')->name('pedido');
    $this->get('pedido/{id}/historico', 'PedidoController@historico')->name('pedido.historico');
    $this->get('pedido/novo', 'PedidoController@novo')->name('pedido.novo');
    $this->post('pedido/novo', 'PedidoController@store')->name('pedido.store');
    $this->get('pedido/pedido/{id}', 'PedidoController@getProdutosValor');
    $this->get('pedido/{id}/deletar', 'PedidoController@delete')->name('pedido.deletar');

    $this->get('pagamento', 'PagamentoController@index')->name('pagamento');
    $this->get('pagamento/{id}', 'PagamentoController@store')->name('pagamento.store');

    $this->get('producao/compra', 'PedidoController@compra')->name('compra.todos');
    $this->get('producao/{id}/compra', 'PedidoController@compra')->name('compra');
    $this->any('compra/{id}/PDF', 'PedidoController@gerarCompraPDF')->name('compra.pdf');
    $this->get('producao', 'PedidoController@producao')->name('producao');
    $this->get('producao/{id}', 'PedidoController@producaoStore')->name('producao.store');
    


    $this->any('logout', 'FuncionarioController@logout')->name('login.logout');
});
$this->get('login', 'LoginController@index')->name('login');
$this->post('login', 'FuncionarioController@LoginActionHandler')->name('login.logar');
// Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
