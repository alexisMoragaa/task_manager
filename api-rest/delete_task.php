<?php
    require_once '../includes/Task.class.php';

    header('Content-Type: application/json');

    try{

        if($_SERVER['REQUEST_METHOD'] == 'DELETE'){

            if(isset($_GET['id'])){
                $result =  Task::delete_task($_GET['id']);
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