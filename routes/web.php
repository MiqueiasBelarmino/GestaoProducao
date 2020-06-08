<?php
//$this->group(['middleware' => ['auth']], function(){
    
    $this->any('historic-search', 'BalanceController@searchHistoric')->name('historic.search');

    $this->get('admin','AdminController@index')->name('admin.home');

    $this->get('/','AdminController@index')->name('admin.home');
    $this->get('cargo', 'CargoController@todos')->name('cargo.todos');
    $this->get('cargo/novo', 'CargoController@novo')->name('cargo.novo');
    $this->post('cargo/novo', 'CargoController@store')->name('cargo.store');

    $this->get('fornecedor', 'FornecedorController@todos')->name('fornecedor.todos');
    $this->get('fornecedor/novo', 'FornecedorController@novo')->name('fornecedor.novo');
    $this->post('fornecedor/novo', 'FornecedorController@store')->name('fornecedor.store');

    $this->get('funcionario', 'FuncionarioController@todos')->name('funcionario.todos');
    $this->get('funcionario/novo', 'FuncionarioController@novo')->name('funcionario.novo');
    $this->post('funcionario/novo', 'FuncionarioController@store')->name('funcionario.store');

//});
Auth::routes();