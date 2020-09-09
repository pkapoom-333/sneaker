<?php
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "testdata";  
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
       
        if (!$conn) {
            die("ERRO" . mysqli_connect_error());
        }
?>