<?php
if (PHP_SAPI != 'cli') {
	exit('Rodar via CLI');
}

require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/src/dependencies.php';
$container = $dependencies($app);

$db = $container->get('db');

$schema = $db->schema();
$tabela = 'produtos';

$schema->dropIfExists($tabela);

//Cria a tabela produtos
$schema->create($tabela, function($table) {

	$table->increments('id');
	$table->string('titulo', 100);
	$table->text('descricao');
	$table->decimal('preco', 11, 2);
	$table->string('fabricante', 60);
	$table->timestamps();
});

//preencher a tabela (insert) em produção isso não existe
$db->table($tabela)->insert([
	'titulo' => 'Smartphone Motorola',
	'descricao' => 'Moto G6 com android oreo 8.0',
	'preco' => 899.00,
	'fabricante' => 'Motorola',
	'created_at' => '2019-10-22',
	'updated_at' => '2019-10-22'
]);

$db->table($tabela)->insert([
	'titulo' => 'Iphone',
	'descricao' => 'X Cinza 64gb',
	'preco' => 4999.00,
	'fabricante' => 'Apple',
	'created_at' => '2020-10-01',
	'updated_at' => '2020-10-01'
]);

?>