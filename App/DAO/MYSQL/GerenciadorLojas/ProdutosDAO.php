<?php

namespace App\DAO\MYSQL\GerenciadorLojas;

// Para poder acessar o "ProdutoModel"
use App\Models\MYSQL\GerenciadorLojas\ProdutoModel;

//Criar classe que irá herdar "extends" da classe conexao em conexao.php, tornando possivel usar tudo que está presente dentro da classe conexao.
class ProdutosDAO extends Conexao{
	//Criar uma função construtora 
	public function __construct(){
		//execute também o construtor da classe pai(classe conexao), pois o construtor só é executado quando a classe é instanciada, e como o conexao não pode ser instanciado o construtor dela nunca vai ser executado.
		//por isso se chama o parent construct.
		parent::__construct();
	}
	//função getProdutos
	public function getAllProdutosFromLoja(): array{
		//Através de uma query sql
		$produtos = $this->pdo->query('SELECT id,loja_id,nome,quantidade,preco FROM produtos;')->fetchAll(\PDO::FETCH_ASSOC);
		//talvez erro
		return $produtos;
	}
	//função getProdutos
	//public function getAllProdutosFromLoja(int $lojaId): array{
		//$statement = $this->pdo->prepare('SELECT * FROM produtos WHERE loja_id = :loja_id;');
		//$statement->bindParam(':loja_id', $lojaId, \PDO::PARAM_INT);
        //$statement->execute();
        //$produtos = $statement->fetchAll(\PDO::FETCH_ASSOC);
	//}
	public function insertProduto(ProdutoModel $produto): void{
		//Preparar um código SQL
		$statement = $this->pdo->prepare('INSERT INTO produtos VALUES(null,:loja_id,:nome,:preco,:quantidade);');
		$statement->execute(['loja_id'=>$produto->getLojaId(), 'nome'=>$produto->getNome(),'preco'=>$produto->getPreco(),'quantidade'=>$produto->getQuantidade()]);
	}
	//Update de produto
	public function updateProduto(ProdutoModel $produto): void{
		$statement = $this->pdo->prepare('UPDATE produtos SET loja_id = :loja_id, nome = :nome, preco = :preco, quantidade = :quantidade WHERE id = :id;');
		$statement->execute(['loja_id'=>$produto->getLojaId(), 'nome'=>$produto->getNome(),'preco'=>$produto->getPreco(),'quantidade'=>$produto->getQuantidade(),'id'=>$produto->getId()]);
	}
	//Delete de produto
	public function deleteProduto(int $id): void{
		$statement = $this->pdo->prepare('DELETE FROM produtos WHERE id = :id;'); //consultas
		$statement->execute(['id'=>$id]);
	}
}