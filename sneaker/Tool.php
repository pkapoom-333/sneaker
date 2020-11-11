<?php
    
    session_start();
    include('connection.php');

    $errors = array();
    
    if(isset($_POST['action']))
    {   
        $sql = "SELECT * FROM product WHERE prd_id ";
        $sqlpage = "SELECT * FROM product WHERE prd_id ";
        $sql_Market = "SELECT * FROM market_info WHERE mrk_id != '' ";
        if(!empty($_POST['MapMarket']))
        {   
            $city = $_POST["MapMarket"];
            $sql_Market .= "AND mrk_city IN('".$city."')";
        }
        if($_POST["rating"]=="1"){
            $Minrating = 0.00;
            $Maxrating = 1.99;
            $sql_Market .= "AND mrk_count_prd BETWEEN '".$Minrating."' AND '".$Maxrating."'";
        }
        if($_POST["rating"]=="2"){
            $Minrating = 2.00;
            $Maxrating = 2.99;
            $sql_Market .= "AND mrk_count_prd BETWEEN '".$Minrating."' AND '".$Maxrating."'";
        }
        if($_POST["rating"]=="3"){
            $Minrating = 3.00;
            $Maxrating = 3.99;
            $sql_Market .= "AND mrk_count_prd BETWEEN '".$Minrating."' AND '".$Maxrating."'";
        }
        if($_POST["rating"]=="4"){
            $Minrating = 4.00;
            $Maxrating = 4.99;
            $sql_Market .= "AND mrk_count_prd BETWEEN '".$Minrating."' AND '".$Maxrating."'";
        }
        if($_POST["rating"]=="5"){
            $sql_Market .= "AND mrk_count_prd = '".$_POST["rating"]."'";
        }
        if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	    {
		    $sql .= "AND prd_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";
        }
        if(isset($_POST['status']))
        {   
            $status = implode("','", $_POST["status"]);
            $sql .= "AND prd_status IN('".$status."')";
            $sqlpage .= "AND prd_status IN('".$status."')";
            
        }
        if(isset($_POST["brand"]))
        {
            $brand = implode("','", $_POST["brand"]);
            $sql .= "AND prd_brand IN('".$brand."')";
            $sqlpage .= "AND prd_brand IN('".$brand."')";
        }
        if(isset($_POST["type"]))
        {
            $type = implode("','", $_POST["type"]);
            $sql .= "AND prd_type IN('".$type."')";
            $sqlpage .= "AND prd_type IN('".$type."')";
        }
        if(isset($_POST["gender"]))
        {
            $gender = implode("','", $_POST["gender"]);
            $sql .= "AND prd_gender IN('".$gender."')";
            $sqlpage .= "AND prd_gender IN('".$gender."')";
        }
        $resultMarket = $conn->query($sql_Market);
        $output = '';
        $i=0;
        $marketAll = "";
        while($row = $resultMarket->fetch_assoc()){    
            $market_row = $row['mrk_id'];
            $marketAll .= "$market_row','";
        }
        
        if(!empty($_POST['MapMarket'])){
            $All = array($marketAll);
            $implodeAll = implode("','",$All);
            $sql .="AND id_market IN('".$implodeAll."') ";
            $sqlpage .="AND id_market IN('".$implodeAll."') ";
        }
        if($_POST["MaxorMin"]=="minfrest"){
            $sql .="ORDER BY prd_price ASC";
        }
        
        if($_POST["MaxorMin"]=="maxfrest"){
            $sql .="ORDER BY prd_price DESC";
        } 
        if($_POST["MaxorMin"]=="ALL"){
            $sql .="ORDER BY on_prd DESC";
        }
        if($_POST["page"]=="1"){
            $sql .= " LIMIT 0,15";
        }
        if($_POST["page"]=="2"){
            $sql .= " LIMIT 15,15";
        }
        if($_POST["page"]=="3"){
            $sql .= " LIMIT 30,15";
        }
        $result = $conn->query($sql);
        $resultpase = $conn->query($sqlpage);
        $resuli_select_db = 15;
        $number_of_results = mysqli_num_rows($resultpase);
        $number_of_pages = ceil($number_of_results/$resuli_select_db);
        if($resultMarket->num_rows>0){
            if($result->num_rows>0){
                $output .= '<div class="item-Newbands-gride" id="result">';
            while($row = $result->fetch_assoc()){ 
                $id_market = $row["id_market"];
                $res_product_Show_Market = $conn->query("SELECT * FROM market_info where mrk_id = '$id_market'");
                while($rowMarket = $res_product_Show_Market->fetch_assoc()){
                       $mrk_name = $rowMarket["mrk_name"]; 
                 }
                $output .= '
                    <div href="pase-product.php" class="item-show" >
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'"><img src="upload/'. $row['img1'] .'" alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'" class="Nameproduct">'. $row['prd_name'] .'</a>
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="NameSell">ลงขายโดย : '. $mrk_name .'</a>
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="PiceProduct-show">'. $row['prd_price'] .'บาท</a> 
                    </div> 
                ';
            }
            $output .= '
            </div>
            <ul class="pagination" id="limit" style="margin-top: 1380px;">
            ';
            for($page=1;$page<=$number_of_pages;$page++){
                if($_POST["page"]==$page){
                    $output .= '<li class="pageNumber active"><a href="New-product.php?page='.$page.'">'.$page.'</a>';
                }
                if($_POST["page"]!=$page){
                    $output .= '<li class="pageNumber"><a href="New-product.php?page='.$page.'">'.$page.'</a>';
                }             
            }
            $output .= '
            </ul> 
            ';
        }
        }else{
            $output = "Not Found";
        }
        echo $output;
    }
    if(isset($_POST['actionBand']))
    {   
        $sql = "SELECT * FROM product WHERE prd_id ";
        $sqlpage = "SELECT * FROM product WHERE prd_id ";
        $sql_Market = "SELECT * FROM market_info WHERE mrk_id != '' ";
        if(!empty($_POST['MapMarket']))
        {   
            $city = $_POST["MapMarket"];
            $sql_Market .= "AND mrk_city IN('".$city."')";
        }
        if($_POST["rating"]=="1"){
            $Minrating = 0.00;
            $Maxrating = 1.99;
            $sql_Market .= "AND mrk_count_prd BETWEEN '".$Minrating."' AND '".$Maxrating."'";
        }
        if($_POST["rating"]=="2"){
            $Minrating = 2.00;
            $Maxrating = 2.99;
            $sql_Market .= "AND mrk_count_prd BETWEEN '".$Minrating."' AND '".$Maxrating."'";
        }
        if($_POST["rating"]=="3"){
            $Minrating = 3.00;
            $Maxrating = 3.99;
            $sql_Market .= "AND mrk_count_prd BETWEEN '".$Minrating."' AND '".$Maxrating."'";
        }
        if($_POST["rating"]=="4"){
            $Minrating = 4.00;
            $Maxrating = 4.99;
            $sql_Market .= "AND mrk_count_prd BETWEEN '".$Minrating."' AND '".$Maxrating."'";
        }
        if($_POST["rating"]=="5"){
            $sql_Market .= "AND mrk_count_prd = '".$_POST["rating"]."'";
        }
        if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	    {
		    $sql .= "AND prd_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";
        }
        if(isset($_POST['status']))
        {   
            $status = implode("','", $_POST["status"]);
            $sql .= "AND prd_status IN('".$status."')";
            $sqlpage .= "AND prd_status IN('".$status."')";
            
        }
        if(isset($_POST["brand"]))
        {
            $brand = implode("','", $_POST["brand"]);
            $sql .= "AND prd_brand IN('".$brand."')";
            $sqlpage .= "AND prd_brand IN('".$brand."')";
        }
        if(isset($_POST["type"]))
        {
            $type = implode("','", $_POST["type"]);
            $sql .= "AND prd_type IN('".$type."')";
            $sqlpage .= "AND prd_type IN('".$type."')";
        }
        if(isset($_POST["gender"]))
        {
            $gender = implode("','", $_POST["gender"]);
            $sql .= "AND prd_gender IN('".$gender."')";
            $sqlpage .= "AND prd_gender IN('".$gender."')";
        }
        $resultMarket = $conn->query($sql_Market);
        $output = '';
        $i=0;
        $marketAll = "";
        while($row = $resultMarket->fetch_assoc()){    
            $market_row = $row['mrk_id'];
            $marketAll .= "$market_row','";
        }
        
        if(!empty($_POST['MapMarket'])){
            $All = array($marketAll);
            $implodeAll = implode("','",$All);
            $sql .="AND id_market IN('".$implodeAll."') ";
            $sqlpage .="AND id_market IN('".$implodeAll."') ";
        }
        if($_POST["MaxorMin"]=="minfrest"){
            $sql .="ORDER BY prd_price ASC";
        }
        if($_POST["MaxorMin"]=="ALL"){
            $sql .="ORDER BY prd_view DESC";
        }

        if($_POST["MaxorMin"]=="maxfrest"){
            $sql .="ORDER BY prd_price DESC";
        } 
        if($_POST["page"]=="1"){
            $sql .= " LIMIT 0,15";
        }
        if($_POST["page"]=="2"){
            $sql .= " LIMIT 15,15";
        }
        if($_POST["page"]=="3"){
            $sql .= " LIMIT 30,15";
        }
        $result = $conn->query($sql);
        $resultpase = $conn->query($sqlpage);
        $resuli_select_db = 15;
        $number_of_results = mysqli_num_rows($resultpase);
        $number_of_pages = ceil($number_of_results/$resuli_select_db);
        if($resultMarket->num_rows>0){
            if($result->num_rows>0){
                $output .= '<div class="item-Newbands-gride" id="result">';
            while($row = $result->fetch_assoc()){ 
                $id_market = $row["id_market"];
                $res_product_Show_Market = $conn->query("SELECT * FROM market_info where mrk_id = '$id_market'");
                while($rowMarket = $res_product_Show_Market->fetch_assoc()){
                       $mrk_name = $rowMarket["mrk_name"]; 
                 }
                
                $output .= '
                    <div href="pase-product.php" class="item-show" >
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'"><img src="upload/'. $row['img1'] .'" alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'" class="Nameproduct">'. $row['prd_name'] .'</a>
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="NameSell">ลงขายโดย : '. $mrk_name .'</a>
                    <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="PiceProduct-show">'. $row['prd_price'] .'บาท</a> 
                    </div> 
                ';
            }
            $output .= '
            </div>
            <ul class="pagination" id="limit" style="margin-top: 1380px;">
            ';
            for($page=1;$page<=$number_of_pages;$page++){
                if($_POST["page"]==$page){
                    $output .= '<li class="pageNumber active"><a href="New-product.php?page='.$page.'">'.$page.'</a>';
                }
                if($_POST["page"]!=$page){
                    $output .= '<li class="pageNumber"><a href="New-product.php?page='.$page.'">'.$page.'</a>';
                }             
            }
            $output .= '
            </ul> 
            ';
        }
        }else{
            $output = "Not Found";
        }
        echo $output;
    }
    
    if(isset($_POST['actionreview'])){
        $id_product = $_POST['idproduct'];
        $sqlreview = "SELECT * From review_prd Where Id_product_reviwe = '$id_product' ";
        $list = $_POST['listSelect'];
    
        if(isset($_POST['countpoint']))
        {
            $countpoint = implode("','", $_POST["countpoint"]);
            $sqlreview .= "AND review_count_point IN('".$countpoint."')";
        }
        if($_POST['listSelect']=="Now"){
            $sqlreview .="ORDER BY review_date DESC";
        }
        if($_POST['listSelect']=="friest"){
            $sqlreview .="ORDER BY review_date ASC";
        }
        
        if(isset($_POST['report']))
        {   
            $blockspamreport = 0;
            $blockspamreport += 1;
            $query_id = "SELECT * From product WHERE prd_id = '$id_product'";
            $res = mysqli_query($conn,$query_id);
            $countreport = 0;
            while($row = mysqli_fetch_array($res)){
              $countreport += $row['prd_report'];
            }
            $countreport += $_POST['report'];
            $UpdateReport = "UPDATE product SET prd_report = '$countreport'  Where prd_id = '$id_product' ";
            mysqli_query($conn,$UpdateReport);
        }
        if(isset($_POST['view']))
        {   
            $query_id = "SELECT * From product WHERE prd_id = '$id_product'";
            $resView = mysqli_query($conn,$query_id);
            $prd_view = 0;
            while($row = mysqli_fetch_array($resView)){
              $prd_view += $row['prd_view'];
            }
            $prd_view += 1;
            $UpdateView = "UPDATE product SET prd_view = '$prd_view'  Where prd_id = '$id_product' ";
            mysqli_query($conn,$UpdateView);
        }
        $resultreview  = $conn->query($sqlreview);
        $output = '';
        if($resultreview->num_rows>0){
            while($row = $resultreview->fetch_assoc()){ 
                $output .= '
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
                        <i class="fas fa-star"style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                    ';  
                }
                if($row["review_count_point"]=="1"){ 
                    $output .= '
                        <i class="fas fa-star"style="color: #021F54;"></i>
                    ';  
                }
                $output .= '
                    </div>
                    <a class="Date-post" style="margin-left: 665px;">'. $row['review_date'] .'</a>
                </div> 
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
                ';   
                       
            }
        }
        else{
            $output = "Not Found";
        }
       echo $output;
       
        }

?>