<?php
	$config	='cms/configCMS.php';
	include_once '../base/header.php';
	include_once '../base/auth/middleware.php';


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
	$admin_gateway = new AdminGateway($database);


	if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Authorization');
		header('Access-Control-Max-Age: 3600');
		http_response_code(204);
		exit();
	}

	switch($parts[4]){

		case 'login':
			$auth_controller = new AuthController($admin_gateway);
			$result = $auth_controller->authenticate();
			break;

		case 'users':
			$user_controller = new UserController($user_gateway, $skill_gateway, $strength_gateway, $goal_gateway, $project_gateway);
			$user_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		case 'skills': 
			middlewareAuth();
			$skill_controller = new SkillController($skill_gateway);
			$skill_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		case 'strengths':
			middlewareAuth();
			$strength_controller = new StrengthController($strength_gateway);
			$strength_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		case 'goals':
			middlewareAuth();
			$goal_controller = new GoalController($goal_gateway);
			$goal_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		case 'projects':
			middlewareAuth();
			$project_controller = new ProjectController($project_gateway);
			$project_controller->processRequest($_SERVER['REQUEST_METHOD'], $id);
			break;

		default:
			http_response_code(404);
			break;
			exit;
	}
                    
?>