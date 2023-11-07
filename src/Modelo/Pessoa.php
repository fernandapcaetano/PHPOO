<?php
namespace Caetano\Comercial\Modelo;
abstract class Pessoa {
    protected string     $nome;
    protected int        $idade;
    protected static int $numeroDePessoas = 0; //atributo exclusivo da classe pessoa
    protected Endereco $endereco; //associacao pessoa tem um endereço
    protected float $desconto;

    public function __construct(string $nome, int $idade, Endereco $endereco) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->validaIdade($idade);
        $this->endereco = $endereco;
        self::$numeroDePessoas++;
        $this->setDesconto();
    }

    public function getNome(): string {
        return $this->nome;
    }
    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

	public function getIdade(): int {
		return $this->idade;
	}
	
	public function setIdade(int $idade): void {
		$this->idade = $idade;
	}
    public static function getNumeroDePessoas(): int {
		return self::$numeroDePessoas;
	}
    //MÉTODO ESPECÍFICO
    private function validaIdade(int $idade){
        if($this->idade > 0 && $this->idade < 120){
            $this->idade = $idade;
        }else{
            echo "Idade não permitida";
            exit;
        }
    }

    //metodo abstrato
    //polimorfismo - usando o mesmo método com funcoes diferentes - sobreescrita
    protected abstract function setDesconto(): void;

    public abstract function __toString() : string;

	
}