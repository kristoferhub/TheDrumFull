<?php
//Vai pegar os dados que o usuário enviar e irá dizer o que vai ser executado.

//namespace para diferenciar as classes.
namespace App\Controllers;

//ServerRequestInterface é uma interface do PSR7 usada pra induzir o tipo do Request ou seja o $request será um objeto de alguma classe que implementa essa interface.
use Psr\Http\Message\ServerRequestInterface as Request;

//Classe para implementar o Response para injeções de dependencias.
use Psr\Http\Message\ResponseInterface as Response;

//Pegar ProdutosDAO.
use App\DAO\MYSQL\GerenciadorLojas\ProdutosDAO;

//Use para poder usar o ProdutosModel.
use App\Models\MYSQL\GerenciadorLojas\ProdutoModel;

//Use para poder usar o LojasDAO.
use App\DAO\MYSQL\GerenciadorLojas\LojasDAO;

//Use para poder usar o LojasModel.
use App\Models\MYSQL\GerenciadorLojas\LojaModel;

//Tá como classe final, pq ninguem vai herdar o ProdutoController.
final class ProdutoController{
    //metodo que irá retornar um Response
    //injeções de dependências
    //Indução de tipos :Response com php 7
	// public function getProdutos(Request $request, Response $response, array $args): Response{
	// 	$queryParams = $request->getQueryParams();
    //     $produtosDAO = new ProdutosDAO();
    //     $id = (int)$queryParams['loja_id'];
    //     $produtos = $produtosDAO->getAllProdutos($id);
    //     $response = $response->withJson($produtos);
	// 	return $response;

    // }
    //O método (getProdutos), os três parâmetros que eu passo por Slim, agora dentro de um método que está dentro de uma classe e ele irá me retornar o (Response)
    //Captura das informações do(s) Produto(s).
    public function getProdutos(Request $request, Response $response, array $args): Response{
    
        //Criação do objeto de DAO.
        $produtosDAO = new ProdutosDAO();
        //Recebe a função getAllLojas que é convertido para a estrutura de dados Json no (response).
        $produtos = $produtosDAO->getAllProdutosFromLoja();
        $response = $response->withJson($produtos);

        return $response;
    }

	public function insertProduto(Request $request, Response $response, array $args): Response{
		$data = $request->getParsedBody();
        
        $lojasDAO = new LojasDAO();
        $loja = $lojasDAO->buscarPorId($data['loja_id']['id']);
        
        $produto = new ProdutoModel(0,$loja,$data['nome'],(float)$data['preco'],(int)$data['quantidade']);
        $produtosDAO = new ProdutosDAO();

        
        //Como ele retorna ele mesmo "return this" em LojaModel, pode se acessar outros metodos novamente.
		// $produto->setLojaId((int)$data['loja_id'])
		// 	->setNome($data['nome'])
        //     ->setPreco((float)$data['preco'])
        //     ->setQuantidade((int)$data['quantidade']);
        $produtosDAO->insertProduto($produto);
        //Tudo baseado no que tá em Models restringindo o que vai enviar
		//definir o response
        $response = $response->withJson(['message' => 'Produto inserido com sucesso!']);
		
		return $response;

	}
	public function updateProduto(Request $request, Response $response, array $args): Response{
        $id = $args['id'];
        $data = $request->getParsedBody();

        $produtosDAO = new ProdutosDAO();
        //$produto = new ProdutoModel();
        $produto = new ProdutoModel((int)$id,(int)$data['loja_id'],$data['nome'],(float)$data['preco'],(int)$data['quantidade']);
		// $produto->setId((int)$data['id'])
		// 	->setLojaId((int)$data['loja_id'])
        //     ->setNome($data['nome'])
        //     ->setPreco((float)$data['preco'])
        //     ->setQuantidade((int)$data['quantidade']);
        $produtosDAO->updateProduto($produto);
		//definir o response
        $response = $response->withJson(['message' => 'Produto alterado com sucesso!']);
		
		return $response;

	}
	public function deleteProduto(Request $request, Response $response, array $args): Response{
		$queryParams = $request->getParsedBody();
        $produtosDAO = new ProdutosDAO();
        //$id = (int)$queryParams['id'];
        $id = $args['id'];
        $produtosDAO->deleteProduto($id);
		//definir o response
        $response = $response->withJson(['message' => 'Produto deletado com sucesso!']);
		
		return $response;

    }
    //Buscar por id
    public function buscarPorId(Request $request, Response $response, $args): Response{
        $id = $args['id'];

        $dao = new ProdutosDAO;
        $produto = $dao->buscarPorId($id);
        $response = $response->withJson($produto);
        return $response;
    }
}