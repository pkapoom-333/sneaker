<?php
    
    session_start();
    include('connection.php');

    $errors = array();

    if (isset($_GET['show'])) {
     $id_product = $_GET['show'];   
     
     echo $id_product;
    
    } 
    
?>