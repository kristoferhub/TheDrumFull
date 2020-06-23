<?php
//Encapasulador para classes e funções.
namespace source;//talvez tenha erro

//Função para o slimConfiguration que vá mostrar mais claramente os erros do Slim.
function slimConfiguration(): \Slim\Container{
	//Criar array configuration para exibir os datalhes dos erros.
	$configuration = [
    	'settings' => [
        	'displayErrorDetails' => getenv('DISPLAY_ERROS_DATAILS'),
    	],
	];
	// \Slim\Container = classe do slim para passar as configurações.
	return  new \Slim\Container($configuration);
}
