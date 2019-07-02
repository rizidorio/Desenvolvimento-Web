<?php

use Slim\Http\Request;
use Slim\Http\Response;
Use App\Models\Produto;

//Routes
$app->group('/api/v1', function() {

	//listar produtos
	$this->get('/produtos/lista', function(Request $request, Response $response) {
		$produtos = Produto::get();
		return $response->withJson($produtos);
	});

	//adiciona um produto
	$this->post('/produtos/adiciona', function(Request $request, Response $response) {
		$dados = $request->getParsedBody();

		//validar

		$produto = Produto::create($dados);
		return $response->withJson($produto);
	});

	//recuperar produto por id
	$this->get('/produtos/lista/{id}', function(Request $request, Response $response, $args) {
		$produto = Produto::findOrFail($args['id']);
		return $response->withJson($produto);
	});

	//atualizar produto por id
	$this->put('/produtos/atualiza/{id}', function(Request $request, Response $response, $args) {
		$dados = $request->getParsedBody();
		$produto = Produto::findOrFail($args['id']);
		$produto->update($dados);
		return $response->withJson($produto);
	});

	//remove produto por id
	$this->get('/produtos/remove/{id}', function(Request $request, Response $response, $args) {
		$produto = Produto::findOrFail($args['id']);
		$produto->delete();
		return $response->withJson($produto);
	});

});