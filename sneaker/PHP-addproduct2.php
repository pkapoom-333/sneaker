<?php
   session_start();
   include('connection.php');

   $errors = array();
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   } 
   
    if (isset($_POST['addproduct2'])) {
        
       
       $prd_name = mysqli_real_escape_string($conn,$_POST['prd_name']);
       $prd_brand = mysqli_real_escape_string($conn,$_POST['prd_brand']);
       $prd_type = mysqli_real_escape_string($conn,$_POST['prd_type']);
       $prd_status  = mysqli_real_escape_string($conn,$_POST['prd_status']);;
       $prd_price = mysqli_real_escape_string($conn,$_POST['prd_price']); 
       $prd_gender = mysqli_real_escape_string($conn,$_POST['prd_gender']);
       
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
       $query_id_product = "SELECT * From product where prd_id ";
       $res_product = mysqli_query($conn,$query_id_product);
       $fileNameIMG1 = " ";
       $fileNameIMG2 = " ";
       $fileNameIMG3 = " ";
       $fileNameIMG4 = " ";
       $fileNameIMG5 = " ";
       $fileNameIMG = " ";

       $last_id_product=0;
       
       if(mysqli_num_rows($res_product) == 0){
            $billnumber_product = "16000001";
            //echo  "TTTTT";
            //echo $billnumber_product;

       }else{
           while($row = mysqli_fetch_array($res_product)){
           $last_id_product = $row['prd_id']; 
            }
       
       $next_id_product = ($last_id_product+1);
       $Num_id_product = "1600";
       $next_id_product = $next_id_product - 1600;
       $billnumber_product = $Num_id_product + $next_id_product;  
       //echo  "TTTTT";
       //echo  $billnumber_product ;
       }
       
       $img_product_1 = '..';
       $fileCount = count($_FILES['img_product_1']['name']);
       
       $query_id_product_IMG = "SELECT * From product where prd_id ";
       $res_product_IMG = mysqli_query($conn,$query_id_product_IMG);
       $last_id_IMG = 0;
       if(mysqli_num_rows($res_product_IMG) == 0){
        $NewNameIMG1 = "91000" + 16000000 + 1;
        $NewNameIMG2 = "92000" + 16000000 + 2;
        $NewNameIMG3 = "93000" + 16000000 + 3;
        $NewNameIMG4 = "94000" + 16000000 + 4;
        $NewNameIMG5 = "95000" + 16000000 + 5;
        $NewNameIMG6 = "96000" + 16000000 + 6;

        }else{
            while($row = mysqli_fetch_array($res_product_IMG)){
                $last_id_IMG = $row['prd_id']; 
                //echo "999999999999".$last_id_IMG;
            }
            $next_id_IMG = $last_id_IMG + 1; 
           
            $NewNameIMG1 = "91000" + $next_id_IMG + 1 ;
            $NewNameIMG2 = "92000" + $next_id_IMG + 2 ;
            $NewNameIMG3 = "93000" + $next_id_IMG + 3 ;
            $NewNameIMG4 = "94000" + $next_id_IMG + 4 ;
            $NewNameIMG5 = "95000" + $next_id_IMG + 5 ;
            $NewNameIMG6 = "96000" + $next_id_IMG + 6 ;

        }
       
       for($i = 0; $i < $fileCount; $i++) {
            if($i == 0){
                $NewNameIMG1 = $NewNameIMG1 + $billnumber_product - 16000000 - 1;
                $fileNameIMG1 = $_FILES['img_product_1']['name'][$i];
                $fileextIMG1 = explode('.',$fileNameIMG1);
                $fileActualExtIMG1 = strtolower(end($fileextIMG1));
                $fileNameNewIMG1 = $NewNameIMG1.".".$fileActualExtIMG1 ;

                //echo "/////fileActualExtIMG1//////".$fileActualExtIMG1;
                //echo "/////fileNameNew//////".$fileNameNewIMG1;
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][$i], "upload/".$fileNameNewIMG1);  
               
            }
            if($i == 1){
                $NewNameIMG2 = $NewNameIMG2 + $billnumber_product - 16000000 - 1;
                $fileNameIMG2 = $_FILES['img_product_1']['name'][$i];
                $fileextIMG2 = explode('.',$fileNameIMG2);
                $fileActualExtIMG2 = strtolower(end($fileextIMG2));
                $fileNameNewIMG2 = $NewNameIMG2.".".$fileActualExtIMG2 ;

                //echo "/////fileActualExtIMG1//////".$fileActualExtIMG2;
                //echo "/////fileNameNew//////".$fileNameNewIMG2;
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][$i], "upload/".$fileNameNewIMG2);  
               
            }
            if($i == 2){
                $NewNameIMG3 = $NewNameIMG3 + $billnumber_product - 16000000 - 1;
                $fileNameIMG3 = $_FILES['img_product_1']['name'][$i];
                $fileextIMG3 = explode('.',$fileNameIMG3);
                $fileActualExtIMG3 = strtolower(end($fileextIMG3));
                $fileNameNewIMG3 = $NewNameIMG3.".".$fileActualExtIMG3 ;

                //echo "/////fileActualExtIMG1//////".$fileActualExtIMG3;
                //echo "/////fileNameNew//////".$fileNameNewIMG3;
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][$i], "upload/".$fileNameNewIMG3);  
               
            }
            if($i == 3){
                $NewNameIMG4 = $NewNameIMG4 + $billnumber_product - 16000000 - 1;
                $fileNameIMG4 = $_FILES['img_product_1']['name'][$i];
                $fileextIMG4 = explode('.',$fileNameIMG4);
                $fileActualExtIMG4 = strtolower(end($fileextIMG4));
                $fileNameNewIMG4 = $NewNameIMG4.".".$fileActualExtIMG4 ;

                //echo "/////fileActualExtIMG1//////".$fileActualExtIMG2;
                //echo "/////fileNameNew//////".$fileNameNewIMG4;
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][$i], "upload/".$fileNameNewIMG4);  
               
            }
            if($i == 4){
                $NewNameIMG5 = $NewNameIMG5 + $billnumber_product - 16000000 - 1;
                $fileNameIMG5 = $_FILES['img_product_1']['name'][$i];
                $fileextIMG5 = explode('.',$fileNameIMG5);
                $fileActualExtIMG5 = strtolower(end($fileextIMG5));
                $fileNameNewIMG5 = $NewNameIMG5.".".$fileActualExtIMG5 ;

                //echo "/////fileActualExtIMG1//////".$fileActualExtIMG5;
                //echo "/////fileNameNew//////".$fileNameNewIMG5;
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][$i], "upload/".$fileNameNewIMG5);  
            }
            if($i == 5){
                $NewNameIMG6 = $NewNameIMG6 + $billnumber_product - 16000000 - 1;
                $fileNameIMG6 = $_FILES['img_product_1']['name'][$i];
                $fileextIMG6 = explode('.',$fileNameIMG6);
                $fileActualExtIMG6 = strtolower(end($fileextIMG6));
                $fileNameNewIMG6 = $NewNameIMG6.".".$fileActualExtIMG6 ;

                //echo "/////fileActualExtIMG1//////".$fileActualExtIMG6;
                //echo "/////fileNameNew//////".$fileNameNewIMG6;
                move_uploaded_file($_FILES['img_product_1']['tmp_name'][$i], "upload/".$fileNameNewIMG6);  
               
            }
        }
        
        if ($prd_type == "Null"){
             array_push($errors,"กรุณาเลือกประเภท"); 
             header("location: add-product-pase2.php");
             $_SESSION['error-type'] = "กรุณาเลือกประเภท";
        }
        if ($prd_brand == "Null"){
            array_push($errors,"กรุณาเลือกแบรนด์สินค้า"); 
            header("location: add-product-pase2.php");
            $_SESSION['error-band'] = "Error!";
        }
        if ($prd_status == "Null"){
            array_push($errors,"กรุณาเลือกสภาพสินค้า"); 
            header("location: add-product-pase2.php");
            $_SESSION['error-status'] = "Error!";
        }

        if(count($errors) == 0){
            $review_id = 0;
            $id_market = $_SESSION['member_id'];
            $timestamp = date("d-m-Y H:i:s"); 
            $on_prd = $timestamp;
            $update_prd = $timestamp;
            $prd_count_review = 0;
            $review_id = $billnumber_product;
            $sql_Market = "SELECT * From market_info Where mrk_id = '$id_market'";
            $res_Market = mysqli_query($conn,$sql_Market);
            
            while($row = mysqli_fetch_array($res_Market)){
                $_SESSION['prd_Name_Maket']  = $row['mrk_name']; 
                $prd_Name_Maket = $_SESSION['prd_Name_Maket']; 
                //echo $prd_Name_Maket ; 
            }
            
            $sql_product = "INSERT Into product (prd_id,prd_name, prd_brand, prd_type, prd_status, prd_price, prd_gender,prd_detail,img1,img2, img3, img4, img5, img6,size_39, size_40, size_40_5, size_41,size_41_5,size_42,size_42_5, size_43, size_44, size_44_5,size_46,size_47,size_47_5,id_market,on_prd,update_prd,review_id) 
            values ( '$billnumber_product','$prd_name','$prd_brand', '$prd_type', '$prd_status', '$prd_price', '$prd_gender', '$prd_detail','$fileNameNewIMG1','$fileNameNewIMG2','$fileNameNewIMG3', '$fileNameNewIMG4', '$fileNameNewIMG5', '$fileNameNewIMG6', '$size_39', '$size_40', '$size_40_5', '$size_41', '$size_41_5','$size_42','$size_42_5','$size_43', '$size_44', '$size_44_5', '$size_46', '$size_47', '$size_47_5', '$id_market', '$on_prd', '$update_prd','$review_id')";  
            mysqli_query($conn,$sql_product);
            
            //echo "/55555555555555555555555555555555555555555555555555555555555555555555555";
            //$_SESSION['success'] = "Logged in";
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

   