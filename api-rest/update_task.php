<?php 
    require_once '../includes/Task.class.php';
    header('Content-Type: application/json');


    try{

        if($_SERVER['REQUEST_METHOD'] == 'PUT'){

            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_GET, 'description', FILTER_SANITIZE_STRING);
            $status = filter_input(INPUT_GET, 'status', FILTER_VALIDATE_INT);

            if($id && $name && $description && $status){
                $result =  Task::Update_task($id, $name, $description, $status);
                echo json_encode($result['message']);
                http_response_code($result['statusCode']);
            }

        }else{
            echo json_encode(array('message' => 'Method not allowed'));
            http_response_code(405);
        }

    }catch(Exception $e){
        echo json_encode(array('message' => 'Error: ' . $e->getMessage()));
    }

?>