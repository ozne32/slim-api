<?php
// para garantir que só dá para rodar via terminal o banco de dados
// if (PHP_SAPI != 'cli') {
//         exit('rodar via CLI');
// }
require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';
print_r($container);
// $db = $container->get('db');
$schema = $db->schema();
$tabela = 'produtos';
$db->dropIfExists($tabela);
$schema->create($tabela, function($table){
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11,2);
    $table->string('fabricante', 60);
    $table->date('dt_criacao');
});