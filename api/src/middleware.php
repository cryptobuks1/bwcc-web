<?php

use Slim\App;

return function (App $app) {
    // e.g: $app->add(new \Slim\Csrf\Guard);
    $app->add(function ($request, $response, $next) {
    
        $key = $request->getQueryParam("key");
        $ref = json_encode($_SERVER);

        if(!isset($key)){
            return $response->withJson(["status" => "API Key required"], 401);
        }else{    
            $key_admin = "m3svkHTbtMPiuIHybgdjDjsW2hEE29YN";
            
            if($key == $key_admin){                
                $this->who_is_it = "admin";
                return $response = $next($request, $response);
                // return $response->withJson(["status" => "API Key Valid"], 200);
            }else{
                
                // cek apakah key user
                $sql = "SELECT * FROM user WHERE token=:token";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("token", $key);
                $stmt->execute();

                if($stmt->rowCount() == 1){
                    $this->who_is_it = "user";
                    return $response = $next($request, $response);
                }else{
                    return $response->withJson(["status" => "API Key Invalid"], 401);
                }                
            }
        }
    });
};
