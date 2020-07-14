<?php
//namespace para diferenciar as classes.
namespace App\Controllers;

//ServerRequestInterface é uma interface do PSR7 usada pra induzir o tipo do Request ou seja o $request será um objeto de alguma classe que implementa essa interface.
use Psr\Http\Message\ServerRequestInterface as Request;

//Classe para implementar o Response para injeções de dependencias.
use Psr\Http\Message\ResponseInterface as Response;

//Use para poder usar o LojasDAO.
use App\DAO\MYSQL\GerenciadorLojas\LojasDAO;

//Use para poder usar o LojasModel.
use App\Models\MYSQL\GerenciadorLojas\LojaModel;

//Tá como classe final, pq ninguem vai herdar o LojaController.
final class LojaController{
    //Os parametros "(Request $request, Response $response, array $args)" sempre vão ser os mesmos.
    public function getLojas(Request $request, Response $response, array $args): Response{
        //Chamar o DAO lojasDAO
        //Criando um objeto de DAO
        $lojasDAO = new LojasDAO(); //new para criar um objeto de DAO
        $lojas = $lojasDAO->getAllLojas();
        //Converter para Json response
        $response = $response->withJson($lojas);//Lembrando que lojas é um array
        
        return $response;
    }
    //pegar o request(o que o usuário envio e passar para os parametros)
    public function insertLoja(Request $request, Response $response, array $args): Response{
        //Pegar os dados que o usuário vai passar(request)
        $data = $request->getParsedBody();
        
        $lojasDAO = new LojasDAO();
        $loja = new LojaModel(0,$data['nome'],$data['telefone'],$data['endereco']);
        //Como ele retorna ele mesmo "return this" em LojaModel, pode se acessar outros metodos novamente.
        // $loja->setNome($data['nome'])
        //     ->setEndereco($data['endereco'])
        //     ->setTelefone($data['telefone']);
        $lojasDAO->insertLoja($loja);
        //Tudo baseado no que tá em Models restringindo o que vai enviar
        $response = $response->withJson(['message' => 'Loja inserida com sucesso!']);
        return $response;
    }
    public function updateLoja(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        
        $data = $request->getParsedBody();

        $lojasDAO = new LojasDAO();
        $loja = new LojaModel((int)$id,$data['nome'],$data['telefone'],$data['endereco']);
        // $loja->setId((int)$data['id'])
        //     ->setNome($data['nome'])
        //     ->setEndereco($data['endereco'])
        //     ->setTelefone($data['telefone']);
        $lojasDAO->updateLoja($loja);

        $response = $response->withJson(['message' => 'Loja alterada com sucesso!']);
        return $response;
    }
    public function deleteLoja(Request $request, Response $response, array $args): Response{
        
        $queryParams = $request->getParsedBody();
        
        $lojasDAO = new LojasDAO();
        //$id = (int)$args['id'];
        //$id = (int)$queryParams['id'];
        $id = $args['id'];
        $lojasDAO->deleteLoja($id);

        $response = $response->withJson(['message' => 'Loja deletada com sucesso!']);
        return $response;
    }
    //BuscarId
    public function buscarPorId(Request $request, Response $response, $args): Response{
        $id = $args['id'];

        $dao = new LojasDAO;
        $loja = $dao->buscarPorId($id);
        $response = $response->withJson($loja);
        return $response;
        //return $response->withJson($loja);
    }
}