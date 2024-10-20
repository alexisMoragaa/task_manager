<?php 
    require_once '../includes/Task.class.php';

    header('Content-Type: application/json');


    try{

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['name']) && isset($_POST['description'])){
                $result =  Task::Create_task($_POST['name'], $_POST['description']);
                echo json_encode($result['message']);
                http_response_code($result['statusCode']);
            }else{
                echo json_encode(array('message' => 'Task not created. Data is missing'));
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