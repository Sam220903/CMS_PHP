<?php
	$debug		=	true		;
	$key		=	"12345"		;
    /*
    $connection   =   array(
        "servername" =>   "localhost", 
        "username"   =>   "usercms",
        "password"   =>   "usercms",
        "dbname"     =>   "proyecto"
    );
    
    */

    $database = new Database("localhost", "proyecto", "user1", "user1");
    
	$data = array(
        "cms/UserGateway.php",
        "cms/SkillGateway.php",
        "cms/StrengthGateway.php",
        "cms/GoalGateway.php",
        "cms/ProjectGateway.php"
    );