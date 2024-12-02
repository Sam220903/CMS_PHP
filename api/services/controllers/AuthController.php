<?php

class AuthController{

    public function __construct(private AdminGateway $gateway){}

    public function authenticate() : void{
        $data = json_decode(file_get_contents("php://input"));
        if ($data){
            $res = $this -> gateway -> login($data -> username, $data -> password);
            if ($res){
                $token = JWT::generateToken($res);
                http_response_code(200);
                echo json_encode([
                    "message" => "Autenticación exitosa",
                    "token" => $token,
                    "user" => [
                        "id" => $res["id"],
                        "username" => $res["username"],
                        "allowed" => true,
                    ]
                ]);
            } else {
                http_response_code(401);
                echo json_encode([
                    "message" => "Usuario o contraseña incorrectos",
                    "allowed" => false,
                ]);
            }
        } else {
            http_response_code(405);
        }
    }
}