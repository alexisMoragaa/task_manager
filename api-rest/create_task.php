<?php 
    require_once '../includes/Task.class.php';

    header('Content-Type: application/json');


    try{

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);

            if($name && $description){
                $result =  Task::Create_task($name, $description);
                echo json_encode($result['message']);
                http_response_code($result['statusCode']);
            }else{
                echo json_encode(array('message' => 'Task not created. Data is missing or isn´t valid'));
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