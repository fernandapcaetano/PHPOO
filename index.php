<?php

require_once 'Autoload.php';

use Caetano\Comercial\Infraestrutura\Persistencia\CriadorConexao;
use Caetano\Comercial\Infraestrutura\Repositorio\PDORepositorioProduto;    
use Caetano\Comercial\Modelo\Produto;  


echo "<pre>";
$repositorio = new PDORepositorioProduto(CriadorConexao::criarConexao());
var_dump($repositorio);

$produto1 = new Produto(NULL, "Tablet", 3000.00);
$produto2 = new Produto(NULL, "Notebook", 5000.00);
var_dump($produto1);


// $repositorio->salvarProduto($produto1);
// $repositorio->salvarProduto($produto2);
$produto0 = new Produto(2, "Tablet Samsung", 8000);
//$repositorio->updateProduto($produto0);
$repositorio->deleteProduto($produto0);
$repositorio->todosProdutos();

echo "</pre>";