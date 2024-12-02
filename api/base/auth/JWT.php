<?php

define('SECRET_KEY', '2019');
define('TOKEN_EXPIRATION', 3600);

class JWT{
    private static $secret_key = SECRET_KEY;

    public static function generateToken($data) : string{

        $header = json_encode([
            'type' => 'JWT',
            'algorithm' => 'HS256'
        ], JSON_UNESCAPED_SLASHES);

        $payload = json_encode([
            'id' => $data['id'],
            'username' => $data['username'],
            'expiration' => time() + TOKEN_EXPIRATION
        ], JSON_UNESCAPED_SLASHES);


        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, self::$secret_key, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        $token = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        
        return $token;
    }

    public static function validateToken($token){

        $parts = explode(".", $token);

        if (count($parts) !== 3) return false;
        

        list($header, $payload, $original_signature) = $parts;
        
        $header = str_replace('Bearer ', '', $header);

        $signature = hash_hmac('sha256', $header . "." . $payload, self::$secret_key, true);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        if ($base64UrlSignature !== $original_signature) return false;

        $payload = json_decode(base64_decode($payload), true);


        if ($payload['expiration'] < time()) return false;

        return $payload;

    }
}