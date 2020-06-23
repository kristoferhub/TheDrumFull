<?php
//Aqui terá as rotas (requisições)

//"Use" para acessar a namespace, O slimConfiguration é uma função que está dentro do namespace source.
use function source\slimConfiguration;

//"Use" para acessar o Controllers, podendo ter acesso a classe ProdutoController 
use App\Controllers\ProdutoController;

//"Use" para acessar a classe LojaController
use App\Controllers\LojaController; //Sem isso os metodos get/post/put/delete não irão funcionar

//Para biblioteca tuupola
use Tuupola\Middleware\HttpBasicAuthentication;

//Para gerenciar o BasicAuth
use function source\basicAuth;

//jwtAuth
use function source\jwtAuth;

//Usar a o JWT
use App\Controllers\AuthController;

//Usar JwtAuth Middleware do tuupola
use Tuupola\Middleware\JwtAuthentication;

//Usar JwtAuth Middleware
use App\Middlewares\JwtDateTimeMiddleware;
//==============================ROTAS==================================================

//Criar um objeto na classe app do Slim e passar as configurações.
$app = new\Slim\App(slimConfiguration());

//Tratar execeções de erros.
$app->get('/TratamentoDeErros',ValidarErro::class.':validar');

//Rota para o login
$app->post('/login', AuthController::class . ':login');

//Rota para o refreshToken contendo o metodo refreshToken
$app->post('/refresh_token', AuthController::class . ':refreshToken');

//Teste JWT 
$app->get('/teste', function() { echo "Verificação concluida!"; })
    ->add(new JwtDateTimeMiddleware())
    ->add(jwtAuth());

// $app->get('/teste', function(){echo "Confirmação concluida!";})
//     ->add(function($request, $response, $next){
//         $token = $request->getAttribute('jwt');
//         var_dump($token);
//         $reponse = $next($request, $response);
//         return $response;
//     })    
//     ->add(new JwtAuthentication([
//         'secret'=>getenv('JWT_SECRET_KEY'),
//         'attribute'=>'jwt'
//     ])
// );    
    
//--------------------------------------------ROTAS PARA OS MÉTODOS(CRUD)----------------------------------------------------------

//As rotas irão acessar cada metodo de um controller.


//Aqui terão 8 rotas

//4 rotas iguais com metodos diferentes. get/post/put/delete
//Se for digitado a rota "loja"

//pegar os dados
//::class proprio do php que retorna uma string com o caminho completo.
$app->get('/loja', LojaController::class . ':getLojas')->add(basicAuth());
//inserir os dados 
$app->post('/loja', LojaController::class . ':insertLoja')->add(basicAuth());
//alterar os dados 
$app->put('/loja', LojaController::class . ':updateLoja')->add(basicAuth());
// para excluir 
$app->delete('/loja', LojaController::class . ':deleteLoja')->add(basicAuth());


//4 rotas iguais com metodos diferentes. get/post/put/delete
//Se for digitado a rota "produto"

//pegar os dados
//Aqui será pega a class ProdutoController e o metodo getProducts da classe.
$app->get('/produto', ProdutoController::class . ':getProdutos')->add(basicAuth());//Middleware basiAuth
//inserir os dados
$app->post('/produto', ProdutoController::class . ':insertProduto')->add(basicAuth());
//alterar os dados
$app->put('/produto', ProdutoController::class . ':updateProduto')->add(basicAuth());
// para excluir
$app->delete('/produto', ProdutoController::class . ':deleteProduto')->add(basicAuth());

//Digitando o namespace completo
//$app->get('/produto','\App\Controllers\ProductController:getProducts');
//--------------------------------------------ROTAS---------------------------------------------------------------

$app->run();