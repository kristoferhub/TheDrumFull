<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class TratamentoDeErros{
    public function validar(Request $request, Response $response, array $args): Response{
        // try {
            //throw new TestException("Validando");
            //return $response->withJson(['msg' => 'Tudo certo!']);
        // } catch(\TesteException)
    }

}

