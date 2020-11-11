<?php
    
    session_start();
    include('connection.php');

    $errors = array();
    
    if(isset($_POST['action']))
    {
        $sql = "SELECT * FROM status";
        
        if(isset($_POST['status']))
        {
            $status = implode("','", $_POST["status"]);
            $sql .= "AND prd_status IN('".$status."')";
        }
        if(isset($_POST["brand"]))
        {
            $brand = implode("','", $_POST["brand"]);
            $sql .= "AND product_brand IN('".$brand."')";
        }
        if(isset($_POST["type"]))
        {
            $type = implode("','", $_POST["type"]);
            $sql .= "AND product_brand IN('".$type."')";
        }
        if(isset($_POST["gender"]))
        {
            $gender = implode("','", $_POST["gender"]);
            $sql .= "AND product_brand IN('".$gender."')";
        }
        
        $result = $conn->query($sql);
        $output = '';

        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){ 
                $output .= '
                <div href="pase-product.php" class="item-show">
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'"><img src='. $row['img1'] .'" alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'" class="Nameproduct">'. $row['prd_name'] .'</a>
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="NameSell">ลงขายโดย : '. $row['prd_Name_Maket'] .'</a>
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="PiceProduct-show">'. $row['prd_price'] .'บาท</a> 
                 </div> 
                ';
            }
        }
        else{
            $output = "Not Found";
        }
       echo $output;
    }
    
    if(isset($_POST['actionreview'])){
        $id_product = $_POST['idproduct'];
        $sqlreview = "SELECT * From review_prd Where Id_product_reviwe = '$id_product' ";
        
        if(isset($_POST['countpoint']))
        {
            $countpoint = implode("','", $_POST["countpoint"]);
            $sqlreview .= "AND review_count_point	IN('".$countpoint."')";
        }
    
        $resultreview  = $conn->query($sqlreview);
        
        if($resultreview->num_rows>0){
            while($row = $resultreview->fetch_assoc()){ 
                
                $output .= '
                <div class="gride-commnet">
                    <div class="" style="display: grid; grid-template-columns: 200px 900px;">
                     <div class="point-review-product" style=" width: 200px; height: 25px;">
                ';
                if($row["review_count_point"]=="5"){
                    $output .= '
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        ';     
                }
                if($row["review_count_point"]=="4"){ 
                    $output .= '
                    <i class="fas fa-star" style="color: #021F54;"></i>
                    <i class="fas fa-star" style="color: #021F54;"></i>
                    <i class="fas fa-star" style="color: #021F54;"></i>
                    <i class="fas fa-star" style="color: #021F54;"></i>
                    ';  
                }
                if($row["review_count_point"]=="3"){ 
                    $output .= '
                    <i class="fas fa-star" style="color: #021F54;"></i>
                    <i class="fas fa-star"style="color: #021F54;"></i>
                    <i class="fas fa-star" style="color: #021F54;"></i>
                    ';  
                }
                if($row["review_count_point"]=="2"){ 
                    $output .= '
                    i class="fas fa-star"style="color: #021F54;"></i>
                    <i class="fas fa-star" style="color: #021F54;"></i>
                    ';  
                }
                if($row["review_count_point"]=="1"){ 
                    $output .= '
                    i class="fas fa-star"style="color: #021F54;"></i>
                    ';  
                }
                $output .= '
                </div>
                <a class="Date-post" style="margin-left: 665px;">'. $row['review_date'] .'</a>
                ';        
                $output .= '
                <div class="NameCus-RepostPost">  
                    <a class="Name-cus-post"style=" width: 500px; height: 25px;">รีวิว โดย '. $row['review_Name'] .'</a>
                    <button style=" width: 100px; height: 25px;color: #021F54; border: none;margin-left: 350px; background: #FFFFFF;" class="report-review">
                    <i class="fas fa-exclamation-circle"></i>  รายงาน
                    </button>
                </div>
                <div class="content-comment">
                    <a class="Name-cus-post">'. $row['review_detail'] .'</a>
                </div> 
                <div class="line-comment"></div>
           </div>
                ';
            }
        }
        else{
            $output = "Not Found";
        }
       echo $output;
       echo $id_product ;

    }
    <div class="gride-commnet">
            <div class="" style="  display: grid; grid-template-columns: 200px 900px; ">
            <div class="point-review-product" style=" width: 200px; height: 25px;">
                <?php if ($row["review_count_point"]=="5") : ?>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <i class="fas fa-star" style="color: #021F54;"></i>  
                <?php endif ?> 
                <?php if ($row["review_count_point"]=="4") : ?>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <?php endif ?> 
                <?php if ($row["review_count_point"]=="3") : ?>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <i class="fas fa-star"style="color: #021F54;"></i>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <?php endif ?> 
                <?php if ($row["review_count_point"]=="2") : ?>
                <i class="fas fa-star"style="color: #021F54;"></i>
                <i class="fas fa-star" style="color: #021F54;"></i>
                <?php endif ?> 
                <?php if ($row["review_count_point"]=="1") : ?>
                <i class="fas fa-star"style="color: #021F54;"></i>
                <?php endif ?> 
            </div>
            <a class="Date-post" style="margin-left: 665px;"><?= $row["review_date"]?></a>
        </div>
        <div class="NameCus-RepostPost">  
            <a class="Name-cus-post"style=" width: 500px; height: 25px;">รีวิว โดย  <?= $row["review_Name"]?> </a>
            <button style=" width: 100px; height: 25px;color: #021F54; border: none;margin-left: 350px; background: #FFFFFF;" class="report-review">
            <i class="fas fa-exclamation-circle"></i>  รายงาน
            </button>
            </div>
            <div class="content-comment">
            <a class="Name-cus-post"><?= $row["review_detail"]?></a>
            </div> 
            <div class="line-comment"></div>
    </div>
?>