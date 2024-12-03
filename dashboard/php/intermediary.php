<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PATCH,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


define("UTF8",JSON_UNESCAPED_UNICODE);

function curlPHP($url,$metodo,$datos,$auth){
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $metodo,
        CURLOPT_POSTFIELDS => $datos,
        CURLOPT_HTTPHEADER => array(
            'Authorization: '.$auth,
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    return array("response"=>$response,"http_code"=>$http_code);
}

$data = json_decode(file_get_contents("php://input"));
if(isset($data->endpoint)){


    if($data->method == "GET"){
        if($data->endpoint == "getSkills"){
            $url = "http://localhost/Proyecto/api/services/skills/";
            $method = "GET";
            $data = "";
            $auth = "";
            $result = curlPHP($url,$method,$data,$auth);
            $response = $result['response'];
            $http_code = $result['http_code'];
            if($http_code == 200){
                http_response_code(200);
                echo $response;
            } else {
                http_response_code(404);
                echo json_encode(["message"=>"No se encontraron habilidades"],UTF8);
                die();
            }
        } else if($data->endpoint == "getStrengths"){
            $url = "http://localhost/Proyecto/api/services/strengths/";
            $method = "GET";
            $data = "";
            $auth = "";
            $result = curlPHP($url,$method,$data,$auth);
            $response = $result['response'];
            $http_code = $result['http_code'];
            if($http_code == 200){
                http_response_code(200);
                echo $response;
            } else {
                http_response_code(404);
                echo json_encode(["message"=>"No se encontraron fortalezas"],UTF8);
                die();
            }
        } else if($data->endpoint == "getProjects"){
            $url = "http://localhost/Proyecto/api/services/projects/";
            $method = "GET";
            $data = "";
            $auth = "";
            $result = curlPHP($url,$method,$data,$auth);
            $response = $result['response'];
            $http_code = $result['http_code'];
            if($http_code == 200){
                http_response_code(200);
                echo $response;
            } else {
                http_response_code(404);
                echo json_encode(["message"=>"No se encontraron proyectos"],UTF8);
                die();
            }
        } else if($data->endpoint == "getUsers"){
            $url = "http://localhost/Proyecto/api/services/users/";
            $method = "GET";
            $data = "";
            $auth = "";
            $result = curlPHP($url,$method,$data,$auth);
            $response = $result['response'];
            $http_code = $result['http_code'];
            if($http_code == 200){
                http_response_code(200);
                echo $response;
            } else {
                http_response_code(404);
                echo json_encode(["message"=>"No se encontraron usuarios"],UTF8);
                die();
            
            }
        
        } else {
            http_response_code(404);
            $array = array("status"=>404,"message"=>"Not Found");
            echo json_encode($array,UTF8);
            die();
        }

        
    }


    else if($data->method == "POST"){
        if($data->endpoint == "login"){
            if(isset($data->credentials)){
                $url = "http://localhost/Proyecto/api/services/login/";
                $method = "POST";
                $data = json_encode($data->credentials);
                $auth = "";
                $result = curlPHP($url,$method,$data,$auth);

                $response = $result['response'];
                $http_code = $result['http_code'];
                
                if($http_code == 200){
                    http_response_code(200);
                    echo $response;
                } else {
                    http_response_code(404);
                    echo json_encode(["message"=>"Datos de usuario inválidos"],UTF8);
                    die();
                }

            } else {
                http_response_code(404);
                echo json_encode(["message"=>"Datos de usuario inválidos"],UTF8);
                die();
            }
        } else {
            http_response_code(404);
            $array = array("status"=>404,"message"=>"Not Found");
            echo json_encode($array,UTF8);
            die();
        }
        
    } else {
        http_response_code(404);
        $array = array("status"=>404,"message"=>"Acción desconocida");
        echo json_encode($array,UTF8);
        die();

    }
    
} else {
    http_response_code(404);
    $array = array("status"=>404,"message"=>"Endpoint no encontrado");
    echo json_encode($array,UTF8);
    die();
}

function saveImage($image){
    $image_parts = explode(";base64,", $image);
    $image_base64 = base64_decode($image_parts[1]);
    $file_name = uniqid().".jpg";
    $file = "../../api/img/lottery/".$file_name;
    file_put_contents($file, $image_base64);
    return $file_name;  
}