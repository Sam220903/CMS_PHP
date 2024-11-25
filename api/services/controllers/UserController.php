<?php

class UserController {

    public function __construct(private UserGateway $user_gateway, private SkillGateway $skill_gateway, private StrengthGateway $strength_gateway, private GoalGateway $goal_gateway, private ProjectGateway $project_gateway) {}

    public function processRequest(string $method, ?string $id) : void  {
        if ($id) {
            $this->processResourseRequest($method, $id);
        } else {
            $this->processCollectionRequest($method);
        }
    }

    private function processResourseRequest(string $method, string $id) : void  {
        switch($method){
            case 'GET':
                $user = $this->user_gateway->getUserbyID($id);
                $skills =$this->skill_gateway->getSkillsbyUser($id);
                $strengths = $this->strength_gateway->getStrengthsbyUser($id);
                $goals = $this->goal_gateway->getGoalsbyUser($id);
                $projects = $this->project_gateway->getProjectsbyUser($id);
                $user[0]['skills'] = $skills;
                $user[0]['strengths'] = $strengths;
                $user[0]['goals'] = $goals;
                $user[0]['projects'] = $projects;
                echo json_encode($user);
                break;
            default:
                http_response_code(405);
                break;
        }
    }

    private function processCollectionRequest(string $method) : void  {
        switch ($method) {
            case 'GET':
                $users = $this->user_gateway->getAll();
                echo json_encode($users);
                break;

            case 'POST':
                $data = json_decode(file_get_contents("php://input"));
                if ($data) {
                    $res = $this->user_gateway->addUser($data);
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