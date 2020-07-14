<?php
return [

    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'antrian-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],


        //database configuration
        'db' => [
            'host' => 'localhost',
            'dbname' => 'u6270128_bwcc',
            'user' => 'u6270128_bwcc',
            'pass' => 'bwcc123123A'
        ]
    ],
];
