<?php

use Slim\App;

return function (App $app) {

    $app->add(function ($request, $response, $next) {
    
        $key = $request->getQueryParam("key");
        $ref = json_encode($_SERVER);

        if(!isset($key)){
            return $response->withJson(["status" => "API Key required"], 401);
        }else{    
            $key_admin = "9831284DD87E4779C56F2A9983669";
            
            if($key == $key_admin){                
                $this->who_is_it = "admin";
                return $response = $next($request, $response);
                // return $response->withJson(["status" => "API Key Valid"], 200);
            }else{    
                return $response->withJson(["status" => "API Key Invalid"], 401);
            }
        }
    });
};
