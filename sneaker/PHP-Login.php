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
            echo "sleep ได้ละ";
        }else{
            echo $sql;
            echo $member_email;
            echo $member_pwd;


        }
        
    
    
    
        }
    

    } 
    
?>