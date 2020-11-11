<?php
session_start();
    include('connection.php');

    $errors = array();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
   if (isset($_POST['SummitPost'])) {
        $member_email = $_SESSION['member_email'];
        $review_count_point = $_POST['rating'];
        $Id_product_reviwe=$_POST['Id_product_reviwe'];
        $review_detail=$_POST['review_detail'];
        $res = $conn->query("SELECT * FROM member where member_email = '$member_email'");
        
        while($row = $res->fetch_assoc()){
            $Show_name = $row["member_name"];
        }
        
        $last_id=0;
        $query_id = "SELECT review_id From review_prd";
        $res = mysqli_query($conn,$query_id);
        
        if(mysqli_num_rows($res)==0){

            $billnumber = "20200001";
        }else{
           while($row = mysqli_fetch_array($res)){
           $last_id = $row['review_id']; 
            }
            $next_id = ($last_id+1);
            $year_id = "2020";
            $next_id = $next_id - 2020;
            $billnumber = $year_id + $next_id;        
        }
        
       if(count($errors) == 0){
          $timestamp = date("d-m-Y H:i:s");   
          $sql = "INSERT Into review_prd (review_id,review_detail, review_date, review_count_point, Id_product_reviwe,review_Name) values ( '$billnumber','$review_detail', '$timestamp', '$review_count_point', '$Id_product_reviwe', '$Show_name')";
          mysqli_query($conn,$sql);
          header("location: pase-product-test.php?show=$Id_product_reviwe");

        }

    } 
    
    if (isset($_POST['SubmitLike'])){
        $Id_product_reviwe=$_POST['Id_product_reviwe'];
        $member_email = $_SESSION['member_email'];
        if(empty($member_email)){
            array_push($errors,"กรุณาเลือกประเภท"); 
            $_SESSION['error-like'] = "กรุณาเลือกประเภท";
            header("location: pase-product-test.php?show=$Id_product_reviwe");  
        }
        $wmem = $conn->query("SELECT * FROM member WHERE member_email = '$member_email'");
        while($row = $wmem->fetch_assoc()){
             $member_id = $row['member_id'];   
        }


        $SELECT = "SELECT * From fav Where prd_id = '$Id_product_reviwe' and member_id = '$member_id'";
        $query = mysqli_query($conn, $SELECT);
        $result = mysqli_fetch_assoc($query);
        
        if(!empty($result)){
            $Delete="DELETE From fav Where prd_id = '$Id_product_reviwe' and member_id = '$member_id'";
            mysqli_query($conn,$Delete);
            array_push($errors,"member_email "); 
            header("location: pase-product-test.php?show=$Id_product_reviwe");
             
        }



        if(count($errors) == 0){
        $sql = "INSERT INTO fav(member_id,prd_id) VALUE('$member_id','$Id_product_reviwe')";
        mysqli_query($conn,$sql);
        header("location: pase-product-test.php?show=$Id_product_reviwe");
        }
    } 
?>    
