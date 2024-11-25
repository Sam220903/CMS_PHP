<?php

class StrengthGateway{
    private PDO $conn;

    public function __construct(Database $database){
        $this->conn = $database->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM strengths";
        $result = $this->conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addStrength($data) : array{
        $stmt = $this -> conn -> prepare("INSERT INTO strengths (strength) VALUES (?)");
        $stmt -> bindValue(1, $data -> strength);
        $stmt -> execute();

        return array("id" =>$this -> conn -> lastInsertId(), "strength" => $data -> strength);
    }

    public function getStrengthsbyUser($user_id){
        $stmt = $this -> conn ->prepare("SELECT strength, value 
                                         FROM strengths AS s JOIN user_strength AS us 
                                         ON s.id = us.strength_id
                                         WHERE us.user_id = ?");
        $stmt -> bindValue(1, $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}