<?php
   session_start();
   include('connection.php');

   $errors = array();
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   } 
   
    if (isset($_POST['addproduct2'])) {
            
           if (isset($_SESSION['EditPHP'])) {
            $id_product = $_SESSION['EditPHP'];
            echo $id_product;
            unset($_SESSION['EditPHP']);
            $res_file_market = $conn->query("SELECT * From product Where prd_id = '$id_product'");
            while($row = mysqli_fetch_array($res_file_market)){
                $fileNameIMG1 = $row['img1'];
                $fileNameIMG2 = $row['img2'];
                $fileNameIMG3 = $row['img3'];
                $fileNameIMG4 = $row['img4'];
                $fileNameIMG5 = $row['img5'];
                $fileNameIMG6 = $row['img6'];
             }
           }
       
       $prd_name = $_POST['prd_name'];
       $prd_brand = $_POST['prd_brand'];
       $prd_type = $_POST['prd_type'];
       $prd_status  = $_POST['prd_status'];;
       $prd_price = $_POST['prd_price']; 
       $prd_gender = $_POST['prd_gender'];
       
       $size_39 = mysqli_real_escape_string($conn,$_POST['size_39']);
       $size_40 = mysqli_real_escape_string($conn,$_POST['size_40']);
       $size_40_5 = mysqli_real_escape_string($conn,$_POST['size_40_5']);
       $size_41  = mysqli_real_escape_string($conn,$_POST['size_41']);;
       $size_41_5 = mysqli_real_escape_string($conn,$_POST['size_41_5']); 
       $size_42 = mysqli_real_escape_string($conn,$_POST['size_42']);
       $size_42_5 = mysqli_real_escape_string($conn,$_POST['size_42_5']);
       $size_43 = mysqli_real_escape_string($conn,$_POST['size_43']);
       $size_44  = mysqli_real_escape_string($conn,$_POST['size_44']);;
       $size_44_5 = mysqli_real_escape_string($conn,$_POST['size_44_5']); 
       $size_46 = mysqli_real_escape_string($conn,$_POST['size_46']);
       $size_47 = mysqli_real_escape_string($conn,$_POST['size_47']);
       $size_47_5 = mysqli_real_escape_string($conn,$_POST['size_47_5']);
       $prd_detail = mysqli_real_escape_string($conn,$_POST['prd_detail']);

       $fileCount = count($_FILES['img_product_1']['name']);
        for($i = 0; $i < $fileCount; $i++) {
            if($i == 0){
                unlink("upload/".$fileNameIMG1);
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][1], "upload/".$fileNameIMG1);  
               
            }
            if($i == 1){
                unlink("upload/".$fileNameIMG2);
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][1], "upload/".$fileNameIMG2);  
               
            }
            if($i == 2){
                unlink("upload/".$fileNameIMG3);
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][2], "upload/".$fileNameIMG3);  
               
            }
            if($i == 3){
                unlink("upload/".$fileNameIMG4);
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][3], "upload/".$fileNameIMG4);  
               
            }
            if($i == 4){
                unlink("upload/".$fileNameIMG5);
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][4], "upload/".$fileNameIMG5);  
            }
            if($i == 5){
                unlink("upload/".$fileNameIMG6);
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][5], "upload/".$fileNameIMG6);  
               
            }
        }
        if(count($errors) == 0){
        $timestamp = date("Y-m-d H:i:s"); 
        $update_prd = $timestamp;
        $sql = "UPDATE product SET prd_name = '$prd_name' , prd_brand = '$prd_brand' , prd_type = '$prd_type' , prd_status = '$prd_status' , prd_price = '$prd_price' , prd_gender = '$prd_gender' , prd_detail = '$prd_detail', img1 = '$fileNameIMG1' , img2 = '$fileNameIMG2' , img3 = '$fileNameIMG3' , img4 = '$fileNameIMG4' , img5 = '$fileNameIMG5' , img6 = '$fileNameIMG6' , size_39 = '$size_39' , size_40 = '$size_40' , size_40_5 = '$size_40_5' , size_41 = '$size_41' , size_41_5 = '$size_41_5' , size_42 ='$size_42' , size_42_5 ='$size_42_5', size_43 = '$size_43' , size_44 = '$size_44' , size_44_5 = '$size_44_5' , size_46  = '$size_46', size_47 = '$size_47' , update_prd = '$update_prd' Where prd_id = '$id_product'";  
        mysqli_query($conn,$sql);
        header("location: home.php");
        }

        
        
    }
   
?>
  <script>
    function validateForm() {
        var x = document.forms["myForm"]["fname"].value;
        if (x == "") {
          alert("you must be filled out");
          return false;
        }
    }
    function checkArray() { 
            let emptyArray = []; 
            let nonExistantArray = undefined; 
            let fineArray = [1, 2, 3, 4, 5]; 
  
            if (Array.isArray(emptyArray) && emptyArray.length) 
                output = true; 
            else 
                output = false; 
  
            document.querySelector('.output-empty').textContent = output; 
  
            if (Array.isArray(nonExistantArray) && nonExistantArray.length) 
                output = true; 
            else 
                output = false; 
  
            document.querySelector('.output-non').textContent = output; 
  
            if (Array.isArray(fineArray) && fineArray.length) 
                output = true; 
            else 
                output = false; 
  
            document.querySelector('.output-ok').textContent = output; 
        } 
    </script>

   