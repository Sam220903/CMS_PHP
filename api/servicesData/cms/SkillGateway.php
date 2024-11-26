<?php

class SkillGateway{
    private PDO $conn;

    public function __construct(Database $database){
        $this->conn = $database->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM skills";
        $result = $this->conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addSkill($data) : array{
        $stmt = $this -> conn -> prepare("INSERT INTO skills (skill) VALUES (?)");
        $stmt -> bindValue(1, $data -> skill);
        $stmt -> execute();

        return array("id" =>$this -> conn -> lastInsertId(), "skill" => $data -> skill);
    }

    public function getSkillsbyUser($user_id){
        $stmt = $this -> conn ->prepare("SELECT skill, intensity 
                                         FROM skills AS s JOIN user_skill AS us 
                                         ON s.id = us.skill_id
                                         WHERE us.user_id = ?
                                         ORDER BY intensity DESC
                                         LIMIT 3");
        $stmt -> bindValue(1, $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}