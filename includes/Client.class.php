<?php

    require_once 'Database.class.php';

    class Client{

        //crea una tarea
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


        //obtiene todas las tareas
        public static function Get_all_tasks(){
            $database = new Database();
            $conn = $database->getConnection();

            $query = $conn->prepare('SELECT * FROM tasks');
            
            if($query->execute()){
                $tasks = $query->fetchAll();
                return ['status' => 200, 'data' =>  $tasks];
            }else{
                return ['status' => 500, 'message' => 'Error getting tasks'];
            }
        }


        public static function get_task_by_id($id){
            $database = new Database();
            $conn = $database->getConnection();

            $query = $conn->prepare('SELECT * FROM tasks WHERE id = :id');
            $query->bindParam(':id', $id);

            if($query->execute()){
                $task = $query->fetch();
                return ['status' => 200, 'data' =>  $task];
            }else{
                return ['status' => 500, 'message' => 'Error getting task'];
            }
        }




    }



?>