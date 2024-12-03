<?php

class UserGateway{
    private PDO $conn;

    public function __construct(Database $database){
        $this->conn = $database->getConnection();
    }

    public function getAll() : array {
        $sql = "SELECT users.id, name, last_name, profession, biography, motivation, photo, phone, email, adress
                FROM users 
                WHERE users.status = 1";
        $result = $this->conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }   

    public function getUserbyID($user_id) : array {
        $sql = "SELECT users.id, name, last_name, profession, biography, motivation, photo, phone, email, adress
                FROM users 
                WHERE users.status = 1 AND users.id = :user_id";

        $stmt = $this -> conn -> prepare($sql);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addUser($data) : array {
        $stmt = $this -> conn -> prepare("INSERT INTO profiles (name, last_name, profession, biography, motivation, photo, phone, email, adress) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt -> bindValue(1, $data -> name);
        $stmt -> bindValue(2, $data -> last_name);
        $stmt -> bindValue(3, isset($data -> profession) ? $data -> profession : null);
        $stmt -> bindValue(4, isset($data -> biography) ? $data -> biography : null);
        $stmt -> bindValue(5, isset($data -> motivation) ? $data -> motivation : null);
        $stmt -> bindValue(6, isset($data -> photo) ? $data -> photo : null);
        $stmt -> bindValue(7, $data -> phone, PDO::PARAM_INT);
        $stmt -> bindValue(8, $data -> email);
        $stmt -> bindValue(9, isset($data -> adress) ? $data -> adress : null);
        $stmt -> execute();
        $profile_id = $this -> conn -> lastInsertId();

        return array("id" => $this -> conn -> lastInsertId(), "username" => $data -> username);
    }

}