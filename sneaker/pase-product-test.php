<?php
session_start();
include('connection.php');

  if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['member_email']);
    unset($_SESSION['member_id']);
    unset($_SESSION['Show_market']);
    unset($_SESSION['add_market']);
    header("location: login.php");
  }

  $ch=curl_init();
  curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
  $resultMAPUser=curl_exec($ch);
  $resultMAPUser=json_decode($resultMAPUser);
  
  if($resultMAPUser->status=='success'){
    $MapUser = "$resultMAPUser->lat,$resultMAPUser->lon";
  }

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,inital-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- FontAwesome CDN-->
    <script src="https://kit.fontawesome.com/7fefb669ea.js" crossorigin="anonymous"></script>

    <!--Custom Stylesheet-->
    <link rel="stylesheet" href="./css/style-project6.css"/>
    <link rel="stylesheet" href="./css/swiper.min.css"/>

    <link rel="stylesheet" href="jquery.rateyo.css"/>
    
    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   

</head>
<body>  
    
    <div class="header">
        <div class="container">
            <div class="header-grid">
                <div class="logo">
                    <h1>Snaekey</h1>
                    <h2>Crawling</h2>
                </div>
                <form action="PHP-Search.php" method="POST">
                <div class="Search">
                    <input class="searctext" type="text" name="Namesearch" placeholder="Searc">
                    <button type="submit" class="bntSearch" name="search" ><i class="fas fa-search"></i></button>
                </div>
                </form>
                <div class="MenuProfile"> 
                    <?php if (empty($_SESSION['member_email'])) : ?>
                    <div href="login.php" class="btnprofile"><i class="fas fa-user-circle"></i><a href="login.php" style="width:200px; hight:50px; color: white; margin-left: 5px;">เข้าสู่ระบบ/สมัครสมาชิก</a></div>
                    <?php endif ?>
                    <?php if (!empty($_SESSION['member_email'])) : ?>
                    <div href="login.php" class="btnprofile"><i class="fas fa-user-circle"></i><label href="login.php" style="width:200px; hight:50px; color: white; margin-left: 5px;"><?php echo $_SESSION['Show_name'];?> </label></div>
                    <?php endif ?>
                    <div class="dropdown-menuprofile">
                        <?php if (isset($_SESSION['member_email'])) : ?>
                          <a href="Registor-edit.php">แก้ไขข้อมูลส่วนตัว</a>
                          <a href="Edit-product-pase1.php">แก้ไขข้อมูลร้านค้า</a>
                          <a href="profile.php">โปรไพล์</a>
                          <a href="Home.php?logout='1'">ออกจากระบบ</a>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Nav">
        <div class="container">
            <div class="nav-grid">
                <div class="navMenu">
                    <a href="Home.php">หน้าแรก</a>
                    <a href="NewBands.php">สินค้าใหม่</a>
                 </div>
                 <div class="Menu-ฺband">แบรนด์
                        <div class="dropdown-menuBand">
                          <a href="Bands.php?Band=Nike">Nike</a>
                          <a href="Bands.php?Band=Adidas">Adidas</a>
                          <a href="Bands.php?Band=Vans">Vans</a>
                          <a href="Bands.php?Band=Converse">Converse</a>
                          <a href="Bands.php?Band=Fila">Fila</a>
                        </div>
                      </div>
                 <div class="Rnav">
                  <?php
                    if (isset($_SESSION['member_email'])){
                        $file_market = $_SESSION['member_id'];
                        $res_file_market = $conn->query("SELECT * From market_info Where mrk_id = '$file_market'");
                         while($row = $res_file_market->fetch_array()){
                         $file_market = $row['mrk_id']; 
                         $_SESSION['Show_market']  = $row['mrk_id'];
                        }
                        if(isset($_SESSION['Show_market'])){
                            unset($_SESSION['add_market']);
                        }else{
                            $_SESSION['add_market']  = $file_market;  
                        } 
                    }  
                  ?>
                  <?php if (isset($_SESSION['Show_market'])) : ?>
                  <a href="add-product-pase2.php">เพิ่มสินค้า</a>
                  <a href="profile-like.php">รายการโปรด</a> 
                  <?php endif ?> 
                  <?php if (isset($_SESSION['add_market'])) : ?>
                  <a href="add-product-pase1.php">ลงขาย</a>
                  <a href="profile-like.php">รายการโปรด</a> 
                  <?php endif ?> 
                  
                  <?php if (empty($_SESSION['member_email'])) : ?>
                    <a href="Registor.php">สมัครสมาชิก</a>
                    <a href="login.php">เข้าสู่ระบบ</a>
                  <?php endif ?> 
                </div>
                </div>
            </div>
    </div> 
    <div class="lineNav"></div>
    
    <div class="Show-product">
        <div class="container">
            <div class="Gride-product">
                <div class="Content-left">
                        <div class="tele-name-seller">ผู้จัดจำหน่าย</div>
                        <?php
                            if (isset($_GET['show'])) {
                                $id_product = $_GET['show'];
                                $res_file_market = $conn->query("SELECT * From product Where prd_id = '$id_product'");
                                while($row = $res_file_market->fetch_array()){
                                      $id_market = $row['id_market']; 
                                 }
                                $res_maket = $conn->query("SELECT * From market_info Where mrk_id  = '$id_market'");
                    
                           } 
                        ?>
                        <?php while($row = $res_maket->fetch_array()):?>
                        <button href="profile-Market.php?showMarket=<?php echo $row["mrk_id"];?>" class="button-Seller">
                            <div href="profile-Market.php?showMarket=<?php echo $row["mrk_id"];?>" class="content-sell-img">
                            <a href="profile-Market.php?showMarket=<?php echo $row["mrk_id"];?>"><img src='uploadprofile/<?= $row["mrk_pic"]?>' alt="Seller-img" class="Seller-img"></a>
                            </div>
                            <div class="content-sell-text">
                                <a href="profile-Market.php?showMarket=<?php echo $row["mrk_id"];?>" class="Date-Seller">ลงขายโดย : <?= $row["mrk_name"]?>

                                </a>
                                <a href="profile-Market.php?showMarket=<?php echo $row["mrk_id"];?>" class="Date-Seller">เป็นสมาชิกตั้งแต่ : <?= $row["mrk_regis_time"]?></a>
                                <a href="profile-Market.php?showMarket=<?php echo $row["mrk_id"];?>" class="Date-Seller">เรตติ้ง : ดีมาก</a>
                                <a href="profile-Market.php?showMarket=<?php echo $row["mrk_id"];?>" class="Date-Seller">เปิดทำการ: <?= $row["mrk_open"]?> น. - <?= $row["mrk_open"]?> น. </a>
                                <a href="profile-Market.php?showMarket=<?php echo $row["mrk_id"];?>" class="Date-Seller">เบอร์โทรติดต่อ: <?= $row["mrk_phone"]?></a>
                            </div>
                            <div class="content-sell-icon">
                                <i class="fas fa-angle-right"></i>
                            </div>
                            <?php endwhile; ?>   
                        </button> 
                        
                        <?php
                            if (isset($_GET['show'])) {
                            $id_product = $_GET['show'];
                            $res_Show = $conn->query("SELECT * From product Where prd_id = '$id_product'");
                            
                           
                           } 
                        ?>
                        <?php while($row = $res_Show->fetch_array()):?>
                    <div class="slider-product-show">
                        <img id=featured src='upload/<?= $row["img1"]?>'>    
                            <div id="slide-wrapper" >
                                    <img id="slideLeft" class="arrow" src="product/arrow-left.png">

                                    <div id="slider">
                                        <?php if (!empty($row["img1"])) : ?>
                                            <img class="thumbnail" src='upload/<?= $row["img1"]?>'>
                                        <?php endif ?>
                                        <?php if (!empty($row["img2"])) : ?>
                                            <img class="thumbnail" src='upload/<?= $row["img2"]?>'>
                                        <?php endif ?>
                                        <?php if (!empty($row["img3"])) : ?>
                                            <img class="thumbnail" src='upload/<?= $row["img3"]?>'>
                                        <?php endif ?>
                                        <?php if (!empty($row["img4"])) : ?>
                                            <img class="thumbnail" src='upload/<?= $row["img4"]?>'>
                                        <?php endif ?>
                                        <?php if (!empty($row["img5"])) : ?>
                                            <img class="thumbnail" src='upload/<?= $row["img5"]?>'>
                                        <?php endif ?>
                                        <?php if (!empty($row["img6"])) : ?>
                                            <img class="thumbnail" src='upload/<?= $row["img6"]?>'>
                                        <?php endif ?>
                                    </div>

                                    <img id="slideRight" class="arrow" src="product/arrow-right.png">
                                </div>
                            </div>   
                    </div>
                <script type="text/javascript">
                            let thumbnails = document.getElementsByClassName('thumbnail')

                            let activeImages = document.getElementsByClassName('active')

                            for (var i=0; i < thumbnails.length; i++){

                                thumbnails[i].addEventListener('mouseover', function(){
                                    console.log(activeImages)
                                    
                                    if (activeImages.length > 0){
                                        activeImages[0].classList.remove('active')
                                    }
                                    

                                    this.classList.add('active')
                                    document.getElementById('featured').src = this.src
                                })
                            }


                            let buttonRight = document.getElementById('slideRight');
                            let buttonLeft = document.getElementById('slideLeft');

                            buttonLeft.addEventListener('click', function(){
                                document.getElementById('slider').scrollLeft -= 180
                            })

                            buttonRight.addEventListener('click', function(){
                                document.getElementById('slider').scrollLeft += 180
                            })


                </script>       
               
                <div class="Content-right">
                    <a class="tele-name-product"><?= $row["prd_name"]?></a>
                    <a class="tele-type-product"><?= $row["prd_type"]?></a>
                    <a class="tele-status-product"><?= $row["prd_status"]?></a>
                     <div>   
                        <a class="tele-band-product">แบรนด์ : <?= $row["prd_brand"]?></a>
                        <a class="tele-price-product"> <?= $row["prd_price"]?> บาท </a>
                    </div>   
                    <a class="tele-siae-product">Size </a>
                    <div class="gride-lable-sizq">
                        <?php if ($row["size_39"]>0) : ?>    
                        <a class="tele-size-product">EU 39 <br>(<?= $row["size_39"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_39"]==0) : ?>    
                        <a class="tele-size-product" style="color: #8B8686;border: 1px solid #8B8686;">EU 39 <br>(<?= $row["size_39"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_40"]>0) : ?> 
                        <a class="tele-size-product">EU 40 <br>(<?= $row["size_40"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_40"]==0) : ?> 
                        <a class="tele-size-product" style="color: #8B8686;border: 1px solid #8B8686;">EU 40 <br>(<?= $row["size_40"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_40_5"]>0) : ?> 
                        <a class="tele-size-product">EU 40.5 <br>(<?= $row["size_40_5"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_40_5"]==0) : ?> 
                        <a class="tele-size-product" style="color: #8B8686;border: 1px solid #8B8686;">EU 40.5 <br>(<?= $row["size_40_5"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_41"]>0) : ?> 
                        <a class="tele-size-product">EU 41 <br>(<?= $row["size_41"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_41"]==0) : ?> 
                        <a class="tele-size-product"  style="color: #8B8686;border: 1px solid #8B8686;">EU 41 <br>(<?= $row["size_41"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_41_5"]>0) : ?> 
                        <a class="tele-size-product">EU 41.5 <br>(<?= $row["size_41_5"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_41_5"]==0) : ?> 
                        <a class="tele-size-product" style="color: #8B8686;border: 1px solid #8B8686;">EU 41.5 <br>(<?= $row["size_41_5"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_42"]>0) : ?> 
                        <a class="tele-size-product">EU 42 <br>(<?= $row["size_42"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_42"]==0) : ?> 
                        <a class="tele-size-product" style="color: #8B8686;border: 1px solid #8B8686;">EU 42 <br>(<?= $row["size_42"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_42_5"]>0) : ?> 
                        <a class="tele-size-product">EU 42.5 <br>(<?= $row["size_42_5"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_42_5"]==0) : ?> 
                        <a class="tele-size-product" style="color: #8B8686;border: 1px solid #8B8686;">EU 42.5 <br>(<?= $row["size_42_5"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_43"]>0) : ?> 
                        <a class="tele-size-product">EU 43 <br>(<?= $row["size_43"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_43"]==0) : ?> 
                        <a class="tele-size-product"style="color: #8B8686;border: 1px solid #8B8686;">EU 43 <br>(<?= $row["size_43"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_44"]>0) : ?> 
                        <a class="tele-size-product">EU 44 <br>(<?= $row["size_44"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_44"]==0) : ?> 
                        <a class="tele-size-product"style="color: #8B8686;border: 1px solid #8B8686;">EU 44 <br>(<?= $row["size_44"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_44_5"]>0) : ?> 
                        <a class="tele-size-product">EU 44.5 <br>(<?= $row["size_44_5"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_44_5"]==0) : ?> 
                        <a class="tele-size-product"style="color: #8B8686;border: 1px solid #8B8686;">EU 44.5 <br>(<?= $row["size_44_5"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_46"]>0) : ?> 
                        <a class="tele-size-product">EU 46 <br>(<?= $row["size_46"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_46"]==0) : ?> 
                        <a class="tele-size-product"style="color: #8B8686;border: 1px solid #8B8686;">EU 46 <br>(<?= $row["size_46"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_47"]>0) : ?> 
                        <a class="tele-size-product">EU 47 <br>(<?= $row["size_47"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_47"]==0) : ?> 
                        <a class="tele-size-product"style="color: #8B8686;border: 1px solid #8B8686;">EU 47 <br>(<?= $row["size_47"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_47_5"]>0) : ?> 
                        <a class="tele-size-product">EU 47.5 <br>(<?= $row["size_47_5"]?>)</a>
                        <?php endif ?>
                        <?php if ($row["size_47_5"]==0) : ?> 
                        <a class="tele-size-product"style="color: #8B8686;border: 1px solid #8B8686;">EU 47.5 <br>(<?= $row["size_47_5"]?>)</a>
                        <?php endif ?>
                    </div>
                    <a class="tele-conten-product">รายละเอียด </a>
                    <div type="text" >
                    <?php echo "<p style='padding: 5px;width: 450px;height: 50px; text-align: justify'>".$row["prd_detail"]. "</p>";?>
                    </div>
                        <?php endwhile; ?>  
                    <a class="tele-contact-product">ช่องทางติดต่อ</a>
                        <?php
                            if (isset($_GET['show'])) {
                                $id_product = $_GET['show'];
                                $res_file_market = $conn->query("SELECT * From product Where prd_id = '$id_product'");
                                while($row = $res_file_market->fetch_array()){
                                      $id_market = $row['id_market']; 
                                 }
                                $res_maket_fb_L_IG = $conn->query("SELECT * From market_info Where mrk_id  = '$id_market'");
                    
                           } 
                        ?>
                        <?php while($row = $res_maket_fb_L_IG->fetch_array()):?>
                        <div class="facebook">
                            <i class="fab fa-facebook"></i>
                            <a href="https://www.facebook.com/search/top?q=<?php echo $row["mrk_fb"];?>" class="tele-facebook-product"><?= $row["mrk_fb"]?></a>     
                        </div>
                        <div class="ig">
                            <i class="fab fa-instagram-square"></i>
                            <a href="https://www.instagram.com/<?php echo$row["mrk_ig"];?>" class="tele-ig-product"><?= $row["mrk_ig"]?></a>
                        </div>
                        <div class="line">
                            <i class="fab fa-line"></i>
                            <a href=" https://line.me/ti/p/~<?php echo$row["mrk_line"];?>" class="tele-line-product"><?= $row["mrk_line"]?></a>
                        </div>
                        <?php endwhile; ?> 
                        <?php
                            if (isset($_GET['show'])) {
                            $id_product = $_GET['show'];
                            $res_Show_abot_product = $conn->query("SELECT * From product Where prd_id = '$id_product'");
                            
                           
                           } 
                        ?>
                        <?php while($row = $res_Show_abot_product->fetch_array()):?>
                    <a class="tele-about-product">รายละเอียดการลงขาย</a>
                        <div class="edit-product">
                            <i class="fas fa-edit"></i>
                            <a class="tele-edit-product">อัพเดทล่าสุด <?= $row["update_prd"]?></a>
                        </div>   
                        <div class="date-product">
                            <i class="fas fa-calendar-alt"></i>
                            <a class="tele-edit-product">ลงขายเมื่อ <?= $row["on_prd"]?></a>
                        </div>  
                        <?php endwhile; ?> 
                        <?php
                            if (isset($_GET['show'])) {
                                $id_product = $_GET['show'];
                                $res_file_market = $conn->query("SELECT * From product Where prd_id = '$id_product'");
                                while($row = $res_file_market->fetch_array()){
                                      $id_market = $row['id_market']; 
                                 }
                                $res_maket_city = $conn->query("SELECT * From market_info Where mrk_id  = '$id_market'");
                    
                           } 
                        ?>
                        <?php while($row = $res_maket_city->fetch_array()):?>
                        <div class="address-product">
                            <i class="fas fa-map-marker-alt"></i>
                            <a href="https://www.google.co.th/maps/dir/<?php echo $MapUser;?>/<?php echo $row["mrk_lat_location"];?>,<?php echo $row["mrk_lgt_location"];?>"class="tele-edit-product"><?= $row["mrk_city"]?> ,  <?= $row["mrk_district"]?></a>
                        
                        </div>
                        <?php endwhile; ?> 
                </div> 
            </div>  
            <div class="like-view">
                <?php
                    if (isset($_GET['show'])) {
                    $id_product = $_GET['show'];
                    $res_like= $conn->query("SELECT * From product Where prd_id = '$id_product'");
                    }
                    if(isset($_SESSION['member_email'])){          
                        $member_id = 0;
                        $member_id = $_SESSION['member_id'];
                        $SELECT = "SELECT * From fav Where prd_id = '$id_product' and member_id = '$member_id'";
                        $query = mysqli_query($conn, $SELECT);
                        $result = mysqli_fetch_assoc($query);
                    } 
                ?>
                <?php while($row = $res_like->fetch_array()):?>
                <form action="PHP-Post.php" method="POST">
                <div class="button-like">  
                    <?php if (empty($result)) : ?>
                    <i class="far fa-heart"></i>
                    <?php endif ?> 
                    <?php if (!empty($result)) : ?>
                    <i class="fas fa-heart"></i>
                    <?php endif ?> 
                   <input type="Submit" href="#" style="border: none; background: #FFFFFF;" class="like" name="SubmitLike" value="รายการโปรด">
                   <input type="text" name="Id_product_reviwe" value="<?php echo $row["prd_id"];?>" style="display: none;">
                   <input type="text" id="productview" value="<?php echo $MapUser;?>" style="display: none;" >  
                   <?php if (isset($_SESSION['error-like'])) : ?>
                        <div style="color: red; font-size: 16px;" >*กรุณาเข้าสู่ระบบ</div>  
                                    <?php
                                        unset($_SESSION['error-like']);
                                    ?>  
                    <?php endif ?> 
                </div> 
                </form>
                <?php endwhile; ?>
                <?php
                    if (isset($_GET['show'])) {
                    $id_product = $_GET['show'];
                    $res_Show_abot_view = $conn->query("SELECT * From product Where prd_id = '$id_product'");
                           
                           
                    } 
                ?>
                <?php while($row = $res_Show_abot_view->fetch_array()):?>
               <a href="#" class="view">View  <?= $row["prd_view"]?></a>
               <?php endwhile; ?> 
               
               <div class="repoet-product" onclick="showrepost()">
                   <i class="fas fa-exclamation-circle"></i>
                   <a class="tele-repost-product">รายงานพฤติกรรม</a>
                   <div id="report">
                            <label><input type="radio" class="selector"  name="getreport" value= "1" >สแปม ประกาศซ้ำ</label>
                            <label><input type="radio" class="selector"  name="getreport" value= "1" >สินค้าต้องห้าม / ผิดกฎหมาย</label>
                            <label><input type="radio" class="selector"  name="getreport" value= "1" >สิมิจฉาชีพ หลอกลวง</label>
                    </div>
               </div> 
               <script>
                var expanded = fales;
                function showrepost(){
                var report = document.getElementById("report");
                if(!expanded){
                    report.style.display = "block";
                expanded = true; 
                }else{
                    report.style.display = "none";
                    expanded = false; 
                    }
                }
                </script>
           </div>
            
            
            
            <div class="review-product">   
              <div class="gried-review">
                    <?php
                    if(isset($_GET['show'])) {
                    $id_product = $_GET['show'];
                    $count_res_review = $conn->query("SELECT * From review_prd Where Id_product_reviwe = '$id_product'");
                     $countview=0.00;
                     $Sumreview=0.00;
                     $AVreview=0.00;  
                     $countrow=0;
                    while($row = $count_res_review->fetch_array()){
                        $Sumreview = $Sumreview +$row['review_count_point'];
                        $countview++;
                        $countrow++;
                        $AVreview=0.00;
                        }
                        if($countrow>0){
                        $AVreview = $Sumreview / $countview;
                        $Updaterating = "UPDATE product SET prd_review	 = '$AVreview'  Where prd_id = '$id_product' ";
                        mysqli_query($conn,$Updaterating);
                        }
                    } 
                    ?>
                    <?php if ($countview=="0") : ?>
                    <a class="tele-rexiew">รีวิว : (0)</a>
                    <?php endif ?> 
                    <?php if ($countview>"0") : ?>
                    <a class="tele-rexiew">รีวิว : (<?= $countrow?>)</a>
                    <?php endif ?> 
                    <div class="point-review-product">
                        <?php if ($AVreview==5.00) : ?>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>  
                        <?php endif ?> 
                        <?php if ($AVreview>=4.00&&$AVreview<=4.99) : ?>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i> 
                        <?php endif ?> 
                        <?php if ($AVreview>=3.00&&$AVreview<=3.99) : ?>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="fas fa-star"style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i>
                        <?php endif ?> 
                        <?php if ($AVreview>=2.00&&$AVreview<=2.99) : ?>
                        <i class="fas fa-star"style="color: #021F54;"></i>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i>
                        <?php endif ?> 
                        <?php if ($AVreview>=1.00&&$AVreview<=1.99) : ?>
                        <i class="fas fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i>
                        <i class="far fa-star" style="color: #021F54;"></i>
                        <?php endif ?> 
                    </div>
                <div class="list-post">
                    <a class="tele-list-post">จัดเรียง</a>
                    <div class="drowdown-point-review">
                    <select id="list" onchange="getSelectValue()">
                        <option class="input common_selector" value="Now">ล่าสุด</option>
                        <option class="input common_selector" value="friest">โพสต์แรก</option>
                    </select>
                    <i class="fas fa-chevron-down"></i> 
                    </div>
                </div>
                <div class="list-star" >  
                    <a class="tele-lit-star">กรอง  :</a>
                    <div class="point-review">
                        <div class="select-point-review" onclick="showcheckboxcountpoint()">
                            <select>
                            <option>ทั้งหมด</option>
                            </select>
                            <div class="overSelect"></div>
                        </div>
                        <div id="reviewcountpoint">
                            <label><input type="checkbox" class="input common_selector" value="5" id="countpoint"/>5ดาว</label>
                            <label><input type="checkbox" class="input common_selector" value="4" id="countpoint"/>4ดาว</label> 
                            <label><input type="checkbox" class="input common_selector" value="3" id="countpoint"/>3ดาว</label>
                            <label><input type="checkbox" class="input common_selector" value="2" id="countpoint"/>2ดาว</label>
                            <label><input type="checkbox" class="input common_selector" value="1" id="countpoint"/>1ดาว</label> 
                        </div>
                  </div>
                </div> 
                <script>
                    var expanded = fales;
                    function showcheckboxcountpoint(){
                        var reviewcountpoint = document.getElementById("reviewcountpoint");
                        if(!expanded){
                            reviewcountpoint.style.display = "block";
                            expanded = true; 
                        }else{
                            reviewcountpoint.style.display = "none";
                            expanded = false; 
                        }
                    }
                
                </script>   
                <?php if (isset($_SESSION['member_email'])) : ?>
                <button class="button-write-post" onclick="show()">เขียนรีวิว</button>
                <?php endif ?>
                <?php if (empty($_SESSION['member_email'])) : ?>
                <button class="button-write-post " onclick="showError()">เขียนรีวิว</button>
                <div style="display: none; color: red;" class="Error-post" id="show_Error" >*กรุณาเข้าสูระบบก่อน</div>
                <?php endif ?>
              </div>
              <div class="line-comment"></div>
            </div>
            <a class="line-comment"></a>
            <div class="comment">
                <form action="PHP-Post.php" method="POST">
                <?php
                    if (isset($_GET['show'])) {
                    $id_product = $_GET['show'];
                    $res_Show_abot_view = $conn->query("SELECT * From product Where prd_id = '$id_product'");
                    
                } 
                ?>
                 <?php while($row = $res_Show_abot_view->fetch_array()):?>
                <div class="gride-commnet" style="display: none;" id="inputpost">
                  <div class="countstar-date-post-cmment">
                    <div id="rateYo"></div>
                 </div> 
                    <input type="text" name="rating" id="rating" style="display: none;">  
                    <input type="text" name="Id_product_reviwe" value="<?php echo $row["prd_id"];?>" style="display: none;">
                    <input type="text" name="review_detail" style="height: 30px; width: 600px;">
                    <input type="Submit" class="report-post" name="SummitPost" style="margin-left: 300px; height: 30px; width: 100px;" value="รีวิว">  
                    <div class="line-comment"></div>
                    </form> 
                </div>
                <?php endwhile; ?> 
            <input type="text" id="IDproduct" value="<?=$_GET['show'];?>" style="display: none;"> 
            <div class="comment"> 
                <div class="gride-commnet" id="result">
                </div>
            </div>
        </div>
    </div> 
    </div>

    <script>
     var expanded = fales;
     function show(){
     var reviewcountpoint = document.getElementById("inputpost");
     if(!expanded){
      reviewcountpoint.style.display = "block";
       expanded = true; 
      }else{
        reviewcountpoint.style.display = "none";
        expanded = false; 
         }
    }
    </script>
     <script>
    function showError(){
        var x = document.getElementById("show_Error");
        x.style.display = "block";
     }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">

     $(document).ready(function(){
        filter_data();
        function filter_data()
        {
            var actionreview = 'data';
            var countpoint = get_filter_text('countpoint');
            var idproduct = document.getElementById("IDproduct").value;
            var view = document.getElementById("productview").value;
            var listSelect = document.getElementById("list").value;
            var report = $("input[name=getreport]:checked").val();
            $.ajax({
            url:"Tool.php",
            method:"POST",
            data:{actionreview:actionreview,countpoint:countpoint,idproduct:idproduct,listSelect:listSelect,report:report,view:view},
            success:function(data){
                $("#result").html(data);
            }
            });
        
        
        }   
        function get_filter_text(text_id){
            var filterData = [];
            $('#'+text_id+':checked').each(function(){
                filterData.push($(this).val());
            });
            return filterData;
        }
        function getSelectValue(){
            filter_data();
        }
        $("#list").change(function(){
            filter_data();
        }); 
        $(".common_selector").click(function(){
            filter_data();
        });
        $("input[type=radio]").click(function(){
            filter_data();
        });    
        
    });      
    </script> 
    <script src="jquery.js"></script>
    <script src="jquery.rateyo.js"></script>
    <script>
    $(function () {
        $("#rateYo").rateYo({
        fullStar:true,
        ratedFill: "#021F54",
        onSet:function(rating,rateYolnstance){
        $("#rating").val(rating);
        }
        });

    });
    </script>    
</body>
    <div class="Footter">
   </div>

</html>