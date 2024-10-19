<?php

    require_once 'Database.class.php';

    class Client{

        public static function Create_task($name, $description){
            $database = new Database();
            $conn = $database->getConnection();

            $query = $conn->prepare('INSERT INTO tasks (name, description, status, created_at) 
                VALUES (:name, :description, 1, NOW())');
            $query->bindParam(':name', $name);
            $query->bindParam(':description', $description);

            if($query->execute()){
                return ['message' => 'Task created successfully', 'statusCode' => 200];
            }else{
                return ['message' => 'Task not created', 'statusCode' => 500];
            }
        }
    }
?>