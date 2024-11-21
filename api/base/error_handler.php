<?php

class ErrorHandler{
    public static function handleException(Throwable $exception) : void {

        http_response_code(500);

        $response = array(
            "code" => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file" => $exception->getFile(),
            "line" => $exception->getLine()
        );

        echo json_encode($response);
    }
    
}