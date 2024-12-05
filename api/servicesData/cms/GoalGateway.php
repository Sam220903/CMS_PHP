<?php

class GoalGateway{
    private PDO $conn;

    public function __construct(Database $database){
        $this->conn = $database->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM goals";
        $result = $this->conn->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addGoal($data) : array{
        $stmt = $this -> conn -> prepare("INSERT INTO goals (goal, user_id) VALUES (?, ?)");
        $stmt -> bindValue(1, $data['goal']);
        $stmt -> bindValue(2, $data['user_id'], PDO::PARAM_INT);
        $stmt -> execute();
        return array("id" =>$this -> conn -> lastInsertId(), "goal" => $data['goal'], "user_id" => $data['user_id']);
    }

    public function getGoalsbyUser($user_id){
        $stmt = $this -> conn ->prepare("SELECT goal
                                         FROM goals AS g JOIN users AS u
                                         ON g.user_id = u.id
                                         WHERE g.user_id = ?");
        $stmt -> bindValue(1, $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}