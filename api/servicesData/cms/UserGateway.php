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

    public function getUserInfo() : array {
        $sql = "SELECT users.id, name, last_name, profession, email
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
        $stmt = $this -> conn -> prepare("INSERT INTO users (name, last_name, profession, biography, motivation, photo, phone, email, adress, admin_id) VALUES (?,?,?,?,?,?,?,?,?,?)");
        
        $stmt -> bindValue(1, $data -> name);
        $stmt -> bindValue(2, $data -> last_name);
        $stmt -> bindValue(3, isset($data -> profession) ? $data -> profession : null);
        $stmt -> bindValue(4, isset($data -> biography) ? $data -> biography : null);
        $stmt -> bindValue(5, isset($data -> motivation) ? $data -> motivation : null);
        $stmt -> bindValue(6, isset($data -> photo) ? $data -> photo : null);
        $stmt -> bindValue(7, $data -> phone, PDO::PARAM_INT);
        $stmt -> bindValue(8, $data -> email);
        $stmt -> bindValue(9, isset($data -> adress) ? $data -> adress : null);
        $stmt -> bindValue(10, $data -> admin_id, PDO::PARAM_INT);
        $stmt -> execute();
        $profile_id = $this -> conn -> lastInsertId();

        return array("id" => $this -> conn -> lastInsertId(), "name" => $data -> name, "last_name" => $data -> last_name);
    }

    public function addSkillforUser($data) : array{
        $stmt = $this -> conn -> prepare("INSERT INTO user_skill (user_id, skill_id, intensity) VALUES (?,?,?)");
        $stmt -> bindValue(1, $data['user_id'], PDO::PARAM_INT);
        $stmt -> bindValue(2, $data['skill_id'], PDO::PARAM_INT);
        $stmt -> bindValue(3, $data['intensity'], PDO::PARAM_INT);
        $stmt -> execute();
        return array("user_id" => $data['user_id'], "skill_id" => $data['skill_id']);
    }

    public function addStrengthforUser($data) : array{
        $stmt = $this -> conn -> prepare("INSERT INTO user_strength (user_id, strength_id, value) VALUES (?,?,?)");
        $stmt -> bindValue(1, $data['user_id'], PDO::PARAM_INT);
        $stmt -> bindValue(2, $data['strength_id'], PDO::PARAM_INT);
        $stmt -> bindValue(3, $data['value'], PDO::PARAM_INT);
        $stmt -> execute();
        return array("user_id" => $data['user_id'], "strength_id" => $data['strength_id']);
    }

    public function addProjectforUser($data) : array{
        $stmt = $this -> conn -> prepare("INSERT INTO user_project (user_id, project_id) VALUES (?,?)");
        $stmt -> bindValue(1, $data['user_id'], PDO::PARAM_INT);
        $stmt -> bindValue(2, $data['project_id'], PDO::PARAM_INT);
        $stmt -> execute();
        return array("user_id" => $data['user_id'], "project_id" => $data['project_id']);
    }

    public function deleteUser($user_id) : array {
        $stmt = $this -> conn -> prepare("UPDATE users SET status = 0 WHERE id = :user_id");
        $stmt -> bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt -> execute();
        return array("user_id" => $user_id);
    }

}