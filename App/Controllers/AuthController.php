<?php
//Controller do JWT.

//Vai pegar os dados que o usuário enviar e irá dizer o que vai ser executado.

//namespace para diferenciar as classes.
namespace App\Controllers;

//ServerRequestInterface é uma interface do PSR7 usada pra induzir o tipo do Request ou seja o $request será um objeto de alguma classe que implementa essa interface.
use Psr\Http\Message\ServerRequestInterface as Request;

//Classe para implementar o Response para injeções de dependencias.
use Psr\Http\Message\ResponseInterface as Response;

//Para o usar o UsuarioDAO
use App\DAO\MYSQL\GerenciadorLojas\UsuariosDAO;

//TokensDAO
use App\DAO\MYSQL\GerenciadorLojas\TokensDAO;

//TokensModel
use App\Models\MYSQL\GerenciadorLojas\TokenModel;

//Firebase
use Firebase\JWT\JWT;

final class AuthController{
    public function login(Request $request, Response $response, array $args): Response{
        $data = $request->getParsedBody();
        //Pegar o email que foi enviado
        $email = $data['email'];
        //pegar a senha
        $senha = $data['senha'];
        
        //Definir tempo de expiração do token
        $expireDate = $data['expire_date'];
        
        //Passar o email para o DAO
        $usuariosDAO = new UsuariosDAO();
        $usuario = $usuariosDAO->getUserByEmail($email);

        //Se o usuário for nulo, irá retornar um status 401
        if(is_null($usuario))
            return $response->withStatus(401);
        //Se a senha passada não for igual a que tá no banco de dados retorna um status 401 não autorizado
        if(!password_verify($senha, $usuario->getSenha()))
            return $response->withStatus(401);

        //===========================TOKEN===============================
        //Criação do token com os dados enviados
        //dono(sub)id,tempo de duração do token(expired)
        $tokenPayload = [
            'id' => $usuario->getId(),
            'name' => $usuario->getNome(),
            'email' => $usuario->getEmail(),
            'expired_at' => $expireDate  
        ];
        //(new \DateTime())->modify('+2 days')->format('Y-m-d H:i:s')
        //Codifico o Token com a chave secreta
        //Token gerado com o contéudo e a chave secreta
        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));
        //Defino contéudo do meu refreshToken
        //'ramdom' uniqid para os tokens não serem muito parecidos.
        $refreshTokenPayload = ['email' => $usuario->getEmail(),'ramdom' => uniqid()];
        //Crio um token com a mesma chave secreta
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));
        //==============================TOKEN==========================================
        //Criar um modelo para poder usar o DAO do token createToken
        $tokenModel = new TokenModel();
        //Não precisa settar o id, ele vai ser automatico já.
        $tokenModel->setExpired_at($expireDate)
            ->setRefresh_token($refreshToken)
            ->setToken($token)
            ->setUsuarios_id($usuario->getId());
        
        //Salvar Token no banco
        //criar tokenDAO
        $tokensDAO = new TokensDAO();
        //Chamar o método para criar o Token que chama o tokenDAO e passa o $tokenModel para ele, salvando o token no banco de dados.
        $tokensDAO->createToken($tokenModel);
        
        //Retornar o token e o refresh token para o usuário
        //Construir um Json que vai ser a resposta
        $response = $response->withJson(["token" => $token, "refresh_token" => $refreshToken]);

        return $response;
    }
    //Função para o RefreshToken
    public function refreshToken(Request $request, Response $response, array $args): Response{
        $data = $request->getParsedBody();
        $refreshToken = $data['refresh_token'];
        $expireDate = $data['expire_date'];

        $refreshTokenDecoded = JWT::decode($refreshToken, getenv('JWT_SECRET_KEY'), ['HS256']);

        $tokensDAO = new TokensDAO();
        //Aqui verifica se o token existe
        $refreshTokenExists = $tokensDAO->verifyRefreshToken($refreshToken);
        //Se o token não existir ele retorna 401, se existir ele continua.
        if(!$refreshTokenExists)
            return $response->withStatus(401);
        
        //Reaproveitar o getEmail    
        $usuariosDAO = new UsuariosDAO();
        //->email = acessar como objeto
        $usuario = $usuariosDAO->getUserByEmail($refreshTokenDecoded->email);
        //Verificar se o usuario existe
        //se existe tranquilo, se não 401(não autorizado)
        if(is_null($usuario))
            return $response->withStatus(401);
        
        //$tokenPayload = ['id' => $usuario->getId(), 'email' => $usuario->getEmail(), 'ramdom' => uniqid()];
        
        $tokenPayload = ['sub' => $usuario->getId(),'name' => $usuario->getNome(),'email' => $usuario->getEmail(),'expired_at' => $expireDate];
        $token = JWT::encode($tokenPayload, getenv('JWT_SECRET_KEY'));
        $refreshTokenPayload = ['email' => $usuario->getEmail(),'ramdom' => uniqid()];
                
        
        $refreshToken = JWT::encode($refreshTokenPayload, getenv('JWT_SECRET_KEY'));

        $tokenModel = new TokenModel();
        $tokenModel->setExpired_at($expireDate)
            ->setRefresh_token($refreshToken)
            ->setToken($token)
            ->setUsuarios_id($usuario->getId());

        $tokensDAO = new TokensDAO();
        $tokensDAO->createToken($tokenModel);

        $response = $response->withJson(["token" => $token, "refresh_token" => $refreshToken]);
            
        return $response;    
    }

}