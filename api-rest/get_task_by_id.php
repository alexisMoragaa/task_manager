<?php
    include '../includes/Task.class.php';
    
    header('Content-Type: application/json');

    try{

        if($_SERVER['REQUEST_METHOD'] == 'GET'){

            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if($id){
                $result =  Task::Get_task_by_id($id);
                echo json_encode($result['data']);
                http_response_code($result['status']);
            }else{
                echo json_encode(array('message' => 'Task not found. Id is missing or isn´t valid'));
                http_response_code(400);
            }

        }else{
            echo json_encode(array('message' => 'Method not allowed'));
            http_response_code(405);
        }

    }catch(Exception $e){
        echo json_encode(array('message' => 'Error: ' . $e->getMessage()));
    }
?>