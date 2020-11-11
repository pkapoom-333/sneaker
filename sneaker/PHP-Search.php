<?php
    
    session_start();
    include('connection.php');

    $errors = array();

   if (isset($_POST['search'])) {
    $Namesearch=$_POST['Namesearch'];
    $sql = "SELECT * From product Where prd_name LIKE '%$Namesearch' or prd_brand LIKE'%$Namesearch' or prd_type LIKE '%$Namesearch' or prd_status LIKE '%$Namesearch'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query);
     if($result){
        echo $Namesearch;
        /*if($result['prd_name'] == $Namesearch){
            echo $Namesearch;
                header("location: Search-product.php?Search=$Namesearch");
        } 
        if($result['prd_brand'] == $Namesearch){
            echo $Namesearch;
                header("location: Search-product.php?Search=$Namesearch");
        } 
        if($result['prd_type'] == $Namesearch){
            echo $Namesearch;
                header("location: Search-product.php?Search=$Namesearch");
        } 
        if($result['prd_status'] == $Namesearch){
            echo $Namesearch;
                header("location: Search-product.php?Search=$Namesearch");
        } */
     }  
       
    }
?>