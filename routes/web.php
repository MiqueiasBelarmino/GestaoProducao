<?php
//$this->group(['middleware' => ['auth']], function(){
    
    $this->any('historic-search', 'BalanceController@searchHistoric')->name('historic.search');

    $this->get('admin','AdminController@index')->name('admin.home');


    $this->get('cargo', 'CargoController@cargos')->name('cargo.cargos');
    $this->get('cargo/novo', 'CargoController@novo')->name('cargo.novo');
    $this->post('cargo/novo', 'CargoController@store')->name('cargo.store');

    $this->get('fornecedor', 'FornecedorController@fornecedores')->name('fornecedor.fornecedores');
    $this->get('fornecedor/novo', 'FornecedorController@novo')->name('fornecedor.novo');
    $this->post('fornecedor/novo', 'FornecedorController@store')->name('fornecedor.store');

//});


//Auth::routes();