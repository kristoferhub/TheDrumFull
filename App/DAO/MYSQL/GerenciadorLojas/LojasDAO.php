<?php

namespace App\DAO\MYSQL\GerenciadorLojas;

// Para poder acessar o "LojaModel"
use App\Models\MYSQL\GerenciadorLojas\LojaModel;

//Criar classe que irá herdar "extends" da classe conexao em conexao.php, tornando possivel usar tudo que está presente dentro da classe conexao.
class LojasDAO extends Conexao{
	//Criar uma função construtora 
	public function __construct(){
		//execute também o construtor da classe pai(classe conexao), pois o construtor só é executado quando a classe é instanciada, e como o conexao não pode ser instanciado o construtor dela nunca vai ser executado.;
		//por isso se chama o parent construct.
		parent::__construct();
	}
	//Funções para retornar todas as lojas, e irá retornar um array que vai ser um conjunto de lojas.
	// Irá capturar todas as lojas
	public function getAllLojas(): array{
		//Através de uma query sql
		$lojas = $this->pdo->query('SELECT id,nome,telefone,endereco FROM lojas;')->fetchAll(\PDO::FETCH_ASSOC);
		//talvez erro
		return $lojas;
	}
	//Não irá retornar nada por isso "void", irá apenas inserir uma nova loja no sistema.
	//$loja vai ser do tipo LojaModel que é a classe em LojaModel.php
	//Tudo que irá ser passado tá em LojaModel
	public function insertLoja(LojaModel $loja): void{
		//Preparar um código SQL
		$statement = $this->pdo->prepare('INSERT INTO lojas VALUES(null,:nome,:telefone,:endereco);');//consultas
		$statement->execute(['nome'=>$loja->getNome(),'telefone'=>$loja->getTelefone(),'endereco'=>$loja->getEndereco()]);
	}

	//Update de loja
	public function updateLoja(LojaModel $loja): void{
		$statement = $this->pdo->prepare('UPDATE lojas SET nome = :nome, telefone = :telefone, endereco = :endereco WHERE id = :id;');
		$statement->execute(['nome'=>$loja->getNome(),'telefone'=>$loja->getTelefone(),'endereco'=>$loja->getEndereco(),'id'=>$loja->getId()]);
	}
	//Delete de loja
	public function deleteLoja(int $id): void{
		$statement = $this->pdo->prepare('DELETE FROM lojas WHERE id = :id;'); //consultas
		$statement->execute(['id'=>$id]);
	}
}