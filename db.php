<?php
// para garantir que só dá para rodar via terminal o banco de dados
if (PHP_SAPI != 'cli') {
        exit('rodar via CLI');
}
require __DIR__ . '/vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/src/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/src/dependencies.php';
$db = $container->get('db');
$schema = $db->schema();
$tabela = 'produtos';
$schema->dropIfExists($tabela);
$schema->create($tabela, function($table){
    $table->increments('id');
    $table->string('titulo', 100);
    $table->text('descricao');
    $table->decimal('preco', 11,2);
    $table->string('fabricante', 60);
    $table->timestamps();
});
$db->table($tabela)->insert([
    'titulo'=>'Smartphone Motorola Moto G6 32GB Dual Chip',
    'descricao'=>'Android Oreo - 8.0 Tela 5.7 octa-core',
    'preco'=> 899.00,
    'fabricante'=>'Motorola',
    'created_at'=>'2019-10-22',
    'updated_at'=>'2019-10-22'
]);
$db->table($tabela)->insert([
    'titulo'=>'Iphone X Cinza Espacial 64GB',
    'descricao'=>'Tela 5.8 IOS 12 4G wi-fi Câmera 12 MP - Apple',
    'preco'=> 4999.00,
    'fabricante'=>'Apple',
    'created_at'=>'2020-10-01',
    'updated_at'=>'2020-10-01'
]);