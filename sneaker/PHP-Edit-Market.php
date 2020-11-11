<?php
session_start();
    include('connection.php');

    $errors = array();
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
   if (isset($_POST['addproduct1'])) {
       
        $mrk_pic = $_FILES['mrk_pic'];
        $mrk_pic_name = $_FILES['mrk_pic']['name'];
        $mrk_pic_tmpname = $_FILES['mrk_pic']['tmp_name'];
        $filesize = $_FILES['mrk_pic']['size'];
        $fileerror = $_FILES['mrk_pic']['error'];
        $filetype = $_FILES['mrk_pic']['type'];
        
        $mrk_pic = $_SESSION['member_id'];
        
        $fileext = explode('.',$mrk_pic_name);
        $fileActualExt = strtolower(end($fileext));
        $mrk_pic = $mrk_pic.".".$fileActualExt ;
        $allowed = array('jpg','jpeg','png','pdf');

        if(in_array($fileActualExt,$allowed)){
                if($fileerror === 0){
                     if($filesize < 10000000){
                        unlink("uploadprofile/".$mrk_pic);
                        move_uploaded_file($mrk_pic_tmpname, "uploadprofile/".$mrk_pic);
                        
                     }  else{
                         echo "you file is too big";
                     }
                }else{
                    echo "Error";
                }
        }else{
            echo "Error";
        }
        
        $mrk_fb = mysqli_real_escape_string($conn,$_POST['mrk_fb']);
        $mrk_ig = mysqli_real_escape_string($conn,$_POST['mrk_ig']);
        $mrk_line  = mysqli_real_escape_string($conn,$_POST['mrk_line']);;
        $mrk_open = mysqli_real_escape_string($conn,$_POST['mrk_open']); 
        $mrk_close = mysqli_real_escape_string($conn,$_POST['mrk_close']); 
        $mrk_name = mysqli_real_escape_string($conn,$_POST['mrk_name']);
        $mrk_personal_id = mysqli_real_escape_string($conn,$_POST['mrk_personal_id']);
        $mrk_phone = mysqli_real_escape_string($conn,$_POST['mrk_phone']);
        $mrk_address  = mysqli_real_escape_string($conn,$_POST['mrk_address']);;
        $mrk_sub_district = mysqli_real_escape_string($conn,$_POST['mrk_sub_district']); 
        $mrk_district = mysqli_real_escape_string($conn,$_POST['mrk_district']); 
        $mrk_city = mysqli_real_escape_string($conn,$_POST['mrk_city']);
        $mrk_zipcode = mysqli_real_escape_string($conn,$_POST['mrk_zipcode']);
        $mrk_lat_location = mysqli_real_escape_string($conn,$_POST['mrk_lat_location']);
        $mrk_lgt_location = mysqli_real_escape_string($conn,$_POST['mrk_lgt_location']);
        $mrk_open = date('h:i:sa',$mrk_open);
        $mrk_close = date('h:i:sa',$mrk_close);
        
        $SELECT = "SELECT * From market_info Where mrk_name = '$mrk_name'";
        $query = mysqli_query($conn, $SELECT);
        $result = mysqli_fetch_assoc($query);
        $mrk_name_befor = mysqli_real_escape_string($conn,$_POST['mrk_name_befor']);
        if($mrk_name != $mrk_name_befor){   
            if ($result) {
                if ($result['mrk_name'] == $mrk_name){
                array_push($errors,"Email already exixts");
                header("location: Edit-product-pase1.php");
                $_SESSION['error'] = "Name Mrket already exixts";
                }
            }
         }
        if(count($errors) == 0){
         $mrk_id = $_SESSION['member_id'];
         $prd_id = $_SESSION['member_id'];
         $sql = "UPDATE market_info SET mrk_name = '$mrk_name', mrk_pic= '$mrk_pic' ,mrk_fb= '$mrk_fb', mrk_ig =  '$mrk_ig', mrk_line = '$mrk_line', mrk_open = '$mrk_open', mrk_close = '$mrk_close' , mrk_name = '$mrk_name' , mrk_personal_id = '$mrk_personal_id' , mrk_phone = '$mrk_phone' , mrk_address = '$mrk_address' , mrk_sub_district = '$mrk_sub_district' , mrk_city = '$mrk_city' , mrk_zipcode = '$mrk_zipcode', mrk_lat_location = '$mrk_lat_location', mrk_lgt_location = '$mrk_lgt_location' Where mrk_id  = '$mrk_id'";  
         mysqli_query($conn,$sql);
         $_SESSION['Edit'] = "แก้ไขข้อมูลสำเร็จ";
         header("location: login.php");
        }
        
   
    
    } 
    
    if(isset($_POST['Exit'])){
        header("location: Home.php");
    }

?> 
<script>
 function validateForm() {
        var x = document.forms["myForm"]["fname"].value;
        if (x == "") {
          alert("you must be filled out 555");
          return false;
        }
    }
</script> 