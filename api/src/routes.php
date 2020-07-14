<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;


return function (App $app){

    date_default_timezone_set("Asia/Jakarta");

    $container = $app->getContainer();

    // user/registration [POST] ok
    $app->post('/user/registration', function (Request $request, Response $response, array $args) use ($container) {
        // var form : 
        // 1. email,                    ok
        // 2. password,                 pending
        // 3. confirmation_password,    pending
        // 4. no_hp,                    ok
        // 5. nama                      ok

        // check is admin?
        if($this->who_is_it == "admin"){
            // check param request
            $user_param = $request->getParsedBody();

            if($user_param){

                // $is_valid = true;
                // list of error param
                $check_validata = "SELECT * FROM user WHERE email=:mail_check AND telp=:telp_check";
                $ex_check_validata = $this->antrian_db->prepare($check_validata);
                $ex_check_validata->bindParam("mail_check" , $user_param['email']);
                $ex_check_validata->bindParam("telp_check" , $user_param['no_hp']);
                $ex_check_validata->execute();

                $check_validata2 = "SELECT * FROM user WHERE email=:mail_check2";
                $ex_check_validata2 = $this->antrian_db->prepare($check_validata2);
                $ex_check_validata2->bindParam("mail_check2" , $user_param['email']);
                $ex_check_validata2->execute();

                $check_validata3 = "SELECT * FROM user WHERE telp=:telp_check2";
                $ex_check_validata3 = $this->antrian_db->prepare($check_validata3);
                $ex_check_validata3->bindParam("telp_check2" , $user_param['no_hp']);
                $ex_check_validata3->execute();

                if ($ex_check_validata->rowCount() == 0 && $ex_check_validata2->rowCount() == 0 && $ex_check_validata3->rowCount() == 0) {

                $sql1 = "INSERT INTO user (name, telp, email, password) VALUES (:name, :telp, :email, :password)";
                    $stmt = $this->antrian_db->prepare($sql1);
                    $stmt->bindParam("name", $user_param['nama']);
                    $stmt->bindParam("telp", $user_param['no_hp']);
                    $stmt->bindParam("email", $user_param['email']);
                    $stmt->bindValue("password", sha1($user_param['confirmation_password']));
                    $stmt->execute();

                    $registered_id = (int)$this->antrian_db->lastInsertId();

                    // create token for this user
                    $new_token = md5($user_param['email'].(string)$registered_id);
                    $sql2 = "INSERT INTO user (name, token, quota, email, user_id) VALUES (:name, :token, :quota, :email, :user_id)";
                    $stmt1 = $this->db->prepare($sql2);
                    $stmt1->bindParam("name", $user_param['nama']);
                    $stmt1->bindParam("token", $new_token);
                    $stmt1->bindParam("email", $user_param['email']);
                    $stmt1->bindValue("quota", 1);
                    $stmt1->bindParam("user_id", $registered_id);                    
                    $stmt1->execute();

                    // $registered_id = "OK";

                    // send mail welcome to user
                    $receipt_mail = $user_param['email']; 
                    // $mail_template = file_get_contents(__DIR__.'/templates/registrasi.php',FILE_USE_INCLUDE_PATH);
                    $mail_template = file_get_contents(__DIR__ . '/templates/email/registrasi.php');
                    $bearer_sendgrid = "authorization: Bearer ".$this->mail_token;
                    $mail_template = str_replace("[nama user]",$user_param['nama'],$mail_template);
                    $mail_template = str_replace("[nama]",$user_param['nama'],$mail_template);
                    $mail_template = str_replace("[email]",$user_param['email'],$mail_template);

                    // footer
                    $mail_template = str_replace("[Sender_Name]","BWCC",$mail_template);
                    $mail_template = str_replace("[Sender_Address]","Jalan Maleo Raya Blok JC 1 No. 6, Pd. Pucung, Kec. Pd. Aren",$mail_template);
                    $mail_template = str_replace("[Sender_City]","Kota Tangerang Selatan",$mail_template);
                    $mail_template = str_replace("[Sender_State]","Banten",$mail_template);
                    $mail_template = str_replace("[Sender_Zip]","15229",$mail_template);

                    $post_fields = array(
                        "personalizations" => [
                            array(
                                "to" => [
                                    array(
                                        "email" =>$receipt_mail
                                    )
                                ]
                            )
                        ],
                        "from" => array(
                            "email" => "administrator@bwcc.id"
                        ),
                        "subject" => "Selamat datang di BWCC",
                        "content" => [
                            array(
                                "type" => "text/html",
                                "value" => $mail_template
                            )
                        ]
                    );


                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => json_encode($post_fields),
                    CURLOPT_HTTPHEADER => array(
                        $bearer_sendgrid,
                        "content-type: application/json"
                    ),
                    ));

                    $response1 = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    $result = array(
                    "message" => "success created account",
                    "user_param" => $user_param,
                    "id_user" => $registered_id,
                    "token_user" => $new_token
                    );

                    return $response->withJson(["status" => "Success", "data" => $result], 200);
                }
                else
                {
                    $result = array(
                    "message" => "email/phone number already used",
                    );

                    return $response->withJson(["status" => "Error", "data" => $result], 200);
                }

            }else{
                $result = array(
                    "message" => "invalid param",
                );
                return $response->withJson(["status" => "Success", "data" => $result], 200);
            }

        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }

    });
    
    // user/password_reset [POST] ok
    $app->post('/user/reset_password', function (Request $request, Response $response, array $args) use ($container) {
        // var form : email

        if($this->who_is_it == "admin"){

            $user_param = $request->getParsedBody();
            $is_valid = true;
            $current_user = NULL;

            if(!isset($user_param['email'])){
                $is_valid = false;
            }else{
                // cek ke db apakah ada
                $sql = "SELECT * FROM user WHERE email=:email";
                $stmt = $this->antrian_db->prepare($sql);
                $stmt->bindParam("email", $user_param['email']);
                $stmt->execute();
                
                if($stmt->rowCount() != 1){
                    $is_valid = false;                    
                }else{
                    $current_user = $stmt->fetchAll()[0];
                }
            }

            if($is_valid == true){
                // create token 
                                
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < 8; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                $new_password = $randomString;
                $new_password_sha1 = sha1($new_password);

                // update hit
                $sql3 = "UPDATE user SET password=:password WHERE email=:email";
                $stmt = $this->antrian_db->prepare($sql3);
                $stmt->bindParam("password", $new_password_sha1);
                $stmt->bindParam("email", $user_param['email']);
                $stmt->execute();

                // send mail
                $receipt_mail = $user_param['email']; 
                // $url = "https://ngantriuy.sodaratech.com/user/makepassword/".$new_token;
                $bearer_sendgrid = "authorization: Bearer ".$this->mail_token;
                $mail_template = file_get_contents(__DIR__ . '/templates/email/reset_password.php');
                $mail_template = str_replace("[nama user]",$current_user['name'],$mail_template);
                $mail_template = str_replace("[password_baru]",$new_password,$mail_template);
                // $mail_template = str_replace("[email]",$user_param['email'],$mail_template);

                // footer
                $mail_template = str_replace("[Sender_Name]","BWCC",$mail_template);
                $mail_template = str_replace("[Sender_Address]","Jalan Maleo Raya Blok JC 1 No. 6, Pd. Pucung, Kec. Pd. Aren",$mail_template);
                $mail_template = str_replace("[Sender_City]","Kota Tangerang Selatan",$mail_template);
                $mail_template = str_replace("[Sender_State]","Banten",$mail_template);
                $mail_template = str_replace("[Sender_Zip]","15229",$mail_template);

                $post_fields = array(
                    "personalizations" => [
                        array(
                            "to" => [
                                array(
                                    "email" =>$receipt_mail
                                )
                            ]
                        )
                    ],
                    "from" => array(
                        "email" => "administrator@bwcc.id"
                    ),
                    "subject" => "Reset Password BWCC Mobile Apps",
                    "content" => [
                        array(
                            "type" => "text/html",
                            "value" => $mail_template
                        )
                    ]
                );


                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($post_fields),
                CURLOPT_HTTPHEADER => array(
                    $bearer_sendgrid,
                    "content-type: application/json"
                ),
                ));

                $response1 = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                $result = array(
                    "message" => "Sukses Membuat Password baru",
                    "data" => array(
                        "email" => $user_param['email'],
                        "send" => $response1
                    )
                );
                return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Success", "data" => $result], 200);
            }else{
                $result = array(
                    "message" => "Gagal Membuat Password",
                    "data" => array(
                        "email" => $user_param['email']
                    )
                );
                return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Failed", "data" => $result], 200);
            }
        }else{
            $result = array(
                "message" => "Invalid API"            
            );
            return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Failed", "data" => $result], 404);
        }                
    });

    // user/login [POST] ok
    $app->post('/user/login', function (Request $request, Response $response, array $args) use ($container) {
        // var form : email, password
        // check is admin?
        if($this->who_is_it == "admin"){
            // check param request
            $user_param = $request->getParsedBody();

            if($user_param){

                $is_valid = true;
                $error_param = [];


                // cek email
                if(!isset($user_param['email'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "email", "error" => "empty value"));

                }else if(!filter_var($user_param['email'], FILTER_VALIDATE_EMAIL)){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "email", "error" => "invalid email"));
                }

                // cek password
                if(!isset($user_param['password'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "password", "error" => "empty value"));
                }


                $current_token = "";
                $name = "";
                if($is_valid == true){
                
                    // cek ke database
                    $sql = "SELECT * FROM user WHERE email=:email AND password=:password";
                    $stmt = $this->antrian_db->prepare($sql);
                    $stmt->bindParam("email", $user_param['email']);
                    $stmt->bindValue("password", sha1($user_param['password']));
                    $stmt->execute();
                    
                    if($stmt->rowCount() != 1){
                        $is_valid = false;
                        array_push($error_param, array( "param" => "email/password", "error" => "email/password unavailable"));
                    }else{
                        $name = $stmt->fetchAll()[0]['name'];
                        $is_valid = true;
                        // get the token
                        $sql = "SELECT * FROM user WHERE email=:email";
                        $stmt = $this->db->prepare($sql);
                        $stmt->bindParam("email", $user_param['email']);
                        $stmt->execute();
                        $current_token = $stmt->fetchAll()[0]['token'];
                    }
                }

                $result = array(
                    "is_valid" => $is_valid,
                    "user_param" => array(
                        "email" => $user_param['email'],
                        "name" => $name
                        // ,"image_url" => "http://firebase.apits.sodaratech.com/image.php?text=".$name[0].$name[1]
                    ),
                    "error_param" => $error_param,
                    "token_user" => $current_token,
                    
                );

                if($is_valid == true){
                    return $response->withJson(["status" => "Success", "data" => $result], 200);
                }else{
                    return $response->withJson(["status" => "Error", "data" => array(
                        "message" => "Invalid Email/Password"
                    )], 200);
                }            
            }else{
                $result = array(
                    "message" => "invalid param",
                );
                return $response->withJson(["status" => "Success", "data" => $result], 200);
            }

        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });

    // user/change_password [POST]
    $app->post('/user/change_password', function (Request $request, Response $response, array $args) use ($container) {
        // var form : email

        if($this->who_is_it == "admin"){

            $user_param = $request->getParsedBody();
            $is_valid = true;
            $current_user = NULL;

            if(!isset($user_param['email'])){
                $is_valid = false;
            }else{
                // cek ke db apakah ada
                $sql = "SELECT * FROM user WHERE email=:email";
                $stmt = $this->antrian_db->prepare($sql);
                $stmt->bindParam("email", $user_param['email']);
                $stmt->execute();
                
                if($stmt->rowCount() != 1){
                    $is_valid = false;                    
                }else{
                    $current_user = $stmt->fetchAll()[0];
                }
            }

            if($is_valid == true){
                // create token 
                                
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < 8; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }

                $new_password = $randomString;
                $new_password_sha1 = sha1($new_password);

                // update hit
                $sql3 = "UPDATE user SET password=:password WHERE email=:email";
                $stmt = $this->antrian_db->prepare($sql3);
                $stmt->bindParam("password", $new_password_sha1);
                $stmt->bindParam("email", $user_param['email']);
                $stmt->execute();

                // send mail
                $receipt_mail = $user_param['email']; 
                // $url = "https://ngantriuy.sodaratech.com/user/makepassword/".$new_token;
                $bearer_sendgrid = "authorization: Bearer ".$this->mail_token;
                $mail_template = file_get_contents(__DIR__ . '/templates/email/reset_password.php');
                $mail_template = str_replace("[nama user]",$current_user['name'],$mail_template);
                $mail_template = str_replace("[password_baru]",$new_password,$mail_template);
                // $mail_template = str_replace("[email]",$user_param['email'],$mail_template);

                // footer
                $mail_template = str_replace("[Sender_Name]","BWCC",$mail_template);
                $mail_template = str_replace("[Sender_Address]","Jalan Maleo Raya Blok JC 1 No. 6, Pd. Pucung, Kec. Pd. Aren",$mail_template);
                $mail_template = str_replace("[Sender_City]","Kota Tangerang Selatan",$mail_template);
                $mail_template = str_replace("[Sender_State]","Banten",$mail_template);
                $mail_template = str_replace("[Sender_Zip]","15229",$mail_template);

                $post_fields = array(
                    "personalizations" => [
                        array(
                            "to" => [
                                array(
                                    "email" =>$receipt_mail
                                )
                            ]
                        )
                    ],
                    "from" => array(
                        "email" => "administrator@bwcc.id"
                    ),
                    "subject" => "Reset Password BWCC Mobile Apps",
                    "content" => [
                        array(
                            "type" => "text/html",
                            "value" => $mail_template
                        )
                    ]
                );


                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($post_fields),
                CURLOPT_HTTPHEADER => array(
                    $bearer_sendgrid,
                    "content-type: application/json"
                ),
                ));

                $response1 = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                $result = array(
                    "message" => "Sukses Membuat Password baru",
                    "data" => array(
                        "email" => $user_param['email'],
                        "send" => $response1
                    )
                );
                return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Success", "data" => $result], 200);
            }else{
                $result = array(
                    "message" => "Gagal Membuat Password",
                    "data" => array(
                        "email" => $user_param['email']
                    )
                );
                return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Failed", "data" => $result], 200);
            }
        }else{
            $result = array(
                "message" => "Invalid API"            
            );
            return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Failed", "data" => $result], 404);
        }                
    });

    
    // patient/list [GET]
    $app->get('/patient/list', function (Request $request, Response $response, array $args) use ($container) {
        // baca tokennya
        // var form : email, password
        // check is admin?
        if($this->who_is_it == "user"){
            // check param request
            $user_param = $request->getQueryParam("key");
            $result = [];
            if($user_param){
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud
                $key = $user_param;
                $sql = "SELECT * FROM user WHERE token=:token";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("token", $key);
                $stmt->execute();
                $user_id = $stmt->fetchAll()[0]['user_id'];

                if($user_id){
                    $sql1 = "SELECT * FROM patient WHERE created_by=:user_id AND is_deleted=0 ORDER BY created_at ASC";
                    $stmt1 = $this->antrian_db->prepare($sql1);
                    $stmt1->bindParam("user_id", $user_id);
                    $stmt1->execute();

                    if($stmt1->rowCount() > 0){
                        // detail patient, and handle if any null value or empty value
                        foreach($stmt1->fetchAll() as $patient){
                            array_push($result,
                                array(
                                    "pasien_id" => (!empty($patient['id']) ? $patient['id'] : "-"),
                                    "nama" => (!empty($patient['nama']) ? strtoupper($patient['nama']) : "-"),
                                    "jenis_kelamin" => (!empty($patient['jenis_kelamin']) ? strtoupper($patient['jenis_kelamin']) : "-"),
                                    "tanggal_lahir" => (!empty($patient['lahir_tanggal']) ? date('Y-m-d', $patient["lahir_tanggal"]) : "-")
                                )
                            );
                        }
                        return $response->withJson(["status" => "Success", "data" => $result], 200);
                    }
                    return $response->withJson(["status" => "Success", "data" => $result], 200);
                    
                }else{
                    // kalau kosong maka tampilkan kosong
                    return $response->withJson(["status" => "Success", "data" => $result], 200);    
                }                
            }else{
                return $response->withJson(["status" => "Error1", "data" => "invalid param"], 400);
            }
        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });

    // patient/{no patien} [GET] /details
    $app->get('/patient/details/{patient_id}', function (Request $request, Response $response, array $args) use ($container) {
        
        // check is user?
        if($this->who_is_it == "user"){
            // check param request
            $user_param = $request->getQueryParam("key");
            $result = [];
            if($user_param && $args['patient_id']){
                // check apakah patient tersebut punya si user
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud
                $key = $user_param;
                $sql = "SELECT * FROM user WHERE token=:token";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("token", $key);
                $stmt->execute();
                $user_id = $stmt->fetchAll()[0]['user_id'];

                if($user_id){
                    $sql1 = "SELECT * FROM patient WHERE created_by=:user_id AND id=:patient_id AND is_deleted=0";
                    $stmt1 = $this->antrian_db->prepare($sql1);
                    $stmt1->bindParam("user_id", $user_id);
                    $stmt1->bindParam("patient_id", $args['patient_id']);
                    $stmt1->execute();

                    if($stmt1->rowCount() == 1){
                        $patient = $stmt1->fetchAll()[0];
                        $result = array(
                            "pasien_id" => (!empty($patient['id']) ? $patient['id'] : "-"),
                            "kode_rm" => (!empty($patient['rm_id']) ? $patient['rm_id'] : "-"),
                            "nama" => (!empty($patient['nama']) ? strtoupper($patient['nama']) : "-"),
                            "jenis_kelamin" => (!empty($patient['jenis_kelamin']) ? strtoupper($patient['jenis_kelamin']) : "-"),
                            "jenis_pasien" => (!empty($patient['jenis']) ? strtoupper($patient['jenis']) : "-"),
                            "tempat_lahir" => (!empty($patient['lahir_tempat']) ? strtoupper($patient['lahir_tempat']) : "-"),
                            "tanggal_lahir" => (!empty($patient['lahir_tanggal']) ? date('Y-m-d', $patient["lahir_tanggal"]) : "-"),
                            "alamat" => (!empty($patient['alamat']) ? strtoupper($patient["alamat"]) : "-"),
                            "no_hp" => (!empty($patient['no_hp']) ? $patient["no_hp"] : "-"),
                            "email" => (!empty($patient['email']) ? $patient["email"] : "-"),
                            "jenis_pembayaran" => (!empty($patient['jenis_pembayaran']) ? strtoupper($patient["jenis_pembayaran"]) : "-")
                        );

                        return $response->withJson(["status" => "Success", "data" =>  $result], 200);
                    }else{
                        return $response->withJson(["status" => "Error", "data" => "invalid patient"], 400);
                    }                                    
                }else{
                    // kalau kosong maka tampilkan kosong
                    return $response->withJson(["status" => "Error", "data" => "invalid user"], 400);
                }
            }
        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });

    // patient/check [POST]
    $app->post('/patient/check', function (Request $request, Response $response, array $args) use ($container) {
        // cek apakah terdaftar sebagai pasien dg kode rm
        
        // check is user?
        if($this->who_is_it == "user"){
            // check param request
            $key = $request->getQueryParam("key");
            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){
                // check apakah patient tersebut punya si user
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud                

                $sql = "SELECT * FROM bwcc_t01_pasien WHERE id=:id AND lahir_tgl=:tgl_lahir";
                $stmt = $this->mdb_db->prepare($sql);
                $stmt->bindParam("id", $user_param['no_rm']);
                $stmt->bindValue("tgl_lahir", strtotime($user_param['tanggal_lahir'])-3600);
                $stmt->execute();
                // $res_rm = $stmt->fetchAll()[0];

                if($stmt->rowCount() == 1){
                    $re = $stmt->fetchAll()[0];
                    $result = array(
                        "kode_rm" => (!empty($re['id']) ? $re['id'] : "-"),
                        "nama" => (!empty($re['nama']) ? $re['nama'] : "-"),
                        "tempat_lahir" => (!empty($re['lahir_tempat']) ? $re['lahir_tempat'] : "-"),
                        "tanggal_lahir" => (!empty($re['lahir_tgl']) ? date('Y-m-d', $re["lahir_tgl"]) : "-")
                    );
            
                    return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Success", "data" => $result], 200);
                }else{
                    return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Success", "data" => null], 200);
                }
            }
        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Error", "data" => $result], 400);
        }
    });

    // patient/check [POST]
    $app->post('/patient/add/old', function (Request $request, Response $response, array $args) use ($container) {
        // cek apakah terdaftar sebagai pasien dg kode rm
        
        // check is user?
        if($this->who_is_it == "user"){
            // check param request
            $key = $request->getQueryParam("key");
            $sql3 = "SELECT * FROM user WHERE token=:token";
            $stmt3 = $this->db->prepare($sql3);
            $stmt3->bindParam("token", $key);
            $stmt3->execute();
            $user_id = $stmt3->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){
                // check apakah patient tersebut punya si user
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud                

                $sql = "SELECT * FROM bwcc_t01_pasien WHERE id=:id";
                $stmt = $this->mdb_db->prepare($sql);
                $stmt->bindParam("id", $user_param['no_rm']);
                $stmt->execute();
                $patient_is_valid = ($stmt->rowCount() == 1 ? true : false);            
                // $res_rm = $stmt->fetchAll()[0];

                //check di table e patient is used by someone?
                $sql1 = "SELECT * FROM patient WHERE rm_id=:rm_id";
                $stmt1 = $this->antrian_db->prepare($sql1);
                $stmt1->bindParam("rm_id", $user_param['no_rm']);
                $stmt1->execute();
                $patient_is_free = ($stmt1->rowCount() == 0 ? true : false);            

                if(($patient_is_valid == true) && ($patient_is_free == true)){
                    $patient_data_mdb = $stmt->fetchAll()[0];
                    // masukan data ke tabel pasien berdasarkan user tersebut
                    
                    // insert ke database                                        
                    $sql2 = "INSERT INTO patient (rm_id, nama, jenis,lahir_tempat,lahir_tanggal,alamat,no_hp,jenis_pembayaran ,created_by,is_deleted) VALUES (:rm_id, :nama, :jenis,:lahir_tempat,:lahir_tanggal,:alamat,:no_hp,:jenis_pembayaran,:created_by,:is_deleted)";
                    $stmt2 = $this->antrian_db->prepare($sql2);                    
                    $stmt2->bindParam("rm_id", $user_param['no_rm']);
                    $stmt2->bindParam("nama", $patient_data_mdb['nama']);
                    $stmt2->bindValue("jenis", "lama");
                    $stmt2->bindParam("lahir_tempat", $patient_data_mdb['lahir_tempat']);
                    $stmt2->bindParam("lahir_tanggal", $patient_data_mdb['lahir_tgl']);
                    $stmt2->bindParam("alamat", $user_param['alamat']);
                    $stmt2->bindParam("no_hp", $user_param['no_hp']);
                    $stmt2->bindParam("jenis_pembayaran", $user_param['jenis_pembayaran']);
                    $stmt2->bindParam("created_by", $user_id['user_id']);
                    $stmt2->bindValue("is_deleted", 0);
                    $stmt2->execute();

                    $registered_id = (int)$this->antrian_db->lastInsertId();
                    if($registered_id){
                        return $response->withJson(["status" => "Success", "data" => "sukses menambahkan pasien"], 200);
                    }else{
                        return $response->withJson(["status" => "Error", "data" => "paramer invalid"], 200);
                    }                    
                }else{
                    $error = "";
                    if(($patient_is_valid == true) && ($patient_is_free == false)){
                        $error = "PASIEN SUDAH TERDAFTAR DI USER LAIN";
                    }
                    if(($patient_is_valid == false) && ($patient_is_free == false)){
                        $error = "NO RM TIDAK VALID";
                    }
                    return $response->withJson(["status" => "Error", "data" => $error], 400);
                }
            }
        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });    

    // patient/rm/add [POST]
    // patient/rm/add [POST]
    $app->post('/patient/add/new', function (Request $request, Response $response, array $args) use ($container) {
        // cek apakah terdaftar sebagai pasien dg kode rm
        
        // check is user?
        if($this->who_is_it == "user"){
            // check param request
            $key = $request->getQueryParam("key");
            $sql1 = "SELECT * FROM user WHERE token=:token";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindParam("token", $key);
            $stmt1->execute();
            $user_id = $stmt1->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){
                // cek satu satu parameternya ada atau tidak
                $is_valid = true;
                // list of error param
                $error_param = [];

                // nama
                // 5. cek nama
                if(!isset($user_param['nama'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "nama", "error" => "empty value"));

                }else{
                    
                    if(preg_match("/^([a-zA-Z' ]+)$/",$user_param['nama']) == false){
                        $is_valid = false;
                        array_push($error_param, array( "param" => "nama", "error" => "consist of must be a-z A-Z"));
                    }
                }                
                // jenis_kelamin
                // laki-laki , perempuan
                if(!isset($user_param['jenis_kelamin'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "jenis_kelamin", "error" => "empty value"));

                }else{
                    if(!in_array($user_param['jenis_kelamin'], array('LK','PR'))){
                        $is_valid = false;
                        array_push($error_param, array( "param" => "jenis_kelamin", "error" => "harus LK atau PR"));
                    }
                }

                // jenis_pembayaran
                if(!isset($user_param['jenis_pembayaran'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "jenis_pembayaran", "error" => "empty value"));
                }

                // tanggal_lahir
                if(!isset($user_param['tanggal_lahir'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "tanggal_lahir", "error" => "empty value"));
                }
                // tempat_lahir
                if(!isset($user_param['tempat_lahir'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "tempat_lahir", "error" => "empty value"));
                }
                // alamat
                if(!isset($user_param['alamat'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "alamat", "error" => "empty value"));
                }
                // no_hp
                if(!isset($user_param['no_hp'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "no_hp", "error" => "empty value"));
                }

                // kalau valid semua baru input ke db
                // apabila seluruh parameter valid
                if($is_valid == true){

                    $sql3 = "SELECT * FROM patient WHERE nama=:nama AND created_by=:user_id";
                    $stmt3 = $this->antrian_db->prepare($sql3);
                    $stmt3->bindParam("nama", $user_param['nama']);
                    $stmt3->bindParam("user_id", $user_id['user_id']);
                    $stmt3->execute();
                    $patient_is_exist = ($stmt3->rowCount() > 0 ? true : false);

                    if($patient_is_exist) {
                        $result = array(
                            "message" => "Patient already exist."
                        );
                        return $response->withJson(["status" => "Error", "is_show_message" => TRUE, "data" => $result], 200);
                    }

                    $new_tgl_lahir = strtotime($user_param['tanggal_lahir']);
                    $sql2 = "INSERT INTO patient (nama, jenis_kelamin, jenis, lahir_tempat, lahir_tanggal, alamat, no_hp, email, jenis_pembayaran, created_by) VALUES (:nama, :jenis_kelamin, :jenis, :lahir_tempat, :lahir_tanggal, :alamat, :no_hp, :email, :jenis_pembayaran, :created_by) ";
                    $stmt2 = $this->antrian_db->prepare($sql2);
                    $stmt2->bindParam("nama", $user_param['nama']);
                    $stmt2->bindParam("jenis_kelamin", $user_param['jenis_kelamin']);
                    $stmt2->bindValue("jenis", "baru");
                    $stmt2->bindParam("lahir_tempat", $user_param['tempat_lahir']);
                    $stmt2->bindParam("lahir_tanggal", $new_tgl_lahir);
                    $stmt2->bindParam("alamat", $user_param['alamat']);
                    $stmt2->bindParam("no_hp", $user_param['no_hp']);
                    $stmt2->bindParam("email", $user_param['email']);
                    $stmt2->bindParam("jenis_pembayaran", $user_param['jenis_pembayaran']);
                    $stmt2->bindParam("created_by", $user_id['user_id']);
                    $stmt2->execute();

                    $registered_id = (int)$this->antrian_db->lastInsertId();
                    
                    if($registered_id){
                        $result = array(
                            "message" => "sukses menambahkan pasien"
                        );
                        return $response->withJson(["status" => "Success", "data" => $result], 200);
                    }else{
                        $result = array(
                            "message" => "parameter invalid",
                            "error" => $error_param
                        );
                        return $response->withJson(["status" => "Error", "data" => $result], 200);
                    }
                }else{
                    $result = array(
                        "message" => "parameter invalid",
                        "error" => $error_param
                    );
                    return $response->withJson(["status" => "Error", "data" => $result], 200);
                }
            }else{
                $result = array(
                    "message" => "Invalid Parameter",
                );
                return $response->withJson(["status" => "Error", "data" => $result], 400);
            }
        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });


    // patient/delete [POST]
    $app->post('/patient/delete', function (Request $request, Response $response, array $args) use ($container) {
        // check is user?
        if($this->who_is_it == "user"){
            // check param request
            $key = $request->getQueryParam("key");
            $sql3 = "SELECT * FROM user WHERE token=:token";
            $stmt3 = $this->db->prepare($sql3);
            $stmt3->bindParam("token", $key);
            $stmt3->execute();
            $user = $stmt3->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){              

                //check di table e patient is used by someone?
                $sql1 = "SELECT * FROM patient WHERE id=:id AND created_by=:user_id";
                $stmt1 = $this->antrian_db->prepare($sql1);
                $stmt1->bindParam("id", $user_param['pasien_id']);
                $stmt1->bindParam("user_id", $user['user_id']);
                $stmt1->execute();
                $patient_is_valid = ($stmt1->rowCount() == 1 ? true : false);            
                $patient_is_none = ($stmt1->rowCount() == 0 ? true : false);   

                if($patient_is_valid == true){                    
                    $sql2 = "DELETE FROM patient WHERE id=:id";                      
                    $stmt2 = $this->antrian_db->prepare($sql2);
                    $stmt2->bindParam("id", $user_param['pasien_id']);
                    $stmt2->execute();
                    return $response->withJson(["status" => "Success", "data" => "sukses hapus pasien"], 200);

                    // if($error == ""){
                    //     
                    // }else{
                    //     return $response->withJson(["status" => "Error", "data" => "delete process failed"], 400);
                    // }
                }else{
                    $error = "PASIEN BUKAN MILIK ANDA";                    
                    if($patient_is_none){
                        $error = "NOMOR PASIEN TIDAK TERDAFTAR";                    
                    }                    
                    return $response->withJson(["status" => "Error", "data" => $error], 400);
                }
            }
        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });    

    // patient/edit [POST]
    $app->post('/patient/edit', function (Request $request, Response $response, array $args) use ($container) {
        // check is user?
        if($this->who_is_it == "user"){
            // check param request
            $key = $request->getQueryParam("key");
            $sql3 = "SELECT * FROM user WHERE token=:token";
            $stmt3 = $this->db->prepare($sql3);
            $stmt3->bindParam("token", $key);
            $stmt3->execute();
            $user = $stmt3->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){              
                $new_tgl_lahir = strtotime($user_param['lahir_tanggal']);
                
                //check di table e patient is used by someone?
                $sql1 = "SELECT * FROM patient WHERE id=:id AND created_by=:user_id";
                $stmt1 = $this->antrian_db->prepare($sql1);
                $stmt1->bindParam("id", $user_param['pasien_id']);
                $stmt1->bindParam("user_id", $user['user_id']);
                $stmt1->execute();
                $patient_is_valid = ($stmt1->rowCount() == 1 ? true : false);            
                $patient_is_none = ($stmt1->rowCount() == 0 ? true : false);   

                if($patient_is_valid == true){  
                    $patient_existing = $stmt1->fetchAll()[0];
                    if(strtolower(trim($patient_existing['nama'])) != strtolower(trim($user_param['nama']))) {
                        $sql3 = "SELECT * FROM patient WHERE nama=:nama AND created_by=:user_id";
                        $stmt3 = $this->antrian_db->prepare($sql3);
                        $stmt3->bindParam("nama", $user_param['nama']);
                        $stmt3->bindParam("user_id", $user['user_id']);
                        $stmt3->execute();
                        $patient_is_exist = ($stmt3->rowCount() > 0 ? true : false);

                        if($patient_is_exist) {
                            return $response->withJson(["status" => "Error", "is_show_message" => TRUE, "data" => "Patient already exist."], 200);
                        }
                    }

                    $sql2 = "UPDATE patient SET nama=:nama, jenis_kelamin=:jenis_kelamin, lahir_tempat=:lahir_tempat, lahir_tanggal=:lahir_tanggal, alamat=:alamat, no_hp=:no_hp, email=:email, jenis_pembayaran=:jenis_pembayaran WHERE id=:id";                      
                    $stmt2 = $this->antrian_db->prepare($sql2);
                    $stmt2->bindParam("id", $user_param['pasien_id']);
                    $stmt2->bindParam("nama", $user_param['nama']);
                    $stmt2->bindParam("jenis_kelamin", $user_param['jenis_kelamin']);
                    $stmt2->bindParam("lahir_tempat", $user_param['lahir_tempat']);
                    $stmt2->bindParam("lahir_tanggal", $new_tgl_lahir);
                    $stmt2->bindParam("alamat", $user_param['alamat']);
                    $stmt2->bindParam("no_hp", $user_param['no_hp']);
                    $stmt2->bindParam("email", $user_param['email']);
                    $stmt2->bindParam("jenis_pembayaran", $user_param['jenis_pembayaran']);
                    $stmt2->execute();
                    return $response->withJson(["status" => "Success", "data" => "sukses mengubah pasien"], 200);

                    // if($error == ""){
                    //     
                    // }else{
                    //     return $response->withJson(["status" => "Error", "data" => "delete process failed"], 400);
                    // }
                }else{
                    $error = "PASIEN BUKAN MILIK ANDA";                    
                    if($patient_is_none){
                        $error = "NOMOR PASIEN TIDAK TERDAFTAR";                    
                    }                    
                    return $response->withJson(["status" => "Error", "data" => $error], 400);
                }
            }
        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });   

    $app->get('/doctor/status', function (Request $request, Response $response, array $args) use ($container){
        
        // check is admin?
        if($this->who_is_it == "user"){
            $min_count = -1;
            // initiate param
            $schedules = array();
            // get poly name
            $poly_query = $this->antrian_db->prepare("SELECT id, poly_code, name, id_specialist FROM master_poly WHERE is_deleted=0");
            $poly_query->execute();
            $polys = $poly_query->fetchAll();

            // get list doctors
            $doctor_query = $this->antrian_db->prepare("SELECT id, id_specialist, name , image , experience FROM master_doctor WHERE is_deleted=0");
            $doctor_query->execute();
            $doctors = $doctor_query->fetchAll();

            // get all specialist
            $specialist_query = $this->antrian_db->prepare("SELECT * FROM master_specialist WHERE is_deleted=0");
            $specialist_query->execute();
            $specialists = $specialist_query->fetchAll();

            foreach($polys as $poly){
                $list_doctors = array();

                foreach($doctors as $item_doctors){
                    if($item_doctors['id_specialist'] == $poly['id_specialist']){

                        $array_schedules = array();

                        //get list schedule
                        $tgl_sekarang = "";
                        $tgl_seminggu = "";
                        $currentdatenow = date('Y-m-d H:i:s');

                        $listschedule_query = $this->antrian_db->prepare("SELECT * FROM master_practice_schedule WHERE id_doctor=:id_doctor AND id_poly=:id_poly AND date > :getcurdate GROUP BY date ORDER BY date ASC");
                        $listschedule_query->bindParam("id_doctor", $item_doctors['id']);
                        $listschedule_query->bindParam("id_poly", $poly['id']);
                        $listschedule_query->bindParam("getcurdate", $currentdatenow);                     
                        $listschedule_query->execute();
                        $listschedules = $listschedule_query->fetchAll();      

                        $list_hari = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];
                        $list_hari_angka = [1, 2, 3, 4, 5, 6, 7];
                        
                        if(count($listschedules) > $min_count){
                        foreach($listschedules as $val_listschedules) {

                        $listschedule_query2 = $this->antrian_db->prepare("SELECT * FROM master_practice_schedule WHERE id_doctor=:id_doctor AND id_poly=:id_poly AND date = :dateselected ORDER BY start_time_service ASC");
                        $listschedule_query2->bindParam("id_doctor", $item_doctors['id']);
                        $listschedule_query2->bindParam("id_poly", $poly['id']);
                        $listschedule_query2->bindParam("dateselected", $val_listschedules['date']);                     
                        $listschedule_query2->execute();
                        $listschedules2 = $listschedule_query2->fetchAll()[0];

                        $listschedule_query3 = $this->antrian_db->prepare("SELECT * FROM master_practice_schedule WHERE id_doctor=:id_doctor AND id_poly=:id_poly AND date = :dateselected ORDER BY finish_time_service DESC");
                        $listschedule_query3->bindParam("id_doctor", $item_doctors['id']);
                        $listschedule_query3->bindParam("id_poly", $poly['id']);
                        $listschedule_query3->bindParam("dateselected", $val_listschedules['date']);                     
                        $listschedule_query3->execute();
                        $listschedules3 = $listschedule_query3->fetchAll()[0];

                        if (empty($val_listschedules['patient_id'])) {
                            $status_book_doctor = 'available';

                            array_push($array_schedules,
                                    array(
                                        "day"  => $list_hari[$val_listschedules['day']],
                                        "date"=> date('d-m-Y', strtotime($val_listschedules['date'])),
                                        "hour" => (string)date('H:i', strtotime($listschedules2['start_time_service']))."-".(string)date('H:i', strtotime($listschedules3['finish_time_service'])),
                                        "status" => $status_book_doctor
                                    )                                
                                );
                        }
                        else
                        {
                            $status_book_doctor = 'booked';
                        }
                        
                        
                        
                            }
                        }
                 

                        $specialist_name = "";
                        foreach($specialists as $item_specialist){
                            if($item_specialist['id'] == $item_doctors['id_specialist']){
                                $specialist_name = $item_specialist['name'];
                            }
                        }

                        if(count($array_schedules) > $min_count){
                            array_push($list_doctors,
                                array(
                                    "name" => $item_doctors['name'],
                                    "specialist"=> $specialist_name,
                                    "image_url" =>  'http://bwcc.inovasialfatih.com/admin/'.$item_doctors['image'],
                                    "experience" => $item_doctors['experience'],
                                    "schedule" => $array_schedules
                                )                                
                            );
                        }

                    }else{
                        $a = 10;
                    }
                
                }

                if(count($list_doctors) > $min_count){
                    array_push(
                        $schedules, array(
                            "poly_id" => $poly['id'],
                            "poly_name" => $poly['name'],
                            "doctors" => $list_doctors
                        )
                    );
                }
            }                   

            $result = array(
                "message" => "yes",
                // "schedule" => $schedules
                "schedule" => $schedules
            );

            return $response->withJson(["status" => "Success", "data" => $result], 200);
        }else{
            $schedules = NULL;
            $result = array(
                "message" => "no",
                "schedule" => $schedules
            );

            return $response->withJson(["status" => "Failed", "data" => $result], 200);
        }
    });

    
    // GET Booking Available Schedule
    // By Current Date
    $app->get('/booking/get_schedule', function (Request $request, Response $response, array $args) use($container){
        // check is admin?
        if($this->who_is_it == "user"){
            ini_set('date.timezone', 'Asia/Jakarta');
            // GET FROM SHEDULE PRACTICE TABLE
            $schedules = [];
            $days_name = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];
            $days = array();
            $days_total = 7;            
            $current_day = strtotime(date("l"));
            array_push($days,date('Y-m-d', strtotime(date("l"))));

            // all available poly
            $sql_poly = "SELECT * FROM master_poly";
            $run_poly = $this->antrian_db->prepare($sql_poly);
            $run_poly->execute();
            $all_poly = $run_poly->fetchAll();

            // all available poly_doctor
            $sql_doctor = "SELECT * FROM master_doctor";
            $run_doctor = $this->antrian_db->prepare($sql_doctor);
            $run_doctor->execute();
            $all_doctor = $run_doctor->fetchAll();

            $i = 1;
            while($i < $days_total){
                array_push(
                    $days,
                    date('Y-m-d', strtotime("+".(string)$i." day", strtotime(date("l"))))
                );
                $i=$i+1;
            }
            $pos = 0;


            foreach($days as $c_day){
                // all available schedule
                $sql = "SELECT * FROM master_practice_schedule WHERE patient_id IS NULL AND date=:date_start ORDER BY date ASC";            
                $stmt = $this->antrian_db->prepare($sql);
                $stmt->bindParam("date_start", $c_day);
                $stmt->execute();
                $all_schedule = $stmt->fetchAll();
                $day_schedule = array();

                // list poly
                // cek per poly
                foreach($all_poly as $poly){
                    foreach($all_schedule as $schedule){
                        if($schedule['id_poly'] == $poly['id']){
                            $c_doctor = null;
                            foreach($all_doctor as $doctor){
                                if($doctor['id'] == $schedule['id_doctor']){
                                    $c_doctor = $doctor;
                                }
                            }
                                                        
                            array_push($day_schedule, array(
                                "id" => $schedule['id'],
                                "id_poly" => $poly['id'],
                                "poly_code" => $poly['poly_code'],
                                "poly_name" => $poly['name']." (".(string)$schedule['start_time_service']."-".(string)$schedule['finish_time_service'].")",
                                // "poly_name" => $poly['name']." (".(string)$new_start."-".(string)$new_finish.")",
                                "doctor" => $c_doctor['name'],
                                "status" => (empty($schedule['patient_id']) ? "available" : "booked")
                                //"quota_remain" => $schedule['quota_online']
                            ));
                        }
                    }
                }                        

                if(count($all_schedule) > 0){
                    array_push($schedules, array(
                        "day" => array(
                            "day" => $days_name[$pos],
                            "date" => $c_day
                        ),
                        "schedule" => $day_schedule
                    ));
                }
                $pos = $pos+1;
            }            
            
            $result = array(
                "result" => $schedules
            );
            return $response->withJson(["status" => "Success", "data" => $result], 200);


        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });    

        $app->get('/booking/get_schedule1', function (Request $request, Response $response, array $args) use($container){
        // check is admin?
        if($this->who_is_it == "user"){
            ini_set('date.timezone', 'Asia/Jakarta');
            // GET FROM SHEDULE PRACTICE TABLE
            $schedules = [];
            $days_name = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu" , "senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu" , "senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu" , "senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu" , "senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];
            $days = array();
            $days_total = 30;            
            $current_day = strtotime(date("l"));
            array_push($days,date('Y-m-d', strtotime(date("l"))));

            // all available poly
            $sql_poly = "SELECT * FROM master_poly";
            $run_poly = $this->antrian_db->prepare($sql_poly);
            $run_poly->execute();
            $all_poly = $run_poly->fetchAll();

            // all available poly_doctor
            $sql_doctor = "SELECT * FROM master_doctor";
            $run_doctor = $this->antrian_db->prepare($sql_doctor);
            $run_doctor->execute();
            $all_doctor = $run_doctor->fetchAll();

            $i = 1;
            while($i < $days_total){
                array_push(
                    $days,
                    date('Y-m-d', strtotime("+".(string)$i." day", strtotime(date("l"))))
                );
                $i=$i+1;
            }
            $pos = 0;


            foreach($days as $c_day){
                
                // all available schedule
                $sql = "SELECT * FROM master_practice_schedule WHERE date=:date_start AND is_active = 1 ORDER BY date, start_time_service ASC";
                $stmt = $this->antrian_db->prepare($sql);
                $stmt->bindParam("date_start", $c_day);
                $stmt->execute();

                $all_schedule = $stmt->fetchAll();
                $day_schedule = array();

                // list poly
                // cek per poly
                foreach($all_poly as $poly){
                    $poly_doctor = [];
                    $list_doctor = [];
                    
                    foreach($all_doctor as $doctor){   
                        $detail_doctor = array();                                             

                        $sql1 = "SELECT * FROM master_practice_schedule WHERE date=:date_start AND id_poly=:id_poly AND id_doctor=:id_doctor AND is_active = 1 ORDER BY date, start_time_service ASC";
                        $stmt1 = $this->antrian_db->prepare($sql1);
                        $stmt1->bindParam("date_start", $c_day);
                        $stmt1->bindParam("id_poly", $poly['id']);
                        $stmt1->bindParam("id_doctor", $doctor['id']);
                        // var_dump($doctor['id']);
                        $stmt1->execute();
                        $q_schedule = $stmt1->fetchAll();
                        $total_schedule = count($q_schedule);
                       
                        if($total_schedule > 0){
                            $list_schedule_doctor = array();

                            $first_time_doctor = '';
                            $last_time_doctor = '';
                            $i = 0;
                            foreach($q_schedule as $d_schedule){
                                if ($d_schedule['is_book'] == 1) {
                                    # code...
                                }
                                else
                                {
                                    array_push($list_schedule_doctor, array(
                                            "schedule_id" => $d_schedule['id'],
                                            "time" => (string)date('H:i', strtotime($d_schedule['start_time_service']))."-".(string)date('H:i', strtotime($d_schedule['finish_time_service'])),
                                            "status" => (empty($d_schedule['patient_id']) ? "available" : "booked"),
                                            "queue_number" => $d_schedule['queue_number']
                                        )
                                    );
                                }
                                
                                if($i == 0)
                                    $first_time_doctor = (string)date('H:i', strtotime($d_schedule['start_time_service']));
                                if($i == count($q_schedule)-1)
                                    $last_time_doctor = (string)date('H:i', strtotime($d_schedule['finish_time_service']));
                                $i++;
                            }

    
                            array_push(
                                $list_doctor, array(
                                    "doctor" => array(
                                        "name" => $doctor['name'].' ('.$first_time_doctor.'-'.$last_time_doctor.')',
                                        "id" => $doctor['id']
                                    ),
                                    "schedule" => $list_schedule_doctor
                                )
                            );
                        }
                    }



                    // foreach($all_schedule as $schedule){
                    //     if($schedule['id_poly'] == $poly['id']){
                    //         $c_doctor = null;
                    //         foreach($all_doctor as $doctor){
                    //             $doctor_schedule = array();
                    //             if($doctor['id'] == $schedule['id_doctor']){
                    //                 $c_doctor = $doctor;
                    //             }


                    //         }
                                                        
                    //         array_push($schedule_poly, array(
                    //             "id" => $schedule['id'],
                    //             "id_poly" => $poly['id'],
                    //             "poly_code" => $poly['poly_code'],
                    //             "poly_name" => $poly['name']." (".(string)$schedule['start_time_service']."-".(string)$schedule['finish_time_service'].")",
                    //             // "poly_name" => $poly['name']." (".(string)$new_start."-".(string)$new_finish.")",
                    //             "doctor" => $c_doctor['name'],
                    //             "status" => (empty($schedule['patient_id']) ? "available" : "booked")
                    //             //"quota_remain" => $schedule['quota_online']
                    //         ));
                    //     }
                    // }

                    if(count($list_doctor) > 0){
                        array_push($day_schedule, array(
                            "id_poly" => $poly['id'],
                            "poly_code" => $poly['poly_code'],
                            "poly_name" => $poly['name'],
                            // "schedule_poly" => $schedule_poly,
                            "doctors" => $list_doctor
                            )
                        );    
                    }                                   
                }                        

                if(count($all_schedule) > 0){
                    array_push($schedules, array(
                        "day" => array(
                            "day" => $days_name[$pos],
                            "date" => $c_day
                        ),
                        "poly" => $day_schedule
                    ));
                }
                $pos = $pos+1;
            }            
            
            $result = array(
                "result" => $schedules
            );
            return $response->withJson(["status" => "Success", "data" => $result], 200);


        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });  

     // POST Booking Request
    $app->post('/booking/request', function (Request $request, Response $response, array $args) use($container){

        if($this->who_is_it == "user"){
            // cek dulu apakah token valid
            $key = $request->getQueryParam("key");
            $sql1 = "SELECT * FROM user WHERE token=:token";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindParam("token", $key);
            $stmt1->execute();
            $user = $stmt1->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){
                // cek dulu apakah schedule_id sedang valid atau tidak memang milik dia (saat ini)
                $schedule_id = $user_param['schedule_id'];

                $sql2 = "SELECT * FROM master_practice_schedule WHERE id=:id AND patient_id IS NULL";
                $stmt2 = $this->antrian_db->prepare($sql2);
                $stmt2->bindParam("id", $schedule_id);
                $stmt2->execute();
                $schedule_id_valid = ($stmt2->rowCount() == 1 ? true : false);
                
                if($schedule_id_valid == true){
                    //-- set schedule ke pasien tersebut
                    $sql3 = "UPDATE master_practice_schedule SET patient_id=:patient_id WHERE id=:id";
                    $stmt3 = $this->antrian_db->prepare($sql3);
                    $stmt3->bindParam("id", $schedule_id);
                    $stmt3->bindParam("patient_id", $user_param['patient_id']);
                    $stmt3->execute();

                    $new_id_queue = md5((string)time('now'));
                    $sql4 = "INSERT INTO master_req_queue (id, id_schedule_practice, created_date, created_by,unix_timestamp, user_id, patient_id) VALUES (:id, :id_schedule_practice,:created_date,:created_by,:unix_timestamp,:user_id,:patient_id)";
                    $stmt4 = $this->antrian_db->prepare($sql4);
                    $stmt4->bindParam("id_schedule_practice", $schedule_id);
                    $stmt4->bindValue("created_date", date('Y-m-d H:i:s'));
                    $stmt4->bindValue("created_by", $request->getQueryParam("key"));
                    $stmt4->bindValue("unix_timestamp", (string)time('now'));
                    $stmt4->bindParam("id", $new_id_queue);
                    $stmt4->bindParam("user_id", $user['id']);
                    $stmt4->bindParam("patient_id", $user_param['patient_id']);
                    $stmt4->execute();
                    $queue_id = $new_id_queue;

                    // update status
                    // $sql5 = "INSERT INTO master_req_queue_status (req_id, status, kode) VALUES (:req_id, :status, 0)";
                    $sql5 = "INSERT INTO master_req_queue_status (req_id, status, kode) VALUES (:req_id, :status, 0)";
                    $stmt5 = $this->antrian_db->prepare($sql5);
                    $stmt5->bindParam("req_id", $new_id_queue);
                    $stmt5->bindValue("status", "WAITING FOR CONFIRMATION");                    
                    $stmt5->execute();

                    $result = array(
                        "message" => "Sukses",
                        "booking_id" => $new_id_queue,
                        "status" => "WAITING FOR CONFIRMATION"
                    );
                    return $response->withJson(["status" => "Success", "data" => $result], 200);
                }else{
                    //-- tidak, stop
                    $result = array(
                        "message" => "Jadwal Sudah Dibooking Pasien Lain",
                    );
                    return $response->withJson(["status" => "Error", "data" => $result], 200);
                }
            }else{
                // tidak valid parameter
                $result = array(
                    "message" => "Parameter tidak valid",
                );
                return $response->withJson(["status" => "Error", "data" => $result], 200);
            }

        }else{
            // stop, user tidak valid
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    }); 

 // POST Cancel & Booking Request
    $app->post('/booking/cancel_and_request', function (Request $request, Response $response, array $args) use($container){

        if($this->who_is_it == "user"){
            // cek dulu apakah token valid
            $key = $request->getQueryParam("key");
            $sql1 = "SELECT * FROM user WHERE token=:token";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindParam("token", $key);
            $stmt1->execute();
            $user = $stmt1->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){
                // cek dulu apakah schedule_id sedang valid atau tidak memang milik dia (saat ini)
                $schedule_id = $user_param['schedule_id'];

                $sql2 = "SELECT * FROM master_practice_schedule WHERE id=:id AND patient_id IS NULL";
                $stmt2 = $this->antrian_db->prepare($sql2);
                $stmt2->bindParam("id", $schedule_id);
                $stmt2->execute();
                $schedule_id_valid = ($stmt2->rowCount() == 1 ? true : false);
                
                if($schedule_id_valid == true){

                    // update status old
                    $sql6 = "INSERT INTO master_req_queue_status (req_id, status, kode) VALUES (:req_id, :status, 11)";
                    $stmt6 = $this->antrian_db->prepare($sql6);
                    $stmt6->bindParam("req_id", $user_param['old_req_id']);
                    $stmt6->bindValue("status", "REJECT BOOKING");                    
                    $stmt6->execute();
                    
                    $sql7 = "DELETE FROM master_req_queue_status WHERE req_id=:id AND kode=0";                      
                    $stmt7 = $this->antrian_db->prepare($sql7);
                    $stmt7->bindParam("id", $user_param['old_req_id']);
                    $stmt7->execute();

                    // get bukti pembayaran previous
                    $pay_evidence = "SELECT * FROM master_req_queue WHERE id=:id";
                    $pay_evidence_res = $this->antrian_db->prepare($pay_evidence);
                    $pay_evidence_res->bindParam("id", $user_param['old_req_id']);
                    $pay_evidence_res->execute();
                    $evidence_result = $pay_evidence_res->fetchAll()[0];
        
                    //-- set schedule ke pasien tersebut
                    $sql3 = "UPDATE master_practice_schedule SET patient_id=:patient_id WHERE id=:id";
                    $stmt3 = $this->antrian_db->prepare($sql3);
                    $stmt3->bindParam("id", $schedule_id);
                    $stmt3->bindParam("patient_id", $user_param['patient_id']);
                    $stmt3->execute();

                    $new_id_queue = md5((string)time('now'));
                    $sql4 = "INSERT INTO master_req_queue (id, id_schedule_practice,created_by,unix_timestamp, payment_receipt, user_id, patient_id) VALUES (:id, :id_schedule_practice,:created_by,:unix_timestamp, :payment_receipt,:user_id,:patient_id)";
                    $stmt4 = $this->antrian_db->prepare($sql4);
                    $stmt4->bindParam("id_schedule_practice", $schedule_id);
                    $stmt4->bindValue("created_by", $request->getQueryParam("key"));
                    $stmt4->bindValue("unix_timestamp", (string)time('now'));
                    $stmt4->bindValue("payment_receipt", $evidence_result['payment_receipt']);
                    $stmt4->bindParam("id", $new_id_queue);
                    $stmt4->bindParam("user_id", $user['id']);
                    $stmt4->bindParam("patient_id", $user_param['patient_id']);
                    $stmt4->execute();
                    $queue_id = $new_id_queue;
                

                    // update status
                    $sql5 = "INSERT INTO master_req_queue_status (req_id, status, kode) VALUES (:req_id, :status, 6)";
                    $stmt5 = $this->antrian_db->prepare($sql5);
                    $stmt5->bindParam("req_id", $new_id_queue);
                    $stmt5->bindValue("status", "BOOKING IS SUCCESS");                    
                    $stmt5->execute();

                    $result = array(
                        "message" => "Sukses",
                        "booking_id" => $new_id_queue,
                        "status" => "BOOKING IS SUCCESS"
                    );
                    return $response->withJson(["status" => "Success", "data" => $result], 200);
                }else{
                    //-- tidak, stop
                    $result = array(
                        "message" => "Jadwal Sudah Dibooking Pasien Lain",
                    );
                    return $response->withJson(["status" => "Error", "data" => $result], 200);
                }
            }else{
                // tidak valid parameter
                $result = array(
                    "message" => "Parameter tidak valid",
                );
                return $response->withJson(["status" => "Error", "data" => $result], 200);
            }

        }else{
            // stop, user tidak valid
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });  

    // POST Cancel Booking
    $app->post('/booking/cancel', function (Request $request, Response $response, array $args) use($container){

        if($this->who_is_it == "user"){
            // cek dulu apakah token valid
            $key = $request->getQueryParam("key");
            $sql1 = "SELECT * FROM user WHERE token=:token";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindParam("token", $key);
            $stmt1->execute();
            $user = $stmt1->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){
                    // update status old
                    $sql6 = "INSERT INTO master_req_queue_status (req_id, status, kode) VALUES (:req_id, :status, 11)";
                    $stmt6 = $this->antrian_db->prepare($sql6);
                    $stmt6->bindParam("req_id", $user_param['req_id']);
                    $stmt6->bindValue("status", "REJECT BOOKING");                    
                    $stmt6->execute();
                    
                    $sql2 = "INSERT INTO master_req_queue_status (req_id, status, kode) VALUES (:req_id, :status, 17)";
                    $stmt2 = $this->antrian_db->prepare($sql2);
                    $stmt2->bindParam("req_id", $user_param['req_id']);
                    $stmt2->bindValue("status", "BOOKING WAS CANCELLED BY USER");                    
                    $stmt2->execute();
                    
                    $sql7 = "DELETE FROM master_req_queue_status WHERE req_id=:id AND kode=0";                      
                    $stmt7 = $this->antrian_db->prepare($sql7);
                    $stmt7->bindParam("id", $user_param['req_id']);
                    $stmt7->execute();

                    // get master req queue
                    $get_mrq = "SELECT * FROM master_req_queue WHERE id=:req_id";
                    $execute_mrq = $this->antrian_db->prepare($get_mrq);
                    $execute_mrq->bindParam("req_id" , $user_param['req_id']);
                    $execute_mrq->execute();
                    $value_mrq = $execute_mrq->fetchAll()[0];

                    // get master practice schedule
                    $update_mps = "UPDATE master_practice_schedule SET patient_id=:patient_id WHERE id=:id_sp";
                    $run_update_mps = $this->antrian_db->prepare($update_mps);
                    $run_update_mps->bindParam("id_sp" , $value_mrq['id_schedule_practice']);
                    $run_update_mps->bindValue("patient_id" , NULL);
                    $execute_update_mps = $run_update_mps->execute();


                    $result = array(
                        "message" => "Sukses",
                        "status" => "BOOKING CANCELLED"
                    );
                    return $response->withJson(["status" => "Success", "data" => $result], 200);

            }else{
                // tidak valid parameter
                $result = array(
                    "message" => "Parameter tidak valid",
                );
                return $response->withJson(["status" => "Error", "data" => $result], 200);
            }

        }else{
            // stop, user tidak valid
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });  


    

    // GET Status Booking
    $app->post('/booking/status', function (Request $request, Response $response, array $args) use($container){
        if($this->who_is_it == "user"){
            // cek dulu apakah token valid
            $key = $request->getQueryParam("key");
            $sql1 = "SELECT * FROM user WHERE token=:token";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindParam("token", $key);
            $stmt1->execute();
            $user = $stmt1->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){
                // cek dulu apakah schedule_id sedang valid atau tidak memang milik dia (saat ini)
                $req_id = $user_param['booking_id'];

                $sql2 = "SELECT * FROM master_req_queue_status WHERE req_id=:req_id ORDER BY time ASC";
                $stmt2 = $this->antrian_db->prepare($sql2);
                $stmt2->bindParam("req_id", $req_id);
                $stmt2->execute();
                $schedule_id_valid = ($stmt2->rowCount() > 0 ? true : false);
                
                if($schedule_id_valid == true){
                    $status = array();

                    foreach($stmt2->fetchAll() as $stats){
                        array_push($status,
                            array(
                                "time" => $stats['time'],
                                "desc" => $stats['status'],
                                "time_limit" => (empty($stats['batas_waktu']) ? "-" : stats['batas_waktu'])
                            )
                        );
                    }

                    $result = array(
                        "message" => "Data ditemukan",
                        "booking_id" => $req_id,
                        "status" => $status
                    );
                    return $response->withJson(["status" => "Success", "data" => $result], 200);
                }else{
                    //-- tidak, stop
                    $result = array(
                        "message" => "Booking Belum memiliki status",
                    );
                    return $response->withJson(["status" => "Error", "data" => $result], 200);
                }
            }else{
                // tidak valid parameter
                $result = array(
                    "message" => "Parameter tidak valid",
                );
                return $response->withJson(["status" => "Error", "data" => $result], 200);
            }

        }else{
            // stop, user tidak valid
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }        
    });   

    // POST BOOKING PAYMENT
    $app->post('/booking/payment_confirmation', function (Request $request, Response $response, array $args) use($container){
        if($this->who_is_it == "user"){
            // cek dulu apakah token valid
            $key = $request->getQueryParam("key");
            $sql1 = "SELECT * FROM user WHERE token=:token";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindParam("token", $key);
            $stmt1->execute();
            $user = $stmt1->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){
                // cek dulu apakah booking statusnya menunggu pembayaran 
                // kode = 2
                $req_id = $user_param['booking_id'];
                $sql2 = "SELECT * FROM master_req_queue_status WHERE req_id=:req_id AND kode=2 ORDER BY time DESC LIMIT 1";
                $stmt2 = $this->antrian_db->prepare($sql2);
                $stmt2->bindParam("req_id", $req_id);
                $stmt2->execute();

                $schedule_id_valid = ($stmt2->rowCount() == 1 ? true : false);
                
                if($schedule_id_valid == true){
                    // upload bukti pembayaran disini, kemudian upload ke 
                    // $payment_receipt = $user_param['payment_receipt'];
                    $set_null_pay_stat = NULL;

                    // $folder_upload = "src/uploads/transfer_receipt";
                    $folder_upload = "src/uploads/transfer_receipt/";
                    $container['upload_directory'] = __DIR__ . '/uploads/transfer_receipt/';
                    
                    $directory = $container['upload_directory'];
                    $uploadedFiles = $request->getUploadedFiles();
                    $user_param = $request->getParsedBody();

                    // handle single input with single file upload
                    $uploadedFile = $uploadedFiles['payment_receipt'];
                    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
                        $filename = moveUploadedFile($directory, $uploadedFile);
                        // save to db file name

                        // update path ke db
                        $sql3 = "UPDATE master_req_queue SET payment_receipt=:payment_receipt , payment_status=:payment_status , view_seq=:view_seq WHERE id=:id";
                        $stmt3 = $this->antrian_db->prepare($sql3);
                        $stmt3->bindValue("payment_receipt", $folder_upload."".$filename);
                        $stmt3->bindValue("payment_status", $set_null_pay_stat);
                        $stmt3->bindValue("view_seq", 2);
                        $stmt3->bindParam("id", $user_param['booking_id']);
                        $stmt3->execute();

                        // konfirm kalau sudah masuk
                        $sql4 = "INSERT INTO master_req_queue_status (req_id, status, kode) VALUES (:req_id, :status, :kode)";
                        $stmt4 = $this->antrian_db->prepare($sql4);
                        $stmt4->bindParam("req_id", $user_param['booking_id']);
                        $stmt4->bindValue("status", "SISTEM MENERIMA BUKTI PEMBAYARAN");
                        $stmt4->bindValue("kode", 3);
                        $stmt4->execute();

                        // tinggal menunggu dari admin
                        $sql5 = "INSERT INTO master_req_queue_status (req_id, status, kode) VALUES (:req_id, :status, :kode)";
                        $stmt5 = $this->antrian_db->prepare($sql5);
                        $stmt5->bindParam("req_id", $user_param['booking_id']);
                        $stmt5->bindValue("status", "WAITING FOR CONFIRMATION");
                        $stmt5->bindValue("kode", 4);
                        $stmt5->execute();
                        $url_full = "https://bwcc.inovasialfatih.com/api";
                        $result = array(
                            "message" => "sukses mengunggah bukti pembayaran",
                            "file" => $url_full."/".$folder_upload."\\".$filename,
                            "param" => $user_param
                        );
                        return $response->withJson(["status" => "Success", "data" => $result], 200);
                    }
                }else{
                    $result = array(
                        "message" => "Parameter tidak valid",
                    );
                    return $response->withJson(["status" => "Error", "data" => $result], 200);
                }

            }else{
                // tidak valid parameter
                $result = array(
                    "message" => "Parameter tidak valid",
                );
                return $response->withJson(["status" => "Error", "data" => $result], 200);
            }

        }else{
            // stop, user tidak valid
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }        
        
    });    

    // GET history booking
    $app->get('/booking/history', function (Request $request, Response $response, array $args) use($container){
        if($this->who_is_it == "user"){
            // cek dulu apakah token valid
            $key = $request->getQueryParam("key");
            $sql1 = "SELECT * FROM user WHERE token=:token";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindParam("token", $key);
            $stmt1->execute();
            $user = $stmt1->fetchAll()[0];

            $result = [];
            if(!empty($user)){
                // cek dulu apakah schedule_id sedang valid atau tidak memang milik dia (saat ini)

                $sql2 = "SELECT a.*, b.nama as patient_name FROM master_req_queue a LEFT JOIN patient b ON a.patient_id = b.id WHERE a.created_by=:created_by ORDER BY a.unix_timestamp DESC";
                $stmt2 = $this->antrian_db->prepare($sql2);
                $stmt2->bindParam("created_by", $key);
                $stmt2->execute();
                $res = ($stmt2->rowCount() > 0 ? true : false);

                // print_r($stmt2->fetchAll()); die();
                
                if($res == true){
                    $status = array();

                    foreach($stmt2->fetchAll() as $books){
                        // get detail schedule 
                        $sqlX = "SELECT b.id as booking_id, a.start_time_service as time_start, a.finish_time_service as time_finish, a.date as time_appointment, b.unix_timestamp as booking_time, a.patient_id as patient_idc FROM `master_practice_schedule` as a JOIN master_req_queue as b ON a.id = b.id_schedule_practice WHERE b.id=:req_id";
                        $stmtX = $this->antrian_db->prepare($sqlX);
                        $stmtX->bindParam("req_id", $books['id']);
                        $stmtX->execute();
                        
                        if($stmtX->rowCount() > 0) {
                            $res1 = $stmtX->fetchAll()[0];
                            
                            $sqlY = "SELECT kode FROM `master_req_queue_status` WHERE req_id=:req_id ORDER BY id DESC LIMIT 1";
                            $stmtY = $this->antrian_db->prepare($sqlY);
                            $stmtY->bindParam("req_id", $books['id']);
                            $stmtY->execute();
                            if($stmtY->rowCount() > 0) { 
                                $res2 = $stmtY->fetchAll()[0];
                                
                                if($res2['kode'] != 17) {
                                    $patient_id = $books['patient_id']; 
                                    $patient_name = $books['patient_name'];

                                    $is_insert = true;
                                    if($patient_id == NULL) {
                                        $sqlP = "SELECT * FROM `patient` WHERE id=:patient_id ORDER BY id DESC LIMIT 1";
                                        $stmtP = $this->antrian_db->prepare($sqlP);
                                        $stmtP->bindParam("patient_id", $res1['patient_idc']);
                                        $stmtP->execute();
                                        if($stmtP->rowCount() > 0) {
                                            $resP = $stmtP->fetchAll()[0];
                                            $patient_id = $resP['id'];
                                            $patient_name = $resP['nama'];
                                        } else {
                                            $is_insert = false;
                                        }
                                    } 

                                    if($is_insert)
                                        array_push($status,
                                            array(
                                                "booking_id" => $books['id'],
                                                "created_date" => date('D, d-m-Y', $books['unix_timestamp']),
                                                "patient_name" => $patient_name,
                                                "date" => date('Y-m-d', strtotime($res1['time_appointment'])),
                                                "time_start" => date('H:i', strtotime($res1['time_start'])),
                                                "time_finish" => date('H:i', strtotime($res1['time_finish'])),
                                                "patient_id " => $patient_id,
                                                "status" => $res2['kode']
                                            )
                                        );
                                }
                                    
                                
                            }

                            
                        }
                        
                    }

                    $result = array(
                        "message" => "List Booking",
                        "status" => $status
                    );
                    return $response->withJson(["status" => "Success", "data" => $result], 200);
                }else{
                    //-- tidak, stop
                    $result = array(
                        "message" => "User tidak memiliki riwayat booking",
                    );
                    return $response->withJson(["status" => "Error", "data" => $result], 200);
                }
            }else{
                // tidak valid parameter
                $result = array(
                    "message" => "Parameter tidak valid",
                );
                return $response->withJson(["status" => "Error", "data" => $result], 200);
            }

        }else{
            // stop, user tidak valid
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }        
    }); 


    // GET history booking
    $app->post('/booking/history/detail', function (Request $request, Response $response, array $args) use($container){
        if($this->who_is_it == "user"){
            // cek dulu apakah token valid
            $key = $request->getQueryParam("key");
            $sql1 = "SELECT * FROM user WHERE token=:token";
            $stmt1 = $this->db->prepare($sql1);
            $stmt1->bindParam("token", $key);
            $stmt1->execute();
            $user = $stmt1->fetchAll()[0];
            $user_param = $request->getParsedBody();

            $result = [];

            if($user_param){
                // cek dulu apakah schedule_id sedang valid atau tidak memang milik dia (saat ini)

                $sql2 = "SELECT * FROM master_req_queue WHERE id=:booking_id";
                $stmt2 = $this->antrian_db->prepare($sql2);
                $stmt2->bindParam("booking_id", $user_param['booking_id']);
                $stmt2->execute();
                $res = ($stmt2->rowCount() == 1 ? true : false);
                
                if($res == true){
                    // get detail in practice_schedule
                    $data_booking = $stmt2->fetchAll()[0];
                    $sql3 = "SELECT * FROM master_practice_schedule WHERE id=:id";
                    $stmt3 = $this->antrian_db->prepare($sql3);
                    $stmt3->bindParam("id", $data_booking['id_schedule_practice']);
                    $stmt3->execute();
                    $schedule = $stmt3->fetchAll()[0];

                    // get detail in req_queue_status
                    $sql4 = "SELECT time,status FROM master_req_queue_status WHERE req_id=:req_id";
                    $stmt4 = $this->antrian_db->prepare($sql4);
                    $stmt4->bindParam("req_id", $user_param['booking_id']);
                    $stmt4->execute();
                    $books1 = $stmt4->fetchAll();

                    // get detail poly
                    $sql5 = "SELECT * FROM master_poly WHERE id=:id";
                    $stmt5 = $this->antrian_db->prepare($sql5);
                    $stmt5->bindValue("id", $schedule['id_poly']);
                    $stmt5->execute();
                    $poly1 = $stmt5->fetchAll()[0];

                    // get detail doctor
                    $sql6 = "SELECT * FROM master_doctor WHERE id=:id";
                    $stmt6 = $this->antrian_db->prepare($sql6);
                    $stmt6->bindValue("id", $schedule['id_doctor']);
                    $stmt6->execute();
                    $doctor1 = $stmt6->fetchAll()[0];

                    // get detail patient
                    // $sql7 = "SELECT * FROM patient WHERE id=:id";
                    // $stmt7 = $this->antrian_db->prepare($sql7);
                    // $stmt7->bindValue("id", $schedule['patient_id']);
                    // $stmt7->execute();
                    // $patient1 = $stmt7->fetchAll()[0];

                    $patient_name = '';
                    if($data_booking['patient_id'] == NULL) {
                        $sqlP = "SELECT * FROM `patient` WHERE id=:patient_id ORDER BY id DESC LIMIT 1";
                        $stmtP = $this->antrian_db->prepare($sqlP);
                        $stmtP->bindParam("patient_id", $schedule['patient_id']);
                        $stmtP->execute();
                        if($stmtP->rowCount() > 0) {
                            $resP = $stmtP->fetchAll()[0];
                            $patient_name = $resP['nama'];
                        }
                    } else {
                        $sql7 = "SELECT * FROM patient WHERE id=:id";
                        $stmt7 = $this->antrian_db->prepare($sql7);
                        $stmt7->bindValue("id", $data_booking['patient_id']);
                        $stmt7->execute();
                        if($stmt7->rowCount() > 0) {
                            $patient1 = $stmt7->fetchAll()[0];
                            $patient_name = $patient1['nama'];
                        } 
                    }


                    $datetime_booking = new DateTime($schedule['date']);
                    $results = array(
                        "booking_id" => $user_param['booking_id'],
                        "details" => array(
                            "poly_name" => $poly1['name'],
                            "doctor_name" => $doctor1['name'],
                            "date" => $datetime_booking->format('D, d-m-Y'),
                            "time_start" => date('H:i', strtotime($schedule["start_time_service"])),
                            "time_finish" => date('H:i', strtotime($schedule["finish_time_service"])),
                            "created_by" => $schedule["created_by"],
                            "payment_receipt" => $data_booking["payment_receipt"],
                            "patient_name" => $patient_name,
                            "booking_date" =>date('D, d-m-Y', $data_booking['unix_timestamp']),
                            "queue_number" => $schedule["queue_number"],
                        ),
                        "status" => $books1
                    );                    

                    $result = array(
                        "message" => "List Booking",
                        "data" => $results
                    );
                    return $response->withJson(["status" => "Success", "data" => $result], 200);
                }else{
                    //-- tidak, stop
                    $result = array(
                        "message" => "Booking ID tidak berlaku",
                    );
                    return $response->withJson(["status" => "Error", "data" => $result], 200);
                }
            }else{
                // tidak valid parameter
                $result = array(
                    "message" => "Parameter tidak valid",
                );
                return $response->withJson(["status" => "Error", "data" => $result], 200);
            }

        }else{
            // stop, user tidak valid
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }        
    });       

    // DEFAULT ROUTE
    $app->get('/[{name}]', function (Request $request, Response $response, array $args) use ($container) {

        // check if it is admin 
        if($this->who_is_it == "admin"){
            $result = array(
                "message" => "welcome to BWCC MOBILE API, Admin!"
            );
            return $response->withJson(["status" => "Success", "data" => $result], 200);
        }else{    
            $result = array(
                "message" => "welcome to BWCC MOBILE API, need a help? please contact your administrator"
            );
            return $response->withJson(["status" => "Success", "data" => $result], 401);
        }
        
    });


    // user/contact_us [POST] ok
    $app->post('/user/contact_us', function (Request $request, Response $response, array $args) use ($container) {
        // list
        // alamat_klinik
        // email
        // phone_number
        // social_media

        // check is admin?
        if($this->who_is_it == "admin"){
            // check param request
            $input_param = $request->getParsedBody();

            if($input_param){

                $is_valid = true;
                // list of error param
                $error_param = [];

                // alamat_klinik
                if(!isset($input_param['alamat_klinik'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "alamat_klinik", "error" => "empty value"));

                }else{
                    
                    
                }

                // email
                if(!isset($input_param['email'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "email", "error" => "empty value"));

                }else{
                    
                    if(!filter_var($input_param['email'], FILTER_VALIDATE_EMAIL)){
                        $is_valid = false;
                        array_push($error_param, array( "param" => "email", "error" => "invalid email"));
                    }else{
                        
                    }
                }

                // phone_number
                if(!isset($input_param['phone_number'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "phone_number", "error" => "empty value"));

                }else{
                    
                    
                }

                // facebook
                if(!isset($input_param['facebook'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "facebook", "error" => "empty value"));

                }else{
                    
                    
                }

                // instagram
                if(!isset($input_param['instagram'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "instagram", "error" => "empty value"));

                }else{
                    
                    
                }

                // youtube
                if(!isset($input_param['youtube'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "youtube", "error" => "empty value"));

                }else{
                    
                    
                }

                // twitter
                if(!isset($input_param['twitter'])){
                    $is_valid = false;
                    array_push($error_param, array( "param" => "twitter", "error" => "empty value"));

                }else{
                    
                    
                }

                // social_media
                $list_socmed = [];
                $arr_socmed = array_push($list_socmed, array(

                    'facebook'  => $input_param['facebook'],
                    'instagram' => $input_param['instagram'],
                    'youtube'   => $input_param['youtube'],
                    'twitter'   => $input_param['twitter']

                ));

                $encode_socmed = json_encode($list_socmed);
                $created_date_contact = date('Y-m-d H:i:s');


                $res_message = "sukses membuat kontak";

                // apabila seluruh parameter valid
                if($is_valid == true){

                    $sql1 = "INSERT INTO contact (alamat_klinik, email, phone_number, social_media, facebook, instagram, youtube, twitter, created_date) VALUES (:alamat_klinik, :email, :phone_number, :social_media, :facebook, :instagram, :youtube, :twitter, :created_date)";
                    $stmt = $this->antrian_db->prepare($sql1);

                    $stmt->bindParam("alamat_klinik", $input_param['alamat_klinik']);
                    $stmt->bindParam("email", $input_param['email']);
                    $stmt->bindParam("phone_number", $input_param['phone_number']);
                    $stmt->bindParam("social_media", $encode_socmed);
                    $stmt->bindParam("facebook", $input_param['facebook']);
                    $stmt->bindParam("instagram", $input_param['instagram']);
                    $stmt->bindParam("youtube", $input_param['youtube']);
                    $stmt->bindParam("twitter", $input_param['twitter']);
                    $stmt->bindParam("created_date", $created_date_contact);

                    $stmt->execute();

                }

                $result = array(
                    "message" => $res_message,
                    "is_valid" => $is_valid,
                    "input_param" => $input_param,
                    "error_param" => $error_param
                );

                return $response->withJson(["status" => "Success", "data" => $result], 200);


            }else{
                $result = array(
                    "message" => "invalid param",
                );
                return $response->withJson(["status" => "Success", "data" => $result], 200);
            }

        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error lur", "data" => $result], 400);
        }

    });

    // user/list_contact [GET]
    $app->get('/user/list_contact', function (Request $request, Response $response, array $args) use ($container) {
        // baca tokennya
        // var form : email, password
        // check is admin?
        if($this->who_is_it == "admin"){

            $sth = $this->antrian_db->prepare("SELECT * FROM contact");
            // $sth->bindParam("id", $args['id']);
            $sth->execute();
            $todos = $sth->fetchObject();

            $datacontact = [];

            $dec_phone_number = json_decode($todos->phone_number, true);

            // foreach ($todos as $val_todos) {
                $decode_phone_number = json_decode($todos->phone_number, true);

                $phone_list = [];

                foreach ($decode_phone_number as $val_phone_number) {
                    $phone_number_value = array("number" => $val_phone_number);
                    array_push($phone_list, $phone_number_value);
                }

            //     array_push($datacontact, array(
            //             "alamat_klinik"     => $val_todos['alamat_klinik'],
            //             "email"             => $val_todos['email'],
            //             "phone_number"      => $phone_list,
            //             "whatsapp_number"   => $val_todos['whatsapp_number'],
            //             "facebook"          => $val_todos['facebook'],
            //             "instagram"         => $val_todos['instagram'],
            //             "youtube"           => $val_todos['youtube'],
            //             "twitter"           => $val_todos['twitter'],
            //             "facebook_name"     => $val_todos['facebook_name'],
            //             "instagram_name"    => $val_todos['instagram_name'],
            //             "youtube_name"      => $val_todos['youtube_name'],
            //             "twitter_name"      => $val_todos['twitter_name']
            //         ));
                
            // }

            $arr_list_contact = array(
                        "alamat_klinik"     => $todos->alamat_klinik,
                        "email"             => $todos->email,
                        "phone_number"      => $phone_list,
                        "whatsapp_number"   => $todos->whatsapp_number,
                        "facebook"          => $todos->facebook,
                        "instagram"         => $todos->instagram,
                        "youtube"           => $todos->youtube,
                        "twitter"           => $todos->twitter,
                        "facebook_name"     => $todos->facebook_name,
                        "instagram_name"    => $todos->instagram_name,
                        "youtube_name"      => $todos->youtube_name,
                        "twitter_name"      => $todos->twitter_name
            );

            return $this->response->withJson(['status' => 'Success' , 'data' => $arr_list_contact]);


            // $data_contact = array_push($result, var)


        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });    

    // user/change_password [POST] ok
    $app->post('/user/change_password/', function (Request $request, Response $response, array $args) use ($container) {

        if($this->who_is_it == "user"){

            $input_param = $request->getParsedBody();
            $key = $request->getQueryParam("key");

            if ($input_param) {
                // return 'alamat '.$input_param['alamat_klinik'].' dan tokennya '.$key.' ';
                // cek apakah token ada di db api
                $q_api_check = 'SELECT * FROM user WHERE token = "'.$key.'"';
                $token_api_check = $this->db->prepare($q_api_check);
                $token_api_check->bindParam("token", $key);
                $token_api_check->execute();
                $todos = $token_api_check->fetchAll();
                // $user_info = $this->response->withJson($todos);
                if (empty($todos)) {
                    return 'data kosong';
                }
                else
                {
                    // return 'ada';
                    // check password match or no
                    if ($input_param['new_password'] != $input_param['confirmation_password']) {
                        return 'password_invalid';
                    }
                    else
                    {   
                        $hash_password = sha1($input_param['new_password']);

                        foreach ($todos as $val_info_user) {
                            // cek user master
                            $dbmu = 'UPDATE user SET password = "'.$hash_password.'" WHERE email = "'.$val_info_user['email'].'"';
                            $run_dbmu = $this->antrian_db->prepare($dbmu);
                            $run_dbmu->bindParam("password", $hash_password);
                            $run_dbmu->execute();

                            $result = array(
                                "message" => "password changed !",
                            );
                            return $response->withJson(["status" => "Success", "data" => $result , "key" => $key], 200);

                        }
                        // return $user_info;
                    }

                }

            }
            else
            {
                $result = array(
                    "message" => "invalid param",
                );
                return $response->withJson(["status" => "Success", "data" => $result], 200);
            }
            

        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error lur", "data" => $result], 400);
        }

    });

    $app->get('/user/privacy_policy', function (Request $request, Response $response, array $args) use ($container) {
       
        $sth = $this->antrian_db->prepare("SELECT * FROM privacy_policy");
            // $sth->bindParam("id", $args['id']);
            $sth->execute();
            $todos = $sth->fetchObject();
            return $this->response->withJson(['status' => 'Success' , 'data' => $todos]);

            // $data_contact = array_push($result, var)


    }); 

    // GET slide image

    $app->get('/user/slide_content_image', function (Request $request, Response $response, array $args) use ($container) {
        // baca tokennya
        // var form : email, password
        // check is admin?
        if($this->who_is_it == "admin"){

            $sth = $this->antrian_db->prepare("SELECT * FROM content_image WHERE type = 1 AND is_active = 1");
            // $sth->bindParam("id", $args['id']);
            $sth->execute();
            $todos = $sth->fetchAll();
            $result_data = [];

            foreach ($todos as $val_dataimage) {
                $image_to = 'https://bwcc.inovasialfatih.com/admin/images/content_image/';

                array_push($result_data, array(
                    "image_url" => ''.$image_to.''.$val_dataimage['image_url'].''
                ));
            }
            

            return $this->response->withJson(['status' => 'Success' , 'data' => $result_data]);

            // $data_contact = array_push($result, var)


        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    }); 

    
    // user/update_token_notification [POST]
    $app->post('/user/update_token_notification', function (Request $request, Response $response, array $args) use ($container) {
        // check is user?
         if($this->who_is_it == "user"){
            // check param request
            $key = $request->getQueryParam("key");
            $sql3 = "SELECT * FROM user WHERE token=:token";
            $stmt3 = $this->db->prepare($sql3);
            $stmt3->bindParam("token", $key);
            $stmt3->execute();
            $user = $stmt3->fetchAll()[0];

            $user_param = $request->getParsedBody();

            $result = [];
            if($user_param){              
                $sql2 = "UPDATE user SET token_notification=:token_notification WHERE id=:id";                      
                $stmt2 = $this->db->prepare($sql2);
                $stmt2->bindParam("id", $user['id']);
                $stmt2->bindParam("token_notification", $user_param['token_notification']);
                $stmt2->execute();
                return $response->withJson(["status" => "Success", "data" => "sukses update token"], 200);
             }
        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    });

    // user/edit_booking/{id}
    $app->get('/user/edit_booking/[{id}]', function (Request $request, Response $response, array $args) use ($container) {


        if($this->who_is_it == "admin"){

            $key = $request->getQueryParam("key");
            $book_q = "SELECT * FROM master_req_queue WHERE id=:id";
            $sth = $this->antrian_db->prepare($book_q);
            $sth->bindParam("id", $args['id']);
            $sth->execute();
            $todos = $sth->fetchAll();
            $result_data = [];

            foreach ($todos as $val_data_queue) {
                // get practice schedule

            $prac_schedule_user = "SELECT master_practice_schedule.id_poly AS poly_id, master_practice_schedule.patient_id AS id_patient, master_practice_schedule.id_doctor AS doctor_id, master_practice_schedule.date AS date_booking , master_practice_schedule.start_time_service AS start_time , master_practice_schedule.finish_time_service AS end_time FROM master_practice_schedule INNER JOIN master_req_queue ON master_req_queue.id_schedule_practice = master_practice_schedule.id WHERE master_req_queue.id_schedule_practice = 'B17F981A-1F0A-9A72-7FED-0BC9C703ED6E'";
            $get_prac_schedule = $this->antrian_db->prepare($prac_schedule_user);
            // $get_prac_schedule->bindParam("id", $args['id']);
            $get_prac_schedule->execute();
            $val_todos_prac_s = $get_prac_schedule->fetchAll();

                foreach ($val_todos_prac_s as $val_schedule_user) {
                   array_push($result_data, array(
                    "id_schedule_practice" => $val_data_queue['id_schedule_practice'],
                    "poly_id" => $val_schedule_user['poly_id'],
                    "id_patient" => $val_schedule_user['id_patient'],
                    "date_booking" => $val_schedule_user['date_booking'],
                    "doctor_id" => $val_schedule_user['doctor_id'],
                    "start_time" => $val_schedule_user['start_time'],
                    "finish_time" => $val_schedule_user['end_time']

                   )); 
                }
               

            }
            
            if (empty($todos)) {
                return $this->response->withJson(['status' => 'Failed' , 'data' => 'kosong']);
            }
            else
            {
                return $this->response->withJson(['status' => 'Success' , 'data' => $result_data]);
            }



            // $data_contact = array_push($result, var)


        }else{
            $result = array(
                "message" => "Unathorized Access",
            );
            return $response->withJson(["status" => "Error", "data" => $result], 400);
        }
    }); 

    // /news/list/1
    $app->get('/news/list', function (Request $request, Response $response, array $args) use ($container) {
            
        // check is user?
        if($this->who_is_it == "user" || $this->who_is_it == "admin"){
            
           // if($this->who_is_it == "admin"){
            
            $news = [];

            $sql = "SELECT * FROM news WHERE is_active=1 ORDER BY created_date DESC LIMIT 20";
            $stmt = $this->antrian_db->prepare($sql);
            $stmt->execute();
            $all_news = $stmt->fetchAll();

            $sql1 = "SELECT * FROM master_category_news WHERE is_active=1";
            $stmt1 = $this->antrian_db->prepare($sql1);
            $stmt1->execute();
            $all_category = $stmt1->fetchAll();

            if($stmt->rowCount() >0){
                foreach($all_news as $item){

                    $new_content = mb_convert_encoding($item['content'], "UTF-8");
                    $cat = "";
                    foreach($all_category as $category){
                        if($category['id'] == $item['id_category']){
                            $cat = $category['name'];
                        }
                    }

                    $news_type = "text";
                    $news_url = 'https://bwcc.inovasialfatih.com/admin'."/".$item['image'];
                    if($item['type']==1){
                        $news_type = "video";
                        $news_url = $item['image'];
                    }

                    array_push(
                        $news, array(
                            "news_id" => $item['id'],
                            "title" => $item['title'],
                            "short_content" => substr($new_content, 0, 50)." ....",
                            "category" => $cat,
                            "date_created" => $item['created_date'],
                            "image_url" => $news_url,
                            "type" => $news_type
                        )
                        );
                }
            }

            $result = array(
                 "message" => "News List",
                "data" => $news,
                "auth" => $this->who_is_it
            );

           
            return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Success", "data" => $result], 200);

        }else{
            $result = array(
                "message" => "Error"
            );
            return $response->withAddedHeader('Access-Control-Allow-Origin', '*')->withJson(["status" => "Failed", "data" => $result], 404);
        }

    });

    // detail news

    $app->get('/news/detail/{news_id}', function (Request $request, Response $response, array $args) use ($container) {
        
        // check is user?
        if($this->who_is_it == "user" || $this->who_is_it == "admin"){
        // if($this->who_is_it == "admin"){
            if($args['news_id']){
                $sql = "SELECT * FROM news WHERE is_active=1 AND id=:id LIMIT 1";
                $stmt = $this->antrian_db->prepare($sql);
                $stmt->bindParam("id", $args['news_id']);
                $stmt->execute();

                if($stmt->rowCount() >0){

                    
                    
                    $sql1 = "SELECT * FROM master_category_news WHERE is_active=1";
                    $stmt1 = $this->antrian_db->prepare($sql1);
                    $stmt1->execute();
                    $all_category = $stmt1->fetchAll();

                    $cat = "";
                    $item = $stmt->fetchAll()[0];

                    foreach($all_category as $category){
                        if($category['id'] == $item['id_category']){
                            $cat = $category['name'];
                        }
                    }

                    $news_type = "text";
                    $news_url = 'https://bwcc.inovasialfatih.com/admin'."/".$item['image'];
                    if($item['type'] == 1){
                        $news_type = "video";
                        $news_url = $item['image'];
                    }

                    $new_content = mb_convert_encoding($item['content'], "UTF-8");

                    $news = array(
                        "news_id" => $item['id'],
                        "title" => $item['title'],
                        "content" => $new_content,
                        "category" => $cat,
                        "date_created" => $item['created_date'],
                        "image_url" => $news_url,
                        "type" => $news_type
                    );

                    $result = array(
                        "message" => "data found",
                        "data" => $news
                    );
                    return $response->withJson(["status" => "Success", "data" => $result], 200);                                        

                }else{
                    $result = array(
                        "message" => "data not found"
                    );
                    return $response->withJson(["status" => "Error", "data" => $result], 200);                    
                }
                $all_news = $stmt->fetchAll();
    
            
            }else{
                $result = array(
                    "message" => "param required"
                );
                return $response->withJson(["status" => "Error", "data" => $result], 200);
            }
        }else{
            $result = array(
                "message" => "Error"
            );
            return $response->withJson(["status" => "Failed", "data" => $result], 404);
        }
    });

    // get all class

    // $app->get('/class/get_dataclass', function (Request $request, Response $response, array $args) use ($container) {
        
    //     // check is user?
    //     if($this->who_is_it == "admin"){

    //         $time_now = date('H:i');
    //         $date_now = date('Y-m-d');
        
    //         $list_schedule_instruction = "SELECT schedule_class.id AS id_schedule_class , schedule_class.id_class AS classid, schedule_class.id_instructor AS instructorid, master_class.name AS classname, master_instructor.name AS nameinstructor, schedule_instructor.start_date AS date_start, schedule_instructor.start_time AS time_start, schedule_instructor.finish_time AS time_finish, schedule_instructor.quota_remain AS limit_quota FROM schedule_class JOIN schedule_instructor JOIN master_class JOIN master_instructor WHERE schedule_class.id_instructor = schedule_instructor.id_instructor AND schedule_class.id_class = master_class.id AND schedule_class.id_instructor = master_instructor.id AND schedule_class.id_schedule_instructor = schedule_instructor.id AND schedule_instructor.quota_remain > 0 ORDER BY schedule_instructor.start_date ASC";
    //         $execute_q = $this->antrian_db->prepare($list_schedule_instruction);
    //         $execute_q->execute();
    //         $fetch_data = $execute_q->fetchAll();



    //         $datainfo_class = [];
    //         $info_class = [];
    //         $dataclass_info = [];
            

    //         $return_alldata = [];

    //         foreach ($fetch_data as $val_fetch_data) {
    //             if ($date_now < $val_fetch_data['date_start']  && $time_now < $val_fetch_data['time_finish']) {
    //                 $stats_class = 'yes';
    //             }
    //             else
    //             {
    //                 $stats_class = 'no';
    //             }

                
    //             $ins_info = [];
    //             $schedule_info = [];
    //             array_push($ins_info, array(
    //                         "instructor_id"             => $val_fetch_data['instructorid'],
    //                         "name_instructor"           => ''.$val_fetch_data['nameinstructor'].' | '.$val_fetch_data['time_start'].' - '.$val_fetch_data['time_finish'].'',
    //                         "time_start"                => $val_fetch_data['time_start'],
    //                         "time_finish"               => $val_fetch_data['time_finish']
    //                     ));

    //             array_push($schedule_info, array(
    //                  "id_schedule"       => $val_fetch_data['id_schedule_class'],
    //                     "class_id"          => $val_fetch_data['classid'],
    //                     "class_name"        => $val_fetch_data['classname'],
    //                     "info_instructor"   => $ins_info,
    //                     "limit_quota"       => $val_fetch_data['limit_quota']
    //             ));

    //             array_push($return_alldata, array(
    //                 "info_date" => array(
    //                     "date_start" => $val_fetch_data['date_start'],
    //                     "is_class_available" => $stats_class
    //                 ),
    //                 "schedule" => $schedule_info
    //             ));

                


    //         }
            

    //         $result_data = array(
    //             "result" => $return_alldata
    //         );

    //         return $response->withJson(["status" => "Success", "data" => $result_data]);

    //     }else{
    //         $result = array(
    //             "message" => "Error"
    //         );
    //         return $response->withJson(["status" => "Failed", "data" => $result], 404);
    //     }
    // });

    $app->get('/class/get_dataclass', function (Request $request, Response $response, array $args) use ($container) {
        
        // check is user?
        if($this->who_is_it == "admin"){

           $date_now    = date('Y-m-d');
           $datetimenow = date('Y-m-d H:i');
           $timenow     = date('H:i');

           // reduce 1 day
           //print('Next Date ' . date('Y-m-d', strtotime('-1 day', strtotime($date_raw))));
           $datenowday = date('Y-m-d', strtotime('-1 day' , strtotime($date_now)));
            
            // schedule order by date

            $list_schedule_instruction = "SELECT schedule_instructor.start_date AS date_start, schedule_instructor.start_time AS time_start, schedule_instructor.finish_time AS time_finish FROM schedule_instructor GROUP BY schedule_instructor.start_date ORDER BY date_start ASC";
            $execute_q = $this->antrian_db->prepare($list_schedule_instruction);
            $execute_q->execute();
            $fetch_data = $execute_q->fetchAll();



            $datainfo_class = [];
            $info_class = [];
            $dataclass_info = [];
            $return_alldata = [];
            $ins_info = [];
            $schedule_info = [];
            $classinfo = [];
            $instructor_data = [];


            foreach ($fetch_data as $val_fetch_data) {
                //   && $time_now < $val_fetch_data['time_finish']

                $timelimit = ''.$val_fetch_data['date_start'].' '.$val_fetch_data['time_finish'].'';
                
                $dataclass = [];

                $getallclass = "SELECT schedule_class.id_class AS id, master_class.name AS name FROM schedule_class JOIN master_class WHERE schedule_class.id_class = master_class.id GROUP BY schedule_class.id_class ORDER BY master_class.name ASC";
                $ex_getallclass = $this->antrian_db->prepare($getallclass);
                $ex_getallclass->execute();
                $get_ex_getallclass = $ex_getallclass->fetchAll();

                foreach ($get_ex_getallclass as $return_ex_getdetailclass) {
                    $instructor_sort = [];

                    $getinstuctorinfo = "SELECT schedule_class.id_class , schedule_class.id_instructor , schedule_class.id_schedule_instructor, master_instructor.name, schedule_instructor.start_date, schedule_instructor.start_time, schedule_instructor.finish_time, schedule_instructor.quota_remain , schedule_class.id as id_schedule_class FROM schedule_class JOIN schedule_instructor JOIN master_instructor WHERE schedule_class.id_instructor = schedule_instructor.id_instructor AND master_instructor.id = schedule_class.id_instructor AND schedule_class.id_schedule_instructor = schedule_instructor.id AND schedule_instructor.quota_remain > 0 AND schedule_class.id_class=:idclassget AND schedule_instructor.start_date=:dateclassget ORDER BY schedule_instructor.start_date ASC";
                    $ex_getinstuctorinfo = $this->antrian_db->prepare($getinstuctorinfo);
                    $ex_getinstuctorinfo->bindParam("idclassget" , $return_ex_getdetailclass['id']);
                    $ex_getinstuctorinfo->bindParam("dateclassget" , $val_fetch_data['date_start']);
                    $ex_getinstuctorinfo->execute();
                    $run_getinstructioninfo = $ex_getinstuctorinfo->fetchAll();

                    foreach ($run_getinstructioninfo as $val_getinstructioninfo) {
                        array_push($instructor_sort, array(
                            "id_schedule"       => $val_getinstructioninfo['id_schedule_class'],
                            "instructor_id"     => $val_getinstructioninfo['id_instructor'],
                            "name_instructor"   => ''.$val_getinstructioninfo['name'].' | '.$val_getinstructioninfo['start_time'].' - '.$val_getinstructioninfo['finish_time'].'',
                            "time_start"        => $val_getinstructioninfo['start_time'],
                            "time_finish"       => $val_getinstructioninfo['finish_time']
                        ));
                    }

                    if (empty($instructor_sort)) {
                        $stat_ins_in_class = '( Not Available )';
                    }
                    else
                    {
                        $stat_ins_in_class = '';
                    }

                    array_push($dataclass, array(
                        "class_id"      => $return_ex_getdetailclass['id'],
                        "class_name"    =>  ''.$return_ex_getdetailclass['name'].' '.$stat_ins_in_class.'',
                        "info_instructor" => $instructor_sort
                    ));

                    // instructor info



                }

                array_push($return_alldata, array(
                    "info_date" => array(
                        "date_start" => $val_fetch_data['date_start']
                    ),
                    "schedule" => $dataclass
                ));



            }


            $result_data = array(
                "result" => $return_alldata
            );

            return $response->withJson(["status" => "Success", "data" => $result_data]);


        }else{
            $result = array(
                "message" => "Error"
            );
            return $response->withJson(["status" => "Failed", "data" => $result], 404);
        }
    });
    

    // post create booking class

    $app->post('/class/registration_newclass', function (Request $request, Response $response, array $args) use ($container) {
        
        if($this->who_is_it == "user"){
            // check param request
            $user_param = $request->getQueryParam("key");
            $result = [];
            if($user_param){
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud
                $key = $user_param;
                $sql = "SELECT * FROM user WHERE token=:token";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("token", $key);
                $stmt->execute();
                $user_id = $stmt->fetchAll()[0]['user_id'];

                if($user_id){

                    $user_param_req = $request->getParsedBody();

                    if ($user_param_req) {
                        $generate_id = md5((string)time('now'));
                        $generate_new_id = md5(sha1(date('Y-m-d H:i:s')));

                        $insert_newdata = "INSERT INTO class_booking (id, patient_id, id_schedule, created_date, created_by) VALUES (:id, :patient_id, :id_schedule, :created_date, :created_by)";
                        $ex_insertdata = $this->antrian_db->prepare($insert_newdata);
                        $ex_insertdata->bindvalue("id" , $generate_id);
                        $ex_insertdata->bindvalue("patient_id", $user_param_req['pasien_id']);
                        $ex_insertdata->bindvalue("id_schedule", $user_param_req['id_schedule']);
                        $ex_insertdata->bindvalue("created_date", date('Y-m-d H:i:s'));
                        $ex_insertdata->bindvalue("created_by", $user_id);
                        $ex_insertdata->execute();

                        $insert_newdata2 = "INSERT INTO class_booking_notification (id, id_class_booking, notification_value, created_date) VALUES (:id, :id_class_booking, :notification_value, :created_date)";
                        $ex_insertdata2 = $this->antrian_db->prepare($insert_newdata2);
                        $ex_insertdata2->bindvalue("id" , $generate_new_id);
                        $ex_insertdata2->bindvalue("id_class_booking", $generate_id);
                        $ex_insertdata2->bindvalue("notification_value","BOOKING ON PROCESS");
                        $ex_insertdata2->bindvalue("created_date", date('Y-m-d H:i:s'));
                        $ex_insertdata2->execute();

                        $insert_newdata3 = "SELECT * FROM schedule_class WHERE id=:idsi";
                        $ex_insertdata3  = $this->antrian_db->prepare($insert_newdata3);
                        $ex_insertdata3->bindParam("idsi", $user_param_req['id_schedule']);
                        $ex_insertdata3->execute();
                        $val_ex_insertdata3 = $ex_insertdata3->fetchAll()[0];

                        // $val_ex_insertdata3['id_schedule_instructor']

                        $insert_newdata4 = "SELECT * FROM schedule_instructor WHERE id=:id_choose_idsi";
                        $ex_insertdata4  = $this->antrian_db->prepare($insert_newdata4);
                        $ex_insertdata4->bindParam("id_choose_idsi", $val_ex_insertdata3['id_schedule_instructor']);
                        $ex_insertdata4->execute();
                        $val_ex_insertdata4 = $ex_insertdata4->fetchAll()[0];

                        $reduce_quota = $val_ex_insertdata4['quota_remain'] - 1;

                        $insert_newdata5 = "UPDATE schedule_instructor SET quota_remain=:quota_reduce WHERE id=:ins_id_quota";
                        $ex_insertdata5 = $this->antrian_db->prepare($insert_newdata5);
                        $ex_insertdata5->bindParam("ins_id_quota", $val_ex_insertdata3['id_schedule_instructor']);
                        $ex_insertdata5->bindValue("quota_reduce", $reduce_quota);
                        $ex_insertdata5->execute();
                        

                        return $response->withJson(["status" => "Success", "data" => array(
                                "booking_id" => $generate_id,
                                "message" => 'Booking Create Success'
                                )]);

                    }
                    else
                    {
                        return $response->withJson(["status" => "Failed", "data" => 'invalid data !'], 404);
                    }


                }else{
                    // kalau kosong maka tampilkan kosong
                    return $response->withJson(["status" => "Success", "data" => $result], 200);    
                }                
            }else{
                return $response->withJson(["status" => "Error1", "data" => "invalid param"], 400);
            }
        }

    });

    // get all list booking class from user id

    $app->get('/class/list_booking_class', function (Request $request, Response $response, array $args) use ($container) {

        if($this->who_is_it == "user"){
            // check param request
            $user_param = $request->getQueryParam("key");
            $result = [];
            if($user_param){
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud
                $key = $user_param;
                $sql = "SELECT * FROM user WHERE token=:token";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("token", $key);
                $stmt->execute();
                $user_id = $stmt->fetchAll()[0]['user_id'];

                if($user_id){

                    $listdataclass_booking = "SELECT * FROM class_booking WHERE created_by=:by_userid";
                    $ex_listdataclass = $this->antrian_db->prepare($listdataclass_booking);
                    $ex_listdataclass->bindParam("by_userid" , $user_id);
                    $ex_listdataclass->execute();
                    $run_listdataclass = $ex_listdataclass->fetchAll();

                    $dataresult = [];

                    foreach ($run_listdataclass as $val_datarun_listdataclass) {
                        // name patient
                        $patient_info       = "SELECT * FROM patient WHERE id=:patientid_class";
                        $ex_patient_info    = $this->antrian_db->prepare($patient_info);
                        $ex_patient_info->bindParam("patientid_class" , $val_datarun_listdataclass['patient_id']);
                        $ex_patient_info->execute();
                        $val_expatient_info = $ex_patient_info->fetchAll()[0];

                        // schedule_class
                        $schedule_class_info = "SELECT * FROM schedule_class WHERE id=:idscheduleclass";
                        $ex_schedule_class_info = $this->antrian_db->prepare($schedule_class_info);
                        $ex_schedule_class_info->bindParam("idscheduleclass", $val_datarun_listdataclass['id_schedule']);
                        $ex_schedule_class_info->execute();
                        $val_ex_schedule_class_info = $ex_schedule_class_info->fetchAll()[0];

                        // master_class
                        $get_master_class = "SELECT * FROM master_class WHERE id=:idmasterclass";
                        $ex_get_master_class = $this->antrian_db->prepare($get_master_class);
                        $ex_get_master_class->bindParam("idmasterclass" , $val_ex_schedule_class_info['id_class']);
                        $ex_get_master_class->execute();
                        $val_ex_get_master_class = $ex_get_master_class->fetchAll()[0];

                        $get_master_instructor = "SELECT * FROM master_instructor WHERE id=:idinstructor";
                        $ex_get_master_instructor = $this->antrian_db->prepare($get_master_instructor);
                        $ex_get_master_instructor->bindParam("idinstructor", $val_ex_schedule_class_info['id_instructor']);
                        $ex_get_master_instructor->execute();
                        $val_ex_get_master_instructor = $ex_get_master_instructor->fetchAll()[0];

                        // schedule_instructor
                        $get_schedule_instructor = "SELECT * FROM schedule_instructor WHERE id=:idscheduleins";
                        $ex_get_schedule_instructor = $this->antrian_db->prepare($get_schedule_instructor);
                        $ex_get_schedule_instructor->bindParam("idscheduleins", $val_ex_schedule_class_info['id_schedule_instructor']);
                        $ex_get_schedule_instructor->execute();
                        $val_ex_get_schedule_instructor = $ex_get_schedule_instructor->fetchAll()[0];


                        array_push($dataresult, array(
                            "booking_class_id" => $val_datarun_listdataclass['id'],
                            "patient_name" => $val_expatient_info['nama'],
                            "class_name" => $val_ex_get_master_class['name'],
                            "instructor_name" => $val_ex_get_master_instructor['name'],
                            "date_start_schedule" => $val_ex_get_schedule_instructor['start_date']
                        ));
                    }

                    return $response->withJson(["status" => "Success", "data" => $dataresult], 200);

                }else{
                    // kalau kosong maka tampilkan kosong
                    return $response->withJson(["status" => "Success", "data" => $result], 200);    
                }                
            }else{
                return $response->withJson(["status" => "Error1", "data" => "invalid param"], 400);
            }
        }

    });

    // get info booking class from idbookingclass
    
    
    $app->get('/class/list_booking_class/detail_booking/{id_booking_class}', function (Request $request, Response $response, array $args) use ($container) {

        if($this->who_is_it == "user"){
            // check param request
            $user_param = $request->getQueryParam("key");
            $result = [];
            if($user_param){
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud
                $key = $user_param;
                $sql = "SELECT * FROM user WHERE token=:token";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("token", $key);
                $stmt->execute();
                $user_id = $stmt->fetchAll()[0]['user_id'];

                $datares = [];

                $updated_date_classbook = [];

                if($user_id){
                    $bookingclass_id = $args['id_booking_class'];
                    // get info class_booking 

                    $infobooking = "SELECT * FROM class_booking WHERE id=:idbook";
                    $ex_infobooking = $this->antrian_db->prepare($infobooking);
                    $ex_infobooking->bindParam("idbook", $bookingclass_id);
                    $ex_infobooking->execute();
                    $val_ex_infobooking = $ex_infobooking->fetchAll()[0];

                    if ($val_ex_infobooking['status'] == 1) {
                        $payment_stat = 'WAITING CONFIRMATION FROM ADMIN';
                    }
                    elseif ($val_ex_infobooking['status'] == 0) {
                        $payment_stat = 'YOUR BOOKING CLASS HAS REJECTED BY ADMIN';
                    }
                    elseif ($val_ex_infobooking['status'] == 2) {
                        $payment_stat = 'WAITING PAYMENT FOR BOOKING CLASS';
                    }
                    elseif ($val_ex_infobooking['status'] == 3) {
                        $payment_stat = 'PAYMENT ON PROCESS CHECKED';
                    }
                    elseif ($val_ex_infobooking['status'] == 4) {
                        $payment_stat = 'PAYMENT RECEIPT REJECTED. PLEASE RE-UPLOAD YOUR PAYMENT RECEIPT OR CONTACT ADMINISTRATOR';
                    }
                    elseif ($val_ex_infobooking['status'] == 5) {
                        $payment_stat = 'PAYMENT SUCCESS ! BOOKING ACCEPTED ';
                    }
                    elseif ($val_ex_infobooking['status'] == 6) {
                        $payment_stat = 'BOOKING CLASS HAS REJECTED BY USER';
                    }
                    elseif ($val_ex_infobooking['status'] == 7) {
                        $payment_stat = 'BOOKING CLASS HAS EMPTY. PLEASE SELECT ANOTHER CLASS';
                    }
                    elseif ($val_ex_infobooking['status'] == 8) {
                        $payment_stat = 'PAYMENT RECEIPT HAS NOT BEEN UPLOADED. BOOKING CLASS CANCEL AUTOMATICALLY';
                    }

                    // name patient
                        $patient_info       = "SELECT * FROM patient WHERE id=:patientid_class";
                        $ex_patient_info    = $this->antrian_db->prepare($patient_info);
                        $ex_patient_info->bindParam("patientid_class" , $val_ex_infobooking['patient_id']);
                        $ex_patient_info->execute();
                        $val_expatient_info = $ex_patient_info->fetchAll()[0];

                        // schedule_class
                        $schedule_class_info = "SELECT * FROM schedule_class WHERE id=:idscheduleclass";
                        $ex_schedule_class_info = $this->antrian_db->prepare($schedule_class_info);
                        $ex_schedule_class_info->bindParam("idscheduleclass", $val_ex_infobooking['id_schedule']);
                        $ex_schedule_class_info->execute();
                        $val_ex_schedule_class_info = $ex_schedule_class_info->fetchAll()[0];

                        // master_class
                        $get_master_class = "SELECT * FROM master_class WHERE id=:idmasterclass";
                        $ex_get_master_class = $this->antrian_db->prepare($get_master_class);
                        $ex_get_master_class->bindParam("idmasterclass" , $val_ex_schedule_class_info['id_class']);
                        $ex_get_master_class->execute();
                        $val_ex_get_master_class = $ex_get_master_class->fetchAll()[0];

                        $get_master_instructor = "SELECT * FROM master_instructor WHERE id=:idinstructor";
                        $ex_get_master_instructor = $this->antrian_db->prepare($get_master_instructor);
                        $ex_get_master_instructor->bindParam("idinstructor", $val_ex_schedule_class_info['id_instructor']);
                        $ex_get_master_instructor->execute();
                        $val_ex_get_master_instructor = $ex_get_master_instructor->fetchAll()[0];

                        // schedule_instructor
                        $get_schedule_instructor = "SELECT * FROM schedule_instructor WHERE id=:idscheduleins";
                        $ex_get_schedule_instructor = $this->antrian_db->prepare($get_schedule_instructor);
                        $ex_get_schedule_instructor->bindParam("idscheduleins", $val_ex_schedule_class_info['id_schedule_instructor']);
                        $ex_get_schedule_instructor->execute();
                        $val_ex_get_schedule_instructor = $ex_get_schedule_instructor->fetchAll()[0];


                        // array_push($datares, array(
                        //     "booking_class_id" => $val_ex_infobooking['id'],
                        //     "patient_name" => $val_expatient_info['nama'],
                        //     "class_name" => $val_ex_get_master_class['name'],
                        //     "instructor_name" => $val_ex_get_master_instructor['name'],
                        //     "date_start_schedule" => $val_ex_get_schedule_instructor['start_date'],
                        //     "start_time_schedule" => $val_ex_get_schedule_instructor['start_time'],
                        //     "finish_time_schedule" => $val_ex_get_schedule_instructor['finish_time'],
                        //     "register_date" => $val_ex_infobooking['created_date'],
                        //     "booking_status" => $payment_stat
                        // ));

                        array_push($updated_date_classbook, array(
                            "updated_date" => $val_ex_infobooking['updated_date'],
                            "status_code" => $val_ex_infobooking['status'],
                            "status" => $payment_stat
                        ));

                    $valresult = array(
                        "message" => "data found",
                        "data" => array(
                            "booking_id" => $val_ex_infobooking['id'],
                            "details" => array(
                                "patient_name" => $val_expatient_info['nama'],
                            "class_name" => $val_ex_get_master_class['name'],
                            "instructor_name" => $val_ex_get_master_instructor['name'],
                            "date_start_schedule" => $val_ex_get_schedule_instructor['start_date'],
                            "start_time_schedule" => $val_ex_get_schedule_instructor['start_time'],
                            "finish_time_schedule" => $val_ex_get_schedule_instructor['finish_time'],
                            "register_date" => $val_ex_infobooking['created_date'],
                            ),
                        "status" => $updated_date_classbook
                        )
                    );
                    return $response->withJson(["status" => "Success", "data" => $valresult], 200);  


                }else{
                    // kalau kosong maka tampilkan kosong
                    return $response->withJson(["status" => "Success", "data" => $result], 200);    
                }                
            }else{
                return $response->withJson(["status" => "Error1", "data" => "invalid param"], 400);
            }
        }

    });

    // post payment evidence
    
    $app->post('/class/submit_payment_bookingclass', function (Request $request, Response $response, array $args) use ($container) {

        if($this->who_is_it == "user"){
            // check param request
            $user_param = $request->getQueryParam("key");
            $result = [];
            if($user_param){
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud
                $key = $user_param;
                $sql = "SELECT * FROM user WHERE token=:token";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("token", $key);
                $stmt->execute();
                $user_id = $stmt->fetchAll()[0]['user_id'];

                if($user_id){
                    $datagetrequest = $request->getParsedBody();
                    $randstring = md5(sha1(date('Y-m-d H:i:s')));

                    $folder_upload = "src/uploads/booking_transfer_evidence/";
                    $container['upload_directory'] = __DIR__ . '/uploads/booking_transfer_evidence/';
                    
                    $directory = $container['upload_directory'];
                    $uploadedFiles = $request->getUploadedFiles();

                    $uploadedFile = $uploadedFiles['payment_attached'];

                    $filename = moveUploadedFile($directory, $uploadedFile);

                    $updatedata_booking_class = "UPDATE class_booking SET status=:statusvalue , payment_attached=:pay_attach , updated_date=:dateupdated WHERE id=:bookidclass";
                    $ex_updatedata_booking_class = $this->antrian_db->prepare($updatedata_booking_class);
                    $ex_updatedata_booking_class->bindValue("statusvalue" , "3");
                    $ex_updatedata_booking_class->bindValue("pay_attach" , $folder_upload."".$filename);
                    $ex_updatedata_booking_class->bindValue("dateupdated" , date('Y-m-d H:i:s'));
                    $ex_updatedata_booking_class->bindParam("bookidclass" , $datagetrequest['booking_class_id']);
                    $ex_updatedata_booking_class->execute();

                    // class booking notification 

                    $insert_newdata2 = "INSERT INTO class_booking_notification (id, id_class_booking, notification_value, created_date) VALUES (:id, :id_class_booking, :notification_value, :created_date)";
                        $ex_insertdata2 = $this->antrian_db->prepare($insert_newdata2);
                        $ex_insertdata2->bindvalue("id" , $randstring);
                        $ex_insertdata2->bindvalue("id_class_booking", $datagetrequest['booking_class_id']);
                        $ex_insertdata2->bindvalue("notification_value", "PAYMENT ON PROCESS CHECKED FROM ADMIN");
                        $ex_insertdata2->bindvalue("created_date", date('Y-m-d H:i:s'));
                        $ex_insertdata2->execute();

                    $datareschange = array(
                        "message" => "upload data success !"
                    );

                    return $response->withJson(["status" => "Success", "data" => $datareschange], 200);


                }else{
                    // kalau kosong maka tampilkan kosong
                    return $response->withJson(["status" => "Success", "data" => $result], 200);    
                }                
            }else{
                return $response->withJson(["status" => "Error1", "data" => "invalid param"], 400);
            }
        }

    });

    // post cancel bookingclass from user

    $app->post('/class/booking_class/cancel', function (Request $request, Response $response, array $args) use ($container) {

        if($this->who_is_it == "user"){
            // check param request
            $user_param = $request->getQueryParam("key");
            $result = [];
            if($user_param){
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud
                $key = $user_param;
                $sql = "SELECT * FROM user WHERE token=:token";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("token", $key);
                $stmt->execute();
                $user_id = $stmt->fetchAll()[0]['user_id'];

                if($user_id){
                        
                    $val_data_cancel = 6;

                    $gen_id = md5(sha1(date('Y-m-d H:i:s')));

                    $requestdata_cancel = $request->getParsedBody();
                    $cancel_databooking = "UPDATE class_booking SET status=:stat_booking WHERE id=:idbookingclass";
                    $ex_cancel_databooking = $this->antrian_db->prepare($cancel_databooking);
                    $ex_cancel_databooking->bindParam("idbookingclass", $requestdata_cancel['booking_class_id']);
                    $ex_cancel_databooking->bindParam("stat_booking", $val_data_cancel);
                    $ex_cancel_databooking->execute();
                    
                    $insert_newdata2 = "INSERT INTO class_booking_notification (id, id_class_booking, notification_value, created_date) VALUES (:id, :id_class_booking, :notification_value, :created_date)";
                        $ex_insertdata2 = $this->antrian_db->prepare($insert_newdata2);
                        $ex_insertdata2->bindvalue("id" , $gen_id);
                        $ex_insertdata2->bindvalue("id_class_booking", $requestdata_cancel['booking_class_id']);
                        $ex_insertdata2->bindvalue("notification_value","BOOKING CLASS CANDELED BY USER");
                        $ex_insertdata2->bindvalue("created_date", date('Y-m-d H:i:s'));
                        $ex_insertdata2->execute();

                    // return quota 

                    $booking_id = $requestdata_cancel['booking_class_id'];

                    $getscheduleinfo = "SELECT * FROM class_booking WHERE id=:idbook";
                    $ex_getscheduleinfo = $this->antrian_db->prepare($getscheduleinfo);
                    $ex_getscheduleinfo->bindParam("idbook", $booking_id);
                    $ex_getscheduleinfo->execute();
                    $run_exgetschedule = $ex_getscheduleinfo->fetchAll()[0];


                        $insert_newdata3 = "SELECT * FROM schedule_class WHERE id=:idsi";
                        $ex_insertdata3  = $this->antrian_db->prepare($insert_newdata3);
                        $ex_insertdata3->bindParam("idsi", $run_exgetschedule['id_schedule']);
                        $ex_insertdata3->execute();
                        $val_ex_insertdata3 = $ex_insertdata3->fetchAll()[0];

                        // $val_ex_insertdata3['id_schedule_instructor']

                        $insert_newdata4 = "SELECT * FROM schedule_instructor WHERE id=:id_choose_idsi";
                        $ex_insertdata4  = $this->antrian_db->prepare($insert_newdata4);
                        $ex_insertdata4->bindParam("id_choose_idsi", $val_ex_insertdata3['id_schedule_instructor']);
                        $ex_insertdata4->execute();
                        $val_ex_insertdata4 = $ex_insertdata4->fetchAll()[0];

                        $reduce_quota = $val_ex_insertdata4['quota_remain'] + 1;

                        $insert_newdata5 = "UPDATE schedule_instructor SET quota_remain=:quota_reduce WHERE id=:ins_id_quota";
                        $ex_insertdata5 = $this->antrian_db->prepare($insert_newdata5);
                        $ex_insertdata5->bindParam("ins_id_quota", $val_ex_insertdata3['id_schedule_instructor']);
                        $ex_insertdata5->bindValue("quota_reduce", $reduce_quota);
                        $ex_insertdata5->execute();
                    

                    $res_message = array(
                        "message" => "BOOKING CLASS CANDELED BY USER"
                    );

                    return $response->withJson(["status" => "Success", "data" => $res_message], 200);


                }else{
                    // kalau kosong maka tampilkan kosong
                    return $response->withJson(["status" => "Success", "data" => $result], 200);    
                }                
            }else{
                return $response->withJson(["status" => "Error1", "data" => "invalid param"], 400);
            }
        }

    });


    // post reselect schedule class booking

    $app->post('/class/edit_class_booking/{id}', function (Request $request, Response $response, array $args) use ($container) {

        if($this->who_is_it == "user"){
            // check param request
            $user_param = $request->getQueryParam("key");
            $result = [];
            if($user_param){
                // kalau valid dan ada isinya
                // cek dari db patient, tampilkan yang sesuai dg id yang dimaksud
                $key = $user_param;
                $sql = "SELECT * FROM user WHERE token=:token";

                $stmt = $this->db->prepare($sql);
                $stmt->bindParam("token", $key);
                $stmt->execute();
                $user_id = $stmt->fetchAll()[0]['user_id'];

                if($user_id){

                    $idbookclass = $args['id'];
                    $user_param_req = $request->getParsedBody();
                    $quick_finish_stat = 5;
                    $generate_new_id = md5(sha1(date('Y-m-d H:i:s')));

                    $insert_newdata = "UPDATE class_booking SET patient_id=:pat_id , id_schedule=:idsch , status=:statedit , updated_date=:dateupdate WHERE id=:ideditclassbook ";
                        $ex_insertdata = $this->antrian_db->prepare($insert_newdata);
                        $ex_insertdata->bindvalue("pat_id", $user_param_req['patient_id']);
                        $ex_insertdata->bindvalue("idsch", $user_param_req['id_schedule']);
                        $ex_insertdata->bindvalue("statedit", $quick_finish_stat);
                        $ex_insertdata->bindvalue("dateupdate", date('Y-m-d H:i:s'));
                        $ex_insertdata->bindParam("ideditclassbook", $idbookclass);
                        $ex_insertdata->execute();

                        $insert_newdata2 = "INSERT INTO class_booking_notification (id, id_class_booking, notification_value, created_date) VALUES (:id, :id_class_booking, :notification_value, :created_date)";
                        $ex_insertdata2 = $this->antrian_db->prepare($insert_newdata2);
                        $ex_insertdata2->bindvalue("id" , $generate_new_id);
                        $ex_insertdata2->bindvalue("id_class_booking", $idbookclass);
                        $ex_insertdata2->bindvalue("notification_value","BOOKING CLASS SUCCESS");
                        $ex_insertdata2->bindvalue("created_date", date('Y-m-d H:i:s'));
                        $ex_insertdata2->execute();

                        $messagedata = array(
                            "message" => 'Booking edit success'
                        );

                    return $response->withJson(["status" => "Success", "data" => $messagedata]);

                }else{
                    // kalau kosong maka tampilkan kosong
                    return $response->withJson(["status" => "Success", "data" => $result], 200);    
                }                
            }else{
                return $response->withJson(["status" => "Error1", "data" => "invalid param"], 400);
            }
        }

    });

    $app->get('/doctor/info_absent', function (Request $request, Response $response, array $args) use ($container){


        
        // check is admin?
        if($this->who_is_it == "user"){
            $min_count = -1;
            // initiate param
            $schedules = array();
            // get poly name
            $poly_query = $this->antrian_db->prepare("SELECT id, poly_code, name, id_specialist FROM master_poly WHERE is_deleted=0");
            $poly_query->execute();
            $polys = $poly_query->fetchAll();

            // get list doctors
            $doctor_query = $this->antrian_db->prepare("SELECT id, id_specialist, name , image , experience FROM master_doctor WHERE is_deleted=0");
            $doctor_query->execute();
            $doctors = $doctor_query->fetchAll();

            // get all specialist
            $specialist_query = $this->antrian_db->prepare("SELECT * FROM master_specialist WHERE is_deleted=0");
            $specialist_query->execute();
            $specialists = $specialist_query->fetchAll();

            foreach($polys as $poly){
                $list_doctors = array();

                foreach($doctors as $item_doctors){
                    if($item_doctors['id_specialist'] == $poly['id_specialist']){

                        $array_schedules = array();

                        $sql_doc_absent2 = "SELECT * FROM doctor_absent WHERE id_doktor=:doc_id ORDER BY result_api ASC";
                        $run_doc_absent2 = $this->antrian_db->prepare($sql_doc_absent2);
                        $run_doc_absent2->bindParam("doc_id" , $item_doctors['id']);
                        $run_doc_absent2->execute();
                        $all_doc_absent2 = $run_doc_absent2->fetchAll();

                        foreach ($all_doc_absent2 as $val_all_doc_absent2) {
                            array_push($array_schedules,
                                    array(
                                        "day"  => $val_all_doc_absent2['day'],
                                        "jam_absen" => ''.$val_all_doc_absent2['start_absent'].' - '.$val_all_doc_absent2['end_absent'].''
                                    )                                
                                );
                        }

                        //get list schedule
                        $tgl_sekarang = "";
                        $tgl_seminggu = "";
                        $currentdatenow = date('Y-m-d H:i:s');

                        $listschedule_query = $this->antrian_db->prepare("SELECT * FROM master_practice_schedule WHERE id_doctor=:id_doctor AND id_poly=:id_poly AND date > :getcurdate GROUP BY date ORDER BY date ASC");
                        $listschedule_query->bindParam("id_doctor", $item_doctors['id']);
                        $listschedule_query->bindParam("id_poly", $poly['id']);
                        $listschedule_query->bindParam("getcurdate", $currentdatenow);                     
                        $listschedule_query->execute();
                        $listschedules = $listschedule_query->fetchAll();      
                        
                        foreach($listschedules as $val_listschedules) {

                        $listschedule_query2 = $this->antrian_db->prepare("SELECT * FROM master_practice_schedule WHERE id_doctor=:id_doctor AND id_poly=:id_poly AND date = :dateselected ORDER BY start_time_service ASC");
                        $listschedule_query2->bindParam("id_doctor", $item_doctors['id']);
                        $listschedule_query2->bindParam("id_poly", $poly['id']);
                        $listschedule_query2->bindParam("dateselected", $val_listschedules['date']);                     
                        $listschedule_query2->execute();
                        $listschedules2 = $listschedule_query2->fetchAll()[0];

                        $listschedule_query3 = $this->antrian_db->prepare("SELECT * FROM master_practice_schedule WHERE id_doctor=:id_doctor AND id_poly=:id_poly AND date = :dateselected ORDER BY finish_time_service DESC");
                        $listschedule_query3->bindParam("id_doctor", $item_doctors['id']);
                        $listschedule_query3->bindParam("id_poly", $poly['id']);
                        $listschedule_query3->bindParam("dateselected", $val_listschedules['date']);                     
                        $listschedule_query3->execute();
                        $listschedules3 = $listschedule_query3->fetchAll()[0];

                    }

                        $specialist_name = "";
                        foreach($specialists as $item_specialist){
                            if($item_specialist['id'] == $item_doctors['id_specialist']){
                                $specialist_name = $item_specialist['name'];
                            }
                        }

                            array_push($list_doctors,
                                array(
                                    "name" => $item_doctors['name'],
                                    "specialist"=> $specialist_name,
                                    "image_url" =>  'https://bwcc.inovasialfatih.com/admin/'.$item_doctors['image'],
                                    "experience" => $item_doctors['experience'],
                                    "jadwal_absen" => $array_schedules
                                )                                
                            );

                    }
                
                }

                if(count($list_doctors) > $min_count){
                    array_push(
                        $schedules, array(
                            "poly_id" => $poly['id'],
                            "poly_name" => $poly['name'],
                            "doctors" => $list_doctors
                        )
                    );
                }
            }                   

            $result = array(
                "message" => "yes",
                // "schedule" => $schedules
                "schedule" => $schedules
            );

            return $response->withJson(["status" => "Success", "data" => $result], 200);
        }else{
            $schedules = NULL;
            $result = array(
                "message" => "no",
                "schedule" => $schedules
            );

            return $response->withJson(["status" => "Failed", "data" => $result], 200);
        }

    });

// ----------------------------------------------------------------------------------- //

    function moveUploadedFile($directory, UploadedFile $uploadedFile)
    {
        $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $filename = sprintf('%s.%0.8s', $basename, $extension);

        $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

        return $filename;
    }


};


