<?php
//Chamar o autoLoad no vendor onde fica instalados todas as bilbiotecas e frameworks, que o composer já trás. E o arquivo autoload que importa os frameworks como Slim.
require_once './vendor/autoload.php';

//Chamar as variáveis Globais de ambiente.

//Cuidado com o globaisgit
require_once './globais.php';

//Chamar as configurações do Slim.
require_once './source/slimConfiguration.php';

//Chamar a aplicação basicAuth.
require_once './source/basicAuth.php';

//Chamar o JWT
require_once './source/jwtAuth.php';

//Chamar as rotas que estão no index.php.
require_once './rotas/index.php';




