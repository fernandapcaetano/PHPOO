<?php
namespace Caetano\Comercial\Infraestrutura\Repositorio;
use Caetano\Comercial\Modelo\Produto;
use Caetano\Comercial\Dominio\Repositorio\RepositorioProdutos;
use Caetano\Comercial\Persistencia;
use PDO;

class PDORepositorioProduto implements RepositorioProdutos
{
    private PDO $conexao;
    public function __construct(PDO $conexao){
        $this->conexao = $conexao;
    }
    public function todosProdutos(): array{
        $sqlConsulta = "SELECT * FROM produto;";
        $stmt = $this->conexao->query($sqlConsulta);

        return $this->hidratarListaProdutos($stmt);
    }
    public function salvarProduto(Produto $produto):bool{
        if($produto->getIdProduto() ==  null){
            return $this->createProduto($produto);
        }
        return $this->updateProduto($produto);
    }
    public function createProduto(Produto $produto):bool{
        $sqlInsert = "INSERT INTO produto (nome_produto, preco_produto) VALUES (:nome,:preco);";
        $stmt = $this->conexao->prepare($sqlInsert);
        $stmt->bindValue(":nome", $produto->getNomeProduto(), PDO::PARAM_STR);
        $stmt->bindValue(":preco", $produto->getPrecoProduto(), PDO::PARAM_STR);
        $sucesso = $stmt->execute();

        if($sucesso){
            $produto->setIdProduto($this->conexao->lastInsertId());
        }
        return $sucesso;
    }
    public function readProduto(Produto $produto): array{
        $sqlConsulta = "SELECT * FROM produto WHERE id_produto = :id;";
        $stmt = $this->conexao->prepare($sqlConsulta);
        $stmt->bindValue(":id", $produto->getIdProduto(), PDO::PARAM_STR);
        $stmt->execute();

        return $this->hidratarListaProdutos($stmt);
    }
    public function updateProduto(Produto $produto):bool{
        $sqlUpdate = "UPDATE produto SET nome_produto = :nome, preco_produto = :preco WHERE id_produto = :id;";
        $stmt = $this->conexao->prepare($sqlUpdate);
        $stmt->bindValue(":nome", $produto->getNomeProduto(), PDO::PARAM_STR);
        $stmt->bindValue(":preco", $produto->getPrecoProduto(), PDO::PARAM_STR);
        $stmt->bindValue(":id", $produto->getIdProduto(), PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function deleteProduto(Produto $produto):bool{
        $stmt = $this->conexao->prepare("DELETE FROM produto WHERE id_produto = ?;");
        $stmt->bindValue(1 , $produto->getIdProduto(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function hidratarListaProdutos(\PDOStatement $stmt):array{
        $listaDadosProdutos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $listaProdutos = [];

        echo "<table>";
        foreach($listaDadosProdutos as $dadosProduto){
            $listaProdutos[] = new Produto(
            $dadosProduto['id_produto'],
            $dadosProduto['nome_produto'],
            $dadosProduto['preco_produto']
            );
            echo "
            <tr>
                <td  width = '20'>
                    {$dadosProduto['id_produto']}
                </td>
                <td>
                    {$dadosProduto['nome_produto']}
                </td width = '150'>
                <td align='right'>
                    ". number_format($dadosProduto["preco_produto"], 2,',', '.') .
                "</td>
            </tr>";
            echo "</table>";
        }
    return $listaProdutos;
    } 
}
