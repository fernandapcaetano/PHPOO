<?php

namespace Caetano\Comercial\Infraestrutura\Persistencia;

use PDO;

 class CriadorConexao{

    public static function criarConexao(): PDO{

        try{
            $pdo = new PDO("mysql:host=127.0.0.1;dbname=bd_comercial","root","");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        }catch(\PDOException $e){
            echo"Erro: ". $e->getMessage();
            return $pdo;
        }
    }



 }