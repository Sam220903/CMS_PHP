<?php
	$config	='cms/configCMS.php';
	include_once '../base/header.php';


	spl_autoload_register(function($class){
		include 'controllers/'.$class.'.php';
	});


	$parts = explode("/", $_SERVER["REQUEST_URI"]);
	$id = $parts[5] ?? null;
	
	$user_gateway = new UserGateway($database);
	$skill_gateway = new SkillGateway($database);
	$strength_gateway = new StrengthGateway($database);
	$goal_gateway = new GoalGateway($database);
	$project_gateway = new ProjectGateway($database);

	switch($parts[4]){

		case 'users':
			$user_controller = new UserController($user_gateway, $skill_gateway, $strength_gateway, $goal_gateway, $project_gateway);
			$user_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		case 'skills': 
			$skill_controller = new SkillController($skill_gateway);
			$skill_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		case 'strengths':
			$strength_controller = new StrengthController($strength_gateway);
			$strength_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		case 'goals':
			$goal_controller = new GoalController($goal_gateway);
			$goal_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		case 'projects':
			$project_controller = new ProjectController($project_gateway);
			$project_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		default:
			http_response_code(404);
			break;
			exit;
	}
		

	
	
	
	
	
     /*
	 
	 switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            $numCards = isset($_GET['numCards']) ? $_GET['numCards'] : null;
            $cardID = isset($_GET['cardID']) ? $_GET['cardID'] : null;
            $conn = connection($connection);
            $res = getLottery($conn, $numCards, $cardID);
            $array = array();
            $array['status'] = 200;
            $array['error'] = false;
            $array['data'] = json_decode($res);
            $array=json_encode($array);
            echo $array;
            die();
        break;

        case 'POST':
            if($data = json_decode(file_get_contents("php://input"))){
				$conn  = connection($connection);
				$res  = insertCard($conn,$data);
				$array = array();
				$array['status'] = 200;
				$array['error'] = false;
				$array['data'] = json_decode($res);
				$array=json_encode($array);
				echo $array;
				die();
			}else{
				$array=array();
				$array['status'] = 400;
				$array['error'] = "Error de datos";
				$array['data'] = "";
				$array=json_encode($array);
				echo $array;
				die();
			}
        break;
        default: break;
    }
	 
	 */
                    
?>