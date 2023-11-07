<?php
namespace Caetano\Comercial\Modelo;
require_once 'Autoload.php';

    class Funcionario extends Pessoa implements Autenticar{
        private string $cargo;
        private float $salario; 
        private string $senha;

        public function __construct(string $cargo, float $salario, string $nome, int $idade, Endereco $endereco){
            $this->cargo = $cargo;
            $this->salario = $salario;
            parent::__construct($nome, $idade, $endereco);//chamando construtor da classe mae
        }

    
	
        public function getCargo(): string {
            return $this->cargo;
        }
        
        
        public function setCargo(string $cargo): void{
            $this->cargo = $cargo;
        
        }
        
        
        public function getSalario(): float {
            return $this->salario;
        }
        
        
        public function setSalario(float $salario): void{
            $this->salario = $salario;
        
        }

        //usando metodo abstrato da classe mae
        public function setDesconto(): void{
            $this->desconto = 0.10;
        }

        public function login($nome, $senha): void{
            if ($this->nome === $nome && $this->senha === $senha){
                echo "Autenticado com sucesso";
            } else{
                echo "Autenticação incorreta";
            }
        }
        public function setSenha(string $senha): void{
            $this->senha = $senha;
        }

        public function __toString() : string{
            return "Nome: " . $this->getNome() .
                    "\nData de nascimento: ". $this->getCargo() .
                    "\nSalário: " . $this->getSalario();
        }
}