<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Produto;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inserir', function () {
    $produto = new Produto();
    $produto->nome = "Garrafa";
    $produto->descricao = "Tupperware";
    $produto->imagem= "/images/vasilha.jpg";
    $produto->save();
    return redirect('/listar');

});

Route::get('/listar', function () {
    $produtos = Produto::all();
    foreach($produtos as $p){
    	echo "ID: $p->id<br>";
	    echo "Nome: $p->nome<br>";
	    echo "Descrição: $p->descricao<br>";
	    echo "Foto: $p->imagem<br>";
	}

});

Route::get('/detalhes/{id}', function ($id) {
    $p = Produto::find($id);
    	if (isset($p)){
    	echo "ID: $p->id<br>";
	    echo "Nome: $p->nome<br>";
	    echo "Descrição: $p->descricao<br>";
	    echo "Foto: $p->imagem<br>";
		}
		else {
			echo "Esse produto não existe";
		}
});

Route::get('/atualizar/{id}/{nome}', function ($id, $nome) {
    $p = Produto::find($id);
    if (isset($p)){
    	$p-> nome= $nome;
    	$p->save();
    	return redirect("/listar");
	}
	else {
			echo "Esse produto não existe";
		}

});

Route::get('/deletar/{id}', function ($id) {
    $p = Produto::find($id);
    if (isset($p)){
    	$p->delete();
    	return redirect("/listar");
	}
	else {
			echo "Esse produto não existe";
		}

});