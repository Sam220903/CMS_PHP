<?php

class AdminGateway{
    private PDO $conn;

    public function __construct(Database $database){
        $this -> conn = $database -> getConnection();
    }


    public function login($username, $password){
        $sql = "SELECT id, username, password
                FROM users 
                WHERE username = :username AND password = :password";

        $stmt = $this -> conn -> prepare($sql);

        $stmt -> bindParam(':username', $username);
        $stmt -> bindParam(':password', $password);
        
        if($stmt -> execute()){
            $result = $stmt -> fetch(PDO::FETCH_ASSOC);
            if($result){
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}