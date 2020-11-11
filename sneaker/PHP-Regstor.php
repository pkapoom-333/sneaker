<?php
session_start();
    include('connection.php');

    $errors = array();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
   if (isset($_POST['submit'])) {
        $member_email = mysqli_real_escape_string($conn,$_POST['member_email']);
        $member_pwd = mysqli_real_escape_string($conn,$_POST['member_pwd']);
        $member_name = mysqli_real_escape_string($conn,$_POST['member_name']);
        $member_lstname  = mysqli_real_escape_string($conn,$_POST['member_lstname']);;
        $member_phone = mysqli_real_escape_string($conn,$_POST['member_phone']); 
        $member_gender = mysqli_real_escape_string($conn,$_POST['member_gender']); 
        

        if (empty($member_email)){
            array_push($member_email,"Email is required");
        }
        if (empty($member_pwd)){
            array_push($member_pwd,"Password is required");
        }
        if (empty($member_name)){
            array_push($member_name,"Name is required");
        }
        if (empty($member_lstname)){
            array_push($member_lstname,"Lastname is required");
        }
        if (empty($member_phone)){
            array_push($member_phone,"phone is required");
        }
        
        $SELECT = "SELECT * From member Where member_email = '$member_email'";
        $query = mysqli_query($conn, $SELECT);
        $result = mysqli_fetch_assoc($query);
        
        if($result){
            if($result['member_email'] == $member_email){
             array_push($errors,"member_email "); 
             $_SESSION['error'] ="Email have already now!";
             header("location: Registor.php");
            }
             
        }
        
       
            
        
        $query_id = "SELECT member_id From member ";
        $res = mysqli_query($conn,$query_id);
        
        $last_id=0;
        if(mysqli_num_rows($res) == 0){

             $billnumber = "20200001";
        }else{
            while($row = mysqli_fetch_array($res)){
            $last_id = $row['member_id']; 
        }
        $next_id = ($last_id+1);
        $year_id = "2020";
        $next_id = $next_id - 2020;
        $billnumber = $year_id + $next_id;        
        }
        if(count($errors) == 0){
          $timestamp = date("Y-m-d H:i:s");   
          $sql = "INSERT Into member (member_id,member_email, member_pwd, member_name, member_lstname, member_phone, member_gender,mrk_id) values ( '$billnumber','$member_email', '$member_pwd', '$member_name', '$member_lstname', '$member_phone', '$member_gender','$billnumber')";  
          mysqli_query($conn,$sql);
           $_SESSION['member_email'] = $member_email;
           $_SESSION['member_id']  = $billnumber;
           $_SESSION['success'] = "Logged in";
           $_SESSION['Show_name']= "สวัสดี คุณ    ".$member_name;
           header("location: login.php");

        }

    } 
    
?>    
