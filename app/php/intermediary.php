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
    curl_close($curl);
    return $response;
}

$data = json_decode(file_get_contents("php://input"));
if(isset($data->endpoint)){
    if($data->method == "GET"){
        if($data->endpoint == "getUserInfo"){
            if(isset($data->user_id)){
                $url = "http://localhost/Proyecto/api/services/users/".$data->user_id;
                $method = "GET";
                $data = "";
                $auth = "12345";
                $response = curlPHP($url,$method,$data,$auth);
                $response = json_decode($response);


                http_response_code(200);
                $array = array("status"=>200,"data"=>$response);
                echo json_encode($array,UTF8);
            } else {
                http_response_code(400);
                $array = array("status"=>404,"message"=>"No se ha enviado el user_id");
                echo json_encode($array,UTF8);
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