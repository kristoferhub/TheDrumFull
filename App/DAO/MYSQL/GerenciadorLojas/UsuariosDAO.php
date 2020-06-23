<?php

namespace App\DAO\MYSQL\GerenciadorLojas;

// Para poder acessar o "LojaModel"
use App\Models\MYSQL\GerenciadorLojas\LojaModel;

//Conectar UsuarioModel
use App\Models\MYSQL\GerenciadorLojas\UsuarioModel;

//Criar classe que irá herdar "extends" da classe conexao em conexao.php, tornando possivel usar tudo que está presente dentro da classe conexao.
class UsuariosDAO extends Conexao{
	//Criar uma função construtora 
	public function __construct(){
		//execute também o construtor da classe pai(classe conexao), pois o construtor só é executado quando a classe é instanciada, e como o conexao não pode ser instanciado o construtor dela nunca vai ser executado.;
		//por isso se chama o parent construct.
		parent::__construct();
    }
    //Verificar se o email já existe retornando UsuarioModel
    // ?UsuarioModel = Ele pode retornar ou um usuário model ou um valor nulo caso não tenho encontrado nenhum usuário
    //Recebe um email
    public function getUserByEmail(string $email): ?UsuarioModel{
        $statement = $this->pdo
            ->prepare('SELECT id, nome, email, senha FROM usuarios WHERE email = :email');
        $statement->bindParam('email', $email);
        //executar a querry
        $statement->execute();
        $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);
        //Se ele encontro algum usuário, ele cria um usuárioModel e retorna ele
        if(count($usuarios) === 0)
            //Se não retorna um valor nulo
            return null;
        $usuario = new UsuarioModel();
        $usuario->setId($usuarios[0]['id'])
            ->setNome($usuarios[0]['nome'])
            ->setEmail($usuarios[0]['email'])
            ->setSenha($usuarios[0]['senha']);
        return $usuario;    
        //Se a quantidade de usuários for igual a zero, ele retorna um dado vazio. Se não ele irá retornar usuarios na posição 0.
        //return count($usuarios) === 0 ? [] :  $usuarios[0];
    }
}    