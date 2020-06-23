<?php
//Arquivo só  para gerenciar o BasicAuth
namespace source;

//Importar o BasicAuth
use Tuupola\Middleware\HttpBasicAuthentication;

function basicAuth(): HttpBasicAuthentication{
    return new HttpBasicAuthentication([
        "users" =>[
            "root" => "teste123"
        ]
    ]);
}