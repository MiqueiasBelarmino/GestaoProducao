<?php

use App\Http\Middleware\CheckLogin;

// $this->group(['middleware' => ['CheckLogin::class']], function(){

    $this->get('admin','AdminController@index')->name('admin.home')->middleware('checklogin');

    $this->get('/','AdminController@index')->name('admin.raiz')->middleware('checklogin');


   
    $this->any('cargo/PDF', 'CargoController@gerarPDF')->name('cargo.pdf')->middleware('checklogin');
    $this->any('cargo/xlsx', 'CargoController@gerarXLSX')->name('cargo.excel')->middleware('checklogin');
    $this->any('cargo/csv', 'CargoController@gerarCSV')->name('cargo.csv')->middleware('checklogin');
    
    //editar e deletar cargo
    $this->get('cargo', 'CargoController@todos')->name('cargo.todos')->middleware('checklogin');
    $this->get('cargo/novo', 'CargoController@novo')->name('cargo.novo')->middleware('checklogin');
    $this->post('cargo/novo', 'CargoController@store')->name('cargo.store')->middleware('checklogin');
    $this->get('cargo/{id}/editar', 'CargoController@novo')->name('cargo.editar')->middleware('checklogin');
    $this->post('cargo/{id}/editar', 'CargoController@updatePost')->name('cargo.editar.salvar')->middleware('checklogin');
    $this->get('cargo/{id}/deletar', 'CargoController@delete')->name('cargo.deletar')->middleware('checklogin');

    //material
    $this->get('material', 'MaterialController@todos')->name('material.todos')->middleware('checklogin');
    $this->get('material/novo', 'MaterialController@novo')->name('material.novo')->middleware('checklogin');
    $this->post('material/novo', 'MaterialController@store')->name('material.store')->middleware('checklogin');
    $this->get('material/{id}/editar', 'MaterialController@novo')->name('material.editar')->middleware('checklogin');
    $this->post('material/{id}/editar', 'MaterialController@updatePost')->name('material.editar.salvar')->middleware('checklogin');
    $this->get('material/{id}/deletar', 'MaterialController@delete')->name('material.deletar')->middleware('checklogin');

    //processo
    $this->get('processo', 'ProcessoController@todos')->name('processo.todos')->middleware('checklogin');
    $this->get('processo/novo', 'ProcessoController@novo')->name('processo.novo')->middleware('checklogin');
    $this->post('processo/novo', 'ProcessoController@store')->name('processo.store')->middleware('checklogin');
    $this->get('processo/{id}/editar', 'ProcessoController@novo')->name('processo.editar')->middleware('checklogin');
    $this->post('processo/{id}/editar', 'ProcessoController@updatePost')->name('processo.editar.salvar')->middleware('checklogin');
    $this->get('processo/{id}/deletar', 'ProcessoController@delete')->name('processo.deletar')->middleware('checklogin');



    $this->get('fornecedor', 'FornecedorController@index')->name('fornecedor')->middleware('checklogin');
    $this->post('fornecedor/todos', 'FornecedorController@todos')->name('fornecedor.todos')->middleware('checklogin');
    $this->any('fornecedor/PDF', 'FornecedorController@gerarPDF')->name('fornecedor.pdf')->middleware('checklogin');
    $this->any('fornecedor/xlsx', 'FornecedorController@gerarXLSX')->name('fornecedor.excel')->middleware('checklogin');
    $this->any('fornecedor/csv', 'FornecedorController@gerarCSV')->name('fornecedor.csv')->middleware('checklogin');
    $this->get('fornecedor/novo', 'FornecedorController@novo')->name('fornecedor.novo')->middleware('checklogin');
    $this->post('fornecedor/novo', 'FornecedorController@store')->name('fornecedor.store')->middleware('checklogin');
    //editar e deletar fornecedor
    $this->get('fornecedor/{id}/editar', 'FornecedorController@novo')->name('fornecedor.editar')->middleware('checklogin');
    $this->post('fornecedor/{id}/editar', 'FornecedorController@updatePost')->name('fornecedor.editar.salvar')->middleware('checklogin');
    $this->get('fornecedor/{id}/deletar', 'FornecedorController@delete')->name('fornecedor.deletar')->middleware('checklogin');


    $this->get('cliente', 'ClienteController@index')->name('cliente')->middleware('checklogin');
    $this->post('cliente/todos', 'ClienteController@todos')->name('cliente.todos')->middleware('checklogin');
    $this->any('cliente/PDF', 'ClienteController@gerarPDF')->name('cliente.pdf')->middleware('checklogin');
    $this->any('cliente/xlsx', 'ClienteController@gerarXLSX')->name('cliente.excel')->middleware('checklogin');
    $this->any('cliente/csv', 'ClienteController@gerarCSV')->name('cliente.csv')->middleware('checklogin');
    $this->get('cliente/novo', 'ClienteController@novo')->name('cliente.novo')->middleware('checklogin');
    $this->post('cliente/novo', 'ClienteController@store')->name('cliente.store')->middleware('checklogin');
    //editar e deletar fornecedor
    $this->get('cliente/{id}/editar', 'ClienteController@novo')->name('cliente.editar')->middleware('checklogin');
    $this->post('cliente/{id}/editar', 'ClienteController@updatePost')->name('cliente.editar.salvar')->middleware('checklogin');
    $this->get('cliente/{id}/deletar', 'ClienteController@delete')->name('cliente.deletar')->middleware('checklogin');


    $this->get('funcionario', 'FuncionarioController@index')->name('funcionario')->middleware('checklogin');
    $this->post('funcionario/todos', 'FuncionarioController@todos')->name('funcionario.todos')->middleware('checklogin');
    $this->any('funcionario/PDF', 'FuncionarioController@gerarPDF')->name('funcionario.pdf')->middleware('checklogin');
    $this->any('funcionario/xlsx', 'FuncionarioController@gerarXLSX')->name('funcionario.excel')->middleware('checklogin');
    $this->any('funcionario/csv', 'FuncionarioController@gerarCSV')->name('funcionario.csv')->middleware('checklogin');
    $this->get('funcionario/novo', 'FuncionarioController@novo')->name('funcionario.novo')->middleware('checklogin');
    $this->post('funcionario/novo', 'FuncionarioController@store')->name('funcionario.store')->middleware('checklogin');
    //editar e deletar funcionário
    $this->get('funcionario/{id}/editar', 'FuncionarioController@novo')->name('funcionario.editar')->middleware('checklogin');
    $this->post('funcionario/{id}/editar', 'FuncionarioController@updatePost')->name('funcionario.editar.salvar')->middleware('checklogin');
    $this->get('funcionario/{id}/endereco', 'FuncionarioController@endereco')->name('funcionario.endereco')->middleware('checklogin');
    $this->post('funcionario/{id}/endereco', 'FuncionarioController@updatePost')->name('funcionario.endereco.salvar')->middleware('checklogin');
    $this->get('funcionario/{id}/deletar', 'FuncionarioController@delete')->name('funcionario.deletar')->middleware('checklogin');



    $this->get('login', 'LoginController@index')->name('login');
    $this->post('login', 'LoginController@logar')->name('login.logar');
    $this->any('logout', 'LoginController@logout')->name('login.logout')->middleware('checklogin');

    

// });
//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');