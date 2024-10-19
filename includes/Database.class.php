<?php

    class Database {
        private $host = 'localhost';
        private $database = 'task_manager';
        private $user = 'root';
        private $pass = '';

        public function getConnection(){
            $hostDB = "mysql:host=" . $this->host . ";dbname=" . $this->database;

            try{
                $conn = new PDO($hostDB, $this->user, $this->pass);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }

    }

?>