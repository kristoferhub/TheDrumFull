<?php
//Todos os DAOS conecetam com o banco de dados, por isso será criado uma classe de conexão, para reaproveitamento do código.

//
namespace App\DAO\MYSQL\GerenciadorLojas;
// Classe abstrata para trabalhar com PDO, classe abstrata para reaproveitamento do código, pois LojasDAO e ProdutosDAO vão utilizar o banco de dados "gerenciador_de_lojas"
abstract class Conexao{
	//PDO -> É uma biblioteca de php para trabalhar com banco de dados voltado para orientação objeto.
	
	/**
	 * @var \PDO
	 */
	//Método protegido, permitindo que as classes que herdarem de "conexão.php", também usem o PDO
	protected $pdo;
	// Função construtora de conexão. 
	public function __construct(){
		//Pegar as informações dos putenv em globais.php
		$host = getenv('GERENCIADOR_DE_LOJAS_MYSQL_HOST');
		$port = getenv('GERENCIADOR_DE_LOJAS_MYSQL_PORT');
		$user = getenv('GERENCIADOR_DE_LOJAS_MYSQL_USER');
		$pass = getenv('GERENCIADOR_DE_LOJAS_MYSQL_PASSWORD');
		$dbname = getenv('GERENCIADOR_DE_LOJAS_MYSQL_DBNAME');

		// String que fará a conexão com o banco de dados.
		$conexaoBanco = "mysql:host={$host};dbname={$dbname};port={$port};charset=utf8";
		//Conexão com o Banco de dados mysql
		$this->pdo = new\PDO($conexaoBanco, $user);
		// Aqui vai ser para saber os erros na hora de acessar o banco e os erros das funções inserir,alterar,deletar e excluir.
		$this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
	}

}