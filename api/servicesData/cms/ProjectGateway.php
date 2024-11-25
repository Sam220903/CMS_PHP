<?php

class ProjectGateway{
    private PDO $conn;

    public function __construct(Database $database){
        $this->conn = $database->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM projects";
        $result = $this->conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProject($data) : array{
        $stmt = $this -> conn -> prepare("INSERT INTO projects (project_name, description) VALUES (?, ?)");
        $stmt -> bindValue(1, $data -> project);
        $stmt -> bindValue(2, $data -> description);
        $stmt -> execute();

        return array("id" =>$this -> conn -> lastInsertId(), "project" => $data -> project);
    }

    public function getProjectsbyUser($user_id){
        $stmt = $this -> conn ->prepare("SELECT p.project_name, p.description
                                         FROM projects AS p JOIN user_project AS up 
                                         ON p.id = up.project_id
                                         WHERE up.user_id = ?");
        $stmt -> bindValue(1, $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}