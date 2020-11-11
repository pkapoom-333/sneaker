<?php
session_start();
    include('connection.php');

    $errors = array();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
   if (isset($_POST['submit'])) {
        $member_email = $_POST['member_email'];
        $member_pwd = $_POST['member_pwd'];
        $member_name = $_POST['member_name'];
        $member_lstname  = $_POST['member_lstname'];;
        $member_phone = $_POST['member_phone']; 
        $member_gender = $_POST['member_gender']; 
        $member_email_Before = $_POST['member_email_Before']; 
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
        
       if($member_email != $member_email_Before){
            if($result){
                if($result['member_email'] == $member_email){
                array_push($errors,"member_email "); 
                $_SESSION['error'] ="Email have already now!";
                header("location: Registor-edit.php");
                }
             
            }
       }
        $billnumber = $_SESSION['member_id'];
        
    
        if(count($errors) == 0){
          $timestamp = date("Y-m-d H:i:s");   
          $sql = "UPDATE member SET member_email= '$member_email' ,member_pwd= '$member_pwd', member_name =  '$member_name', member_lstname = '$member_lstname', member_phone = '$member_phone', member_gender = '$member_gender' Where member_id = '$billnumber'";  
          mysqli_query($conn,$sql);
           $_SESSION['member_email'] = $member_email;
           $_SESSION['member_id']  = $billnumber;
           $_SESSION['success'] = "success";
           $_SESSION['Edit'] = "แก้ไขข้อมูลสำเร็จ";
           $_SESSION['Show_name']= "สวัสดี คุณ    ".$member_name;
           header("location: login.php");


        }

    } 
    
?>    
