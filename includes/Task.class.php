<?php

    require_once 'Database.class.php';

    class Task{

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

        //Obtiene una tarea en espesifico
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


        //Elimina una tarea
        public static function delete_task($id){
            $database = new Database();
            $conn = $database->getConnection();

            $query = $conn->prepare('DELETE FROM tasks WHERE id = :id');
            $query->bindParam(':id', $id);

            if($query->execute()){
                return ['message' => 'Task deleted successfully', 'statusCode' => 200];
            }else{
                return ['message' => 'Task not deleted', 'statusCode' => 500];
            }
        }


        //Actualiza una tarea
        public static function update_task($id, $name, $description, $status){
            $database = new Database();
            $conn = $database->getConnection();

            $query = $conn->prepare('UPDATE tasks SET name = :name, description = :description, status = :status where id = :id');
            $query->bindParam(':id', $id);
            $query->bindParam(':name', $name);
            $query->bindParam(':description', $description);
            $query->bindParam(':status', $status);

            if($query->execute()){
                return ['message' => 'Task updated successfully', 'statusCode' => 200];
            }else{
                return ['message' => 'Task not updated', 'statusCode' => 500];
            }
        }


    }
?>