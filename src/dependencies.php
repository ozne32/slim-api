<?php

use Slim\App;
use Illuminate\Database\Capsule\Manager as Capsule;
return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };
    $container['db']=function($c){
        $capsule = new Capsule;
        $arr = $c->get('settings');//isso vai retornar tudo nós só queremos uma parte, ent
        $capsule->addConnection($arr['db']);
        // posso fazer desta form, porém tem como recuperar as coisas em settings.php
        // $capsule->addConnection([
        //     'driver'=>'mysql',
        //     'host'=>'localhost',
        //     'database'=> 'slim',
        //     'username'=>'root',
        //     'password'=>'',
        //     'charset'=>'utf8',
        //     'collation'=> 'uft8_unicode_ci',
        //     'prefix'=>''
        // ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    };
};
