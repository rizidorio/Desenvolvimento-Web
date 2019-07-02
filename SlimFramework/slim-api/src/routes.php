<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$app->options('/{routes:.+}', function($request, $response, $ars) {
	return $response;
});

require __DIR__ . '/routes/autenticacao.php';

require __DIR__ . '/routes/produtos.php';

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
	$handler = $this->notFoundHandler;
	return $handler($req, $res);
});

?>
