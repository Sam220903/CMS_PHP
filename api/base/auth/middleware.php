<?php

function middlewareAuth() {
    $headers = getallheaders();
    $token = $headers['Authorization'] ?? null;

    if(!$token) {
        http_response_code(401);
        echo json_encode([
            "message" => "Token no encontrado"
        ]);
        exit;
    }

    $validated_token = JWT::validateToken($token);
    
    
    if(!$validated_token) {
        http_response_code(401);
        echo json_encode([
            "message" => "Token inválido o expirado"
        ]);
        exit;
    }

    return $validated_token;
}