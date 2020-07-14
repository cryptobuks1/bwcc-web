<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app){

    $container = $app->getContainer();

    $app->post('/data/pasien', function (Request $request, Response $response, array $args) use($container){
        if($this->who_is_it == "admin"){
            $container->get('logger')->info("Log DB Receive From Local '/data/pasien' route ");

            $json = $request->getParsedBody();

            // insert ke database                    
            $sql1 = "INSERT INTO bwcc_t01_pasien (id, nama, lahir_tempat, lahir_tgl, is_sent) VALUES (:id, :nama, :lahir_tempat, :lahir_tgl, null)";
            $stmt = $this->db->prepare($sql1);
            $stmt->bindParam("id",  $json["id"]);
            $stmt->bindParam("nama", $json['nama']);
            $stmt->bindParam("lahir_tempat", $json['lahir_tempat']);
            $stmt->bindParam("lahir_tgl", $json['lahir_tgl']);
            $stmt->execute();

            return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withJson(["status" => "Success", "data" => $json], 200);
            
        }else{
            $result = array(
                "message" => "welcome to BWCC API, need a help? please contact your administrator"
            );
            return $response->withJson(["status" => "Success", "data" => $result], 401);
        }

    });

    // DEFAULT ROUTE
    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {

        // check if it is admin 
        if($this->who_is_it == "admin"){
            $result = array(
                "message" => "welcome to BWCC Server API, Admin!"
            );
            return $response->withJson(["status" => "Success", "data" => $result], 200);
        }else{
            $result = array(
                "message" => "welcome to BWCC API, need a help? please contact your administrator"
            );
            return $response->withJson(["status" => "Success", "data" => $result], 401);
        }
        
    });


};


