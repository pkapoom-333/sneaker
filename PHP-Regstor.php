<?php
    
    session_start();
    include('connection.php');

    $errors = array();

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
    
        if ($result) {
            if ($result['member_email'] == $member_email){
                array_push($errors,"Email already exixts");
                echo "Email already exixts";
            }
        }
    
        if(count($errors) == 0){
          $sql = "INSERT Into member (member_email, member_pwd, member_name, member_lstname, member_phone, member_gender) values ( '$member_email', '$member_pwd', '$member_name', '$member_lstname', '$member_phone', '$member_gender')";  
          mysqli_query($conn,$sql);
          
           $_SESSION['member_email'] = $member_email;
           $_SESSION['success'] = "Logged in";
           echo "New record inserted sucessfully";
        }

    } 
    
?>

