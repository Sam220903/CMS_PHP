<?php

class SkillController{

    public function __construct(private SkillGateway $gateway){}

    public function processRequest(string $method, ?string $id) : void  {
        if ($id) {
            $this->processResourseRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    public function processResourceRequest(string $method, string $id) : void{
        switch($method){
            default:
                break;
        }
    }

    public function processCollectionRequest(string $method) : void{
        switch ($method) {
            case 'GET':
                $skills = $this->gateway->getAll();
                echo json_encode($skills);
                break;
            
            case 'POST':
                $data = json_decode(file_get_contents("php://input"));
                if ($data){
                    $res = $this -> gateway -> addSkill($data);
                    http_response_code(201);
                    echo json_encode([
                        "id" => $res["id"],
                        "skill" => $res["skill"],
                        "message" => "Habilidad añadida"
                    ]);
                } else {
                    http_response_code(405);
                    break;
                }
        }
    }
}