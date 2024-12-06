<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PATCH,DELETE,OPTIONS");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


define("UTF8",JSON_UNESCAPED_UNICODE);

function saveImage($image){
    $image_parts = explode(";base64,", $image);
    $image_base64 = base64_decode($image_parts[1]);
    $file_name = uniqid().".jpg";
    $file = "../../api/img/".$file_name;
    file_put_contents($file, $image_base64);
    return $file_name;  
}

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

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PATCH, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Access-Control-Max-Age: 3600');
    http_response_code(204);
    exit();
}

$data = json_decode(file_get_contents("php://input"));

$auth = isset($data->token) ? $data->token : "";

if(isset($data->endpoint)){
    if($data->method == "GET"){
        if($data->endpoint == "getSkills"){
            $url = "http://localhost/Proyecto/api/services/skills/";
            $method = "GET";
            $data = "";
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

        
    } else if($data->method == "POST"){
        if($data->endpoint == "addSkill"){
            if(isset($data->skill)){
                $url = "http://localhost/Proyecto/api/services/skills/";
                $method = "POST";
                $data = json_encode(["skill"=>$data->skill],UTF8);
                $result = curlPHP($url,$method,$data,$auth);

                $response = $result['response'];
                $http_code = $result['http_code'];
                
                if($http_code == 201){
                    http_response_code(200);
                    echo $response;
                } else {
                    http_response_code(404);
                    echo json_encode(["message"=>"Error de datos"],UTF8);
                    die();
                }

            } else {
                http_response_code(404);
                echo json_encode(["message"=>"Error de datos"],UTF8);
                die();
            }
        } else if ($data->endpoint == "addStrength"){
            if(isset($data->strength)){
                $url = "http://localhost/Proyecto/api/services/strengths/";
                $method = "POST";
                $data = json_encode(["strength"=>$data->strength],UTF8);
                $result = curlPHP($url,$method,$data,$auth);

                $response = $result['response'];
                $http_code = $result['http_code'];
                
                if($http_code == 201){
                    http_response_code(200);
                    echo $response;
                } else {
                    http_response_code(404);
                    echo json_encode(["message"=>"Error de datos"],UTF8);
                    die();
                }

            } else {
                http_response_code(404);
                echo json_encode(["message"=>"Error de datos"],UTF8);
                die();
            }
        } else if ($data->endpoint == "addProject"){
            if(isset($data->project) && isset($data->description)){
                $url = "http://localhost/Proyecto/api/services/projects/";
                $method = "POST";
                $data = json_encode(["project"=>$data->project,"description"=>$data->description],UTF8);
                $result = curlPHP($url,$method,$data,$auth);

                $response = $result['response'];
                $http_code = $result['http_code'];
                
                if($http_code == 201){
                    http_response_code(200);
                    echo $response;
                } else {
                    http_response_code(404);
                    echo json_encode(["message"=>"Error de datos"],UTF8);
                    die();
                }

            } else {
                http_response_code(404);
                echo json_encode(["message"=>"Error de datos"],UTF8);
                die();
            }

        } else if ($data->endpoint == "addUser"){
            if(isset($data)){
                $url = "http://localhost/Proyecto/api/services/users/";
                $method = "POST";

                $data -> user -> user_data -> photo = saveImage($data -> user -> user_data -> photo);

                $data = json_encode($data -> user);
                $result = curlPHP($url,$method,$data,$auth);

                $response = $result['response'];
                $http_code = $result['http_code'];
                
                if($http_code == 201){
                    http_response_code(200);
                    echo $response;
                } else {
                    http_response_code(404);
                    echo json_encode(["message"=>"Error de datos"],UTF8);
                    die();
                }

            } else {
                http_response_code(404);
                echo json_encode(["message"=>"Error de datos"],UTF8);
                die();
            }
        } else {
            http_response_code(404);
            $array = array("status"=>404,"message"=>"Not Found");
            echo json_encode($array,UTF8);
            die();
        }
        
    } else if ($data->method == "DELETE"){
        if($data->endpoint == "deleteUser"){
            if(isset($data->user_id)){
                $url = "http://localhost/Proyecto/api/services/users/".$data->user_id;
                $method = "DELETE";
                $data = "";
                $result = curlPHP($url,$method,$data,$auth);

                $response = $result['response'];
                $http_code = $result['http_code'];
                
                if($http_code == 200){
                    http_response_code(200);
                    echo $response;
                } else {
                    http_response_code(404);
                    echo json_encode(["message"=>"Error de datos"],UTF8);
                    die();
                }

            } else {
                http_response_code(404);
                echo json_encode(["message"=>"Error de datos"],UTF8);
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

