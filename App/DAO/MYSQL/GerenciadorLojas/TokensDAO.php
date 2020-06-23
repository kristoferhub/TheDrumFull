<?php
//Salvar o Token no banco de dados


namespace App\DAO\MYSQL\GerenciadorLojas;

use App\Models\MYSQL\GerenciadorLojas\TokenModel;

class TokensDAO extends Conexao{
    public function __construct(){
        parent::__construct();
    }

    //Como ele só vai fazer uma inserção e não irá retornar nada ficara como VOID
    public function createToken(TokenModel $token): void{
        //Inserir no banco token
        $statement = $this->pdo
            ->prepare('INSERT INTO tokens
                (
                    token,
                    refresh_token,
                    expired_at,
                    usuarios_id
                )
                VALUES
                (
                    :token,
                    :refresh_token,
                    :expired_at,
                    :usuarios_id
                );
            ');
        $statement->execute(['token'=> $token->getToken(),'refresh_token'=>$token->getRefresh_token(),'expired_at'=>$token->getExpired_at(),'usuarios_id'=>$token->getUsuarios_id()]);


    }
    //Parte do refresh_token
    //Ver se o token existe na tabela de tokens
    //Retorna um valor booleano
    public function verifyRefreshToken(string $refreshToken): bool{
        
        $statement = $this->pdo ->prepare('SELECT id FROM tokens WHERE refresh_token = :refresh_token;');
        $statement->bindParam('refresh_token', $refreshToken);
        $statement->execute();
        $tokens = $statement->fetchAll(\PDO::FETCH_ASSOC);
        //Se for igual a 0 retorna falso que não existe, se não ele retorna true.
        //Se encontrar alguma coisa no banco ele retorna TRUE, caso não encontre nada ele retorna FALSE.
        return count($tokens) === 0 ? false : true;

    }
}

    