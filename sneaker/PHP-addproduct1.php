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
                     if($filesize < 1000000){
                        move_uploaded_file($mrk_pic_tmpname, "uploadprofile/".$mrk_pic);
                        echo $mrk_pic;
                        
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
        
        if ($result) {
            if ($result['mrk_name'] == $mrk_name){
                array_push($errors,"Email already exixts");
                header("location: add-product-pase1.php");
                $_SESSION['error'] = "Name Mrket already exixts";
            }
        }

        if(count($errors) == 0){
         $mrk_id = $_SESSION['member_id'];
         $prd_id = $_SESSION['member_id'];
         $timestamp_market = date("d-m-Y");
         $rand = rand(1600,2000);
          $sql = "INSERT Into market_info (mrk_id,mrk_pic,mrk_fb,mrk_ig,mrk_line,mrk_open,mrk_close,mrk_name, mrk_personal_id,mrk_phone,mrk_address,mrk_sub_district,mrk_district,mrk_city,mrk_zipcode,mrk_lat_location,mrk_lgt_location,prd_id,mrk_regis_time) 
          values ('$mrk_id ' ,'$mrk_pic', '$mrk_fb', '$mrk_ig', '$mrk_line', '$mrk_open', '$mrk_close', '$mrk_name', '$mrk_personal_id', '$mrk_phone', '$mrk_address', '$mrk_sub_district', '$mrk_district', '$mrk_city', '$mrk_zipcode', '$mrk_lat_location', '$mrk_lgt_location' ,'$prd_id','$timestamp_market')";  
          mysqli_query($conn,$sql);
          
          header("location: add-product-pase2.php");
        }
        
   
    
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