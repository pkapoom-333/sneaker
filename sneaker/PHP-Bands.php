<?php
    
    session_start();
    include('connection.php');

    $errors = array();
    
if(isset($_POST['action']))
    {   
        $timestamp = date("Y-m-d H:i:s"); 
        $lasttimestamp = "2020-01-01 00:00:00";
        $sql = "SELECT * FROM product ";
        if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	    {
		    $sql .= "AND prd_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";
	    }
        if(isset($_POST['status']))
        {   
            $status = implode("','", $_POST["status"]);
            $sql .= "AND prd_status IN('".$status."')";
        }
        if(isset($_POST["brand"]))
        {
            $brand = implode("','", $_POST["brand"]);
            $sql .= "AND prd_brand IN('".$brand."')";
        }
        if(isset($_POST["type"]))
        {
            $type = implode("','", $_POST["type"]);
            $sql .= "AND prd_type IN('".$type."')";
        }
        if(isset($_POST["gender"]))
        {
            $gender = implode("','", $_POST["gender"]);
            $sql .= "AND prd_gender IN('".$gender."')";
        }
        
        $result = $conn->query($sql);
        $output = '';

        while($row = $result->fetch_assoc()){ 
                $output .= '
                <div href="pase-product.php" class="item-show">
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'"><img src="upload/'. $row['img1'] .'" alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'" class="Nameproduct">'. $row['prd_name'] .'</a>
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="NameSell">ลงขายโดย : '. $row['prd_Name_Maket'] .'</a>
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="PiceProduct-show">'. $row['prd_price'] .'บาท</a> 
                 </div> 
                ';
        }
       echo $output;
    }
    
?>