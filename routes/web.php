<?php
//$this->group(['middleware' => ['auth']], function(){

    $this->get('admin','AdminController@index')->name('admin.home');

    $this->get('/','AdminController@index')->name('admin.raiz');


    $this->get('cargo', 'CargoController@todos')->name('cargo.todos');
    $this->get('cargo/novo', 'CargoController@novo')->name('cargo.novo');
    $this->post('cargo/novo', 'CargoController@store')->name('cargo.store');
    //editar e deletar cargo
    $this->get('cargo/{id}/editar', 'CargoController@novo')->name('cargo.editar');
    $this->post('cargo/{id}/editar', 'CargoController@updatePost')->name('cargo.editar.salvar');
    $this->get('cargo/{id}/deletar', 'CargoController@delete')->name('cargo.deletar');



    $this->get('fornecedor', 'FornecedorController@todos')->name('fornecedor.todos');
    $this->get('fornecedor/novo', 'FornecedorController@novo')->name('fornecedor.novo');
    $this->post('fornecedor/novo', 'FornecedorController@store')->name('fornecedor.store');
    //editar e deletar fornecedor
    $this->get('fornecedor/{id}/editar', 'FornecedorController@novo')->name('fornecedor.editar');
    $this->post('fornecedor/{id}/editar', 'FornecedorController@updatePost')->name('fornecedor.editar.salvar');
    $this->get('fornecedor/{id}/deletar', 'FornecedorController@delete')->name('fornecedor.deletar');



    $this->get('funcionario', 'FuncionarioController@todos')->name('funcionario.todos');
    $this->get('funcionario/novo', 'FuncionarioController@novo')->name('funcionario.novo');
    $this->post('funcionario/novo', 'FuncionarioController@store')->name('funcionario.store');
    //editar e deletar funcionário
    $this->get('funcionario/{id}/editar', 'FuncionarioController@novo')->name('funcionario.editar');
    $this->post('funcionario/{id}/editar', 'FuncionarioController@updatePost')->name('funcionario.editar.salvar');
    $this->get('funcionario/{id}/deletar', 'FuncionarioController@delete')->name('funcionario.deletar');



    $this->get('login', 'LoginController@index')->name('login');
    $this->post('login', 'LoginController@logar')->name('login.logar');
    $this->any('logout', 'LoginController@logout')->name('login.logout');

    

//});
//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
