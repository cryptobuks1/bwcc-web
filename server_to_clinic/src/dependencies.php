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

    // setting session type
    $container['who_is_it'] = "none";

    // setting db to pdo odbc
    $container['ms_access'] = function($c){
        $host = '127.0.0.1';
        $dbname = $_SERVER["DOCUMENT_ROOT"] . "\bwcc\data\bwcc.accdb";
        $username = '';
        $password = '';
        $charset = 'utf8';
        $collate = 'utf8_unicode_ci';
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => false,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES $charset COLLATE $collate"
        ];

        return new PDO($dsn, $username, $password, $options);
    };
};
