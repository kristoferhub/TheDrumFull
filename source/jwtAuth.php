<?php
//Middleware do TUUPOLA
namespace source;

//Biblioteca do Tuupola
use Tuupola\Middleware\JwtAuthentication;
//Verifica se a chave secreta está correta dentro do TOKEN enviado
function jwtAuth(): JwtAuthentication{
    return new JwtAuthentication(['secret' => getenv('JWT_SECRET_KEY'), 'attribute' => 'jwt']);
}