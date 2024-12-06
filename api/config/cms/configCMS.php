<?php
	$debug		=	true		;
	$key		=	"12345"		;

    $database = new Database("localhost", "project", "user1", "user1");
    
	$data = array(
        "cms/UserGateway.php",
        "cms/SkillGateway.php",
        "cms/StrengthGateway.php",
        "cms/GoalGateway.php",
        "cms/ProjectGateway.php",
        "cms/AdminGateway.php",
    );