<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // $container['settings'] = [
    //         'displayErrorDetails' => true
    // ];

    // error handler
    $container['errorHandler'] = function ($c) {
        return function ($request, $response, $exception) use ($c) {
            $result = array(
                "message" => "Something went wrong?",
                "error" => $exception
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        };
    };
    
    $container['phpErrorHandler'] = function ($c) {
        return function ($request, $response, $error) use ($c) {
            $result = array(
                "message" => "Something went wrong!!"
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        };
    };

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

    //database connection to MYSQL
    $container['db'] = function ($c){
        $settings = $c->get('settings')['db'];
        $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'], $settings['user'], $settings['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    };    

    //database connection to MYSQL
    $container['antrian_db'] = function ($c){
        $settings = $c->get('settings')['antrian_db'];
        $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'], $settings['user'], $settings['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    };        

    //database connection to MYSQL
    $container['mdb_db'] = function ($c){
        $settings = $c->get('settings')['mdb_db'];
        $pdo = new PDO("mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbname'], $settings['user'], $settings['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    };  

    // setting session type
    $container['who_is_it'] = "none";

    // setting for email auth token
    // $container['mail_token'] = "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";
    $container['mail_token'] = "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";


};
