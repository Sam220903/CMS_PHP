<?php

class UserController {

    public function __construct(private UserGateway $gateway) {}

    public function processRequest(string $method, ?string $id) : void  {
        if ($id) {
            $this->processResourseRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    private function processResourseRequest(string $method, string $id) : void  {
        
    }

    private function processCollectionRequest(string $method) : void  {
        switch ($method) {
            case 'GET':
                $users = $this->gateway->getAll();
                echo json_encode($users);
                break;

            case 'POST':
                $data = json_decode(file_get_contents("php://input"));
                if ($data) {
                    $res = $this->gateway->addUser($data);
                    http_response_code(201);
                    echo json_encode([
                        "id" => $res["id"],
                        "username" => $res["username"], 
                        "message" => "Usuario creado"
                    ]);
                } else {
                    http_response_code(400);
                    echo json_encode(["error" => "Error de datos"]);
                }
                break;
            default:
                http_response_code(405);
                break;
        }  
    }

}