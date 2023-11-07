<?php
namespace Caetano\Comercial\Dominio\Repositorio;
use Caetano\Comercial\Modelo\Produto;

interface RepositorioProdutos{
    public function todosProdutos():array;
    public function salvarProduto(Produto $produto):bool;
    public function createProduto(Produto $produto):bool;
    public function readProduto(Produto $produto):array;
    public function updateProduto(Produto $produto):bool;
    public function deleteProduto(Produto $produto):bool;
}