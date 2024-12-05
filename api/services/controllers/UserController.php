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

            case 'DELETE':
                $res = $this->user_gateway->deleteUser($id);
                if ($res) {
                    http_response_code(200);
                    echo json_encode(["id" => $res['user_id'] ,"message" => "Usuario eliminado"]);
                } else {
                    http_response_code(500);
                    echo json_encode(["message" => "Error al eliminar el usuario"]);
                }
                break;

            default:
                http_response_code(405);
                break;
        }
    }

    private function processCollectionRequest(string $method) : void  {
        switch ($method) {
            case 'GET':
                $users = $this->user_gateway->getUserInfo();
                echo json_encode($users);
                break;

            case 'POST':
                $data = json_decode(file_get_contents("php://input"));
                if ($data) {

                    $res = $this->user_gateway->addUser($data->user_data);

                    if (!isset($res["id"])) {
                        http_response_code(500);
                        throw new Exception("Error al crear el usuario.");
                    }
                
                    $user_id = (int) $res["id"];

                    foreach ($data -> skills as $skill) {
                        $skill_data = [
                            "skill_id" => $skill->skill_id,
                            "user_id" => (int) $user_id,
                            "intensity" => $skill->intensity
                        ];
                        $this->user_gateway->addSkillforUser($skill_data);
                    };

                    foreach ($data -> strengths as $strength) {
                        $strength_data = [
                            "strength_id" => $strength->strength_id,
                            "user_id" => $user_id,
                            "value" => $strength->value
                        ];
                        $this->user_gateway->addStrengthforUser($strength_data);
                    };

                    foreach ($data -> goals as $goal) {
                        $goal_data = [
                            "goal" => $goal->goal,
                            "user_id" => $user_id
                        ];
                        $this->goal_gateway->addGoal($goal_data);
                    };

                    foreach ($data->projects as $project) {
                        $project_data = [
                            "project_id" => $project->project_id,
                            "user_id" => $user_id
                        ];
                        $this->user_gateway->addProjectforUser($project_data);
                    };

                    http_response_code(201);
                    echo json_encode([
                        "id" => $res["id"],
                        "name" => $res["name"],
                        "last_name" => $res["last_name"],
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