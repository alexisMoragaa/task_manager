<?php
    include '../includes/Task.class.php';
    
    header('Content-Type: application/json');

    try{

        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $result =  Task::Get_all_tasks();
            echo json_encode($result['data']);
            http_response_code($result['status']);
        }else{
            echo json_encode(array('message' => 'Method not allowed'));
            http_response_code(405);
        }

    }catch(Exception $e){
        echo json_encode(array('message' => 'Error: ' . $e->getMessage()));
    }
?>