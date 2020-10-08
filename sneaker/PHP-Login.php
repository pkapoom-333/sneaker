<?php
    
    session_start();
    include('connection.php');

    $errors = array();

   if (isset($_POST['login'])) {
    $member_email = $_POST['member_email'];
    $member_pwd = $_POST['member_pwd'];

        if (empty($member_email)){
        array_push($errors,"Email is required");
        }
        if (empty($member_pwd)){
        array_push($errors,"Password is required");
        }

        if(count($errors)==0){
        //$member_pwd = md5($member_pwd);
        $sql = "SELECT * From member Where member_email = '$member_email' AND member_pwd = '$member_pwd'";
        $re = mysqli_query($conn,$sql);
        if(mysqli_num_rows($re) == 1){
            $_SESSION['member_email'] = $member_email;
            $_SESSION['successlogin'] = "login";
            while($row = mysqli_fetch_array($re)){
                $_SESSION['member_id']  = $row['member_id'];
                $_SESSION['Show_name']  = "สวัสดี คุณ    ".$row['member_name']; 
                header("location: login.php");
            }
        }else{
            
            array_push($errors,"Wrong username/password combination");
            $_SESSION['error'] = "Wrong username or password try again!";
            header("location: login.php");

        }
        
    
    
    
        }
    

    } 
    
?>