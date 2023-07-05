<?php

    class DB{

        private $connect = NULL;
        
        public function __construct(){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "nack";
            $this->connect = "";
            try{
                $this->connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->connect->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8
            }catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }  
        }
        
        // start insert
        public function tbl_insert($tblquery, $tblvalue = array()){ 
            try{
                $stmt = $this->connect->prepare($tblquery);
                $results = $stmt->execute($tblvalue);
                return $results; 
            } catch(PDOException $e) {
                echo 'Insert Error: ' . $e->getMessage();
            }
        }

      
        // start Select
        public function tbl_select($tblquery, $tblvalue = array()){ 
            try{
                $stmt = $this->connect->prepare($tblquery);
                $stmt->execute($tblvalue);  
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $results; 
            } catch(PDOException $e) {
                echo 'Select Error: ' . $e->getMessage();
            }
        }

        // start update
        public function tbl_update($tblquery, $tblvalue = array()){ 
            try{
                $stmt = $this->connect->prepare($tblquery);
                $results = $stmt->execute($tblvalue);
                return $results; 
            } catch(PDOException $e) {
                echo 'Update Error: ' . $e->getMessage();
            }
        }

        // start delete
        public function tbl_delete($tblquery, $tblvalue = array()){ 
            try{
                $stmt = $this->connect->prepare($tblquery);
                $results = $stmt->execute($tblvalue);
                return $results; 
            } catch(PDOException $e) {
                echo 'Delete Error: ' . $e->getMessage();
            }
        }

    }

?>