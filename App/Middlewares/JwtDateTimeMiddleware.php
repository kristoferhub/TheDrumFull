<?php

namespace App\Middlewares;

//ServerRequestInterface é uma interface do PSR7 usada pra induzir o tipo do Request ou seja o $request será um objeto de alguma classe que implementa essa interface.
use Psr\Http\Message\ServerRequestInterface as Request;

//Classe para implementar o Response para injeções de dependencias.
use Psr\Http\Message\ResponseInterface as Response;

//Pega o TOKEN e exibe na tela descriptografado
//Verifica data de expiração do token
final class JwtDateTimeMiddleware{
    public function __invoke(Request $request, Response $response, callable $next): Response{
        $token = $request->getAttribute('jwt');
        $expireDate = new \DateTime($token['expired_at']);
        $now = new \DateTime();
        //Retorna erro 401 se a data de expiração for menor que a data atual.
        if($expireDate < $now)
            return $response->withStatus(401);
        $response = $next($request, $response);
        return $response;
    }
}