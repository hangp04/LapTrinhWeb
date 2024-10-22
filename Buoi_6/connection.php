<?php 
    function connection($show = false){

        $servername = 'localhost:3307';
        $username = 'root';
        $password = 'HangP04@';
        $dbname = 'b5_mydb';

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql1 = "CREATE DATABASE IF NOT EXISTS b5_mydb CHARACTER SET latin1 COLLATE latin1_swedish_ci";
        
        if ($conn->query($sql1) === TRUE) {
            if ($show) echo 'Database created successfully<br>';
        } else {
            echo "Error creating database: " . $conn->error . "<br>";
        }
    
        $conn->select_db($dbname);

        $checkTable = $conn->query("SHOW TABLES LIKE 'MyGuests'");
        
        if ($checkTable->num_rows == 0) {
            $sql = "CREATE TABLE IF NOT EXISTS MyGuests (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(50) NOT NULL,
                lastname VARCHAR(50) NOT NULL,
                email VARCHAR(100) NOT NULL,
                reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
            if($conn->query($sql) == TRUE){
                if ($show) echo 'Table MyGuests created successfully<br>';
            } else {
                echo "Error creating table: " . $conn->error . "<br>";
            }
        } else {
            if ($show) echo 'Table MyGuests already exists<br>';
        }
        return $conn;
    }

    if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
        connection(true);
    }
?>