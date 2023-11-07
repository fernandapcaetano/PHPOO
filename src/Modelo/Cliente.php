<?php
namespace Caetano\Comercial\Modelo;
use Caetano\Comercial\Modelo\Endereco;
    class Cliente extends Pessoa 
    {
        private string $dataNascimento;
        private float $renda;

        public function __construct(string $dataNascimento,float $renda, string $nome, int $idade, Endereco $endereco){
            $this->dataNascimento = $dataNascimento;
            $this->renda = $renda;
            parent::__construct($nome, $idade, $endereco);//chamando construtor da classe mae
        }

        //usando metodo abstrato da classe mae
        public function setDesconto(): void{
            $this->desconto = 0.05;
        }

        public function __toString() : string{
            return "Nome: " . $this->getNome() .
                    "\nData de nascimento: ". $this->dataNascimento .
                    "\nSalário: " . $this->renda;
        }
    }
    