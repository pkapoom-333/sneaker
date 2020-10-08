<?php
session_start();
include('connection.php');
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
    <link rel="stylesheet" href="./css/style-site.css"/>
    <link rel="stylesheet" href="./css/swiper.min.css"/>


    
    <!--map-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
        function initMap() {
            var location = {lat: 13.756331, lng: 100.501762};
            var map = new google.maps.Map(document.getElementById("Map-Search"),{
                zoom: 4,
                center: location
            });
            var marker = new google.map.Marker({
                position: location,map: map
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5rClfebRKivltuiEJmS4BwXcXFO8Ir9Y&callback=initMap"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
</head>
<body>  
    
    <div class="header">
        <div class="container">
            <div class="header-grid">
                <div class="logo">
                    <h1>Snaekey</h1>
                    <h2>Crawling</h2>
                </div>
                <div class="Search">
                    <input class="searctext" type="text"  placeholder="Searc">
                    <button class="bntSearch"><i class="fas fa-search"></i></button>
                </div>
                <div class="MenuProfile"> 
                    <button class="btnprofile"><i class="fas fa-user-circle"></i></button>
                    <div class="dropdown-menuprofile">
                        <?php if (isset($_SESSION['member_email'])) : ?>
                          <a href="profile.php">แก้ไขข้อมูลส่วนตัว</a>
                          <a href="profile.php">แก้ไขข้อมูลร้านค้า</a>
                          <a href="profile.php">รายการโปรด</a> 
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
                    <a href="#">แบรนด์</a>
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
                  <a href="add-product-pase2.php">ลงขาย</a>
                  <a href="profile.php">รายการโปรด</a> 
                  <?php endif ?> 
                  <?php if (isset($_SESSION['add_market'])) : ?>
                  <a href="add-product-pase1.php">ลงขาย</a>
                  <a href="profile.php">รายการโปรด</a> 
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
                        <button class="button-Seller">
                            <?php while($row = $res_maket->fetch_array()):?>
                            <div class="content-sell-img">
                            <a href="#"><img src="./product/2.png" alt="Seller-img" class="Seller-img"></a>
                            </div>
                            <div class="content-sell-text">
                                <a href="#" class="Date-Seller"><?= $row["mrk_name"]?>

                                </a>
                                <a href="#" class="Date-Seller">เป็นสมาชิกตั้งแต่ :<?= $row["mrk_regis_time"]?></a>
                                <a href="#" class="Date-Seller">เรตติ้ง : ดีมาก</a>
                                <a href="#" class="Date-Seller">เปิดทำการ: <?= $row["mrk_open"]?> - <?= $row["mrk_open"]?> </a>
                                <a href="#" class="Date-Seller">เบอร์โทรติดต่อ: <?= $row["mrk_phone"]?></a>
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
                        <div class="img-product-show">
                           <input type="radio" name="slide" id="img1">
                           <input type="radio" name="slide" id="img2">
                           <input type="radio" name="slide" id="img3">
                           <input type="radio" name="slide" id="img4">
                           <input type="radio" name="slide" id="img5">
                           <input type="radio" name="slide" id="img6"> 
                           
                           <img src='upload/<?= $row["img1"]?>' class="m1" alt="img1">
                           <img src='upload/<?= $row["img2"]?>' class="m2" alt="img2">
                           <img src='upload/<?= $row["img3"]?>' class="m3" alt="img3">
                           <img src='upload/<?= $row["img4"]?>' class="m4" alt="img4">
                           <img src='upload/<?= $row["img5"]?>'class="m5" alt="img5">
                           <img src='upload/<?= $row["img6"]?>' class="m6" alt="img6">
                        </div>
                        <div class="dots">
                            <label for="img1"></label>
                            <label for="img2"></label>
                            <label for="img3"></label>
                            <label for="img4"></label>
                            <label for="img5"></label>
                            <label for="img6"></label>
                        </div>
                        </div>   
                </div>
                        
               
                <div class="Content-right">
                    <a class="tele-name-product"><?= $row["prd_name"]?></a>
                    <a class="tele-type-product"><?= $row["prd_type"]?></a>
                    <a class="tele-status-product"><?= $row["prd_status"]?></a>
                    <a class="tele-price-product"> <?= $row["prd_price"]?> บาท </a>
                    <a class="tele-siae-product">Size </a>
                    <div class="gride-lable-sizq">
                        <a class="tele-size-product">EU 39 <br>(<?= $row["size_39"]?>)</a>
                        <a class="tele-size-product">EU 40 <br>(<?= $row["size_40"]?>)</a>
                        <a class="tele-size-product">EU 40.5 <br>(<?= $row["size_40_5"]?>)</a>
                        <a class="tele-size-product">EU 41 <br>(<?= $row["size_41"]?>)</a>
                        <a class="tele-size-product">EU 41.5 <br>(<?= $row["size_41_5"]?>)</a>
                        <a class="tele-size-product">EU 42 <br>(<?= $row["size_42"]?>)</a>
                        <a class="tele-size-product">EU 42.5 <br>(<?= $row["size_42_5"]?>)</a>
                        <a class="tele-size-product">EU 43 <br>(<?= $row["size_43"]?>)</a>
                        <a class="tele-size-product">EU 44 <br>(<?= $row["size_44"]?>)</a>
                        <a class="tele-size-product">EU 44.5 <br>(<?= $row["size_44_5"]?>)</a>
                        <a class="tele-size-product">EU 46 <br>(<?= $row["size_46"]?>)</a>
                        <a class="tele-size-product">EU 47 <br>(<?= $row["size_47"]?>)</a>
                        <a class="tele-size-product">EU 47.5 <br>(<?= $row["size_47_5"]?>)</a>
                    </div>
                    <a class="tele-conten-product">รายละเอียด </a>
                    <a class="tele-scrip-product"><?= $row["prd_detail"]?></a>
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
                            <a class="tele-facebook-product"><?= $row["mrk_fb"]?></a>     
                        </div>
                        <div class="ig">
                            <i class="fab fa-instagram-square"></i>
                            <a class="tele-ig-product"><?= $row["mrk_line"]?></a>
                        </div>
                        <div class="line">
                            <i class="fab fa-line"></i>
                            <a class="tele-line-product"><?= $row["mrk_ig"]?></a>
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
                            <a class="tele-edit-product"><?= $row["mrk_city"]?> ,  <?= $row["mrk_address"]?></a>
                        
                        </div>
                        <?php endwhile; ?> 
                </div> 
            </div>  
            <div class="like-view">
                
                <button class="button-like">  
                   <i class="far fa-heart"></i>
                   <a href="#" class="like">รายการโปรด</a>
                </button> 
                <?php
                    if (isset($_GET['show'])) {
                    $id_product = $_GET['show'];
                    $res_Show_abot_view = $conn->query("SELECT * From product Where prd_id = '$id_product'");
                            
                           
                    } 
                ?>
                <?php while($row = $res_Show_abot_view->fetch_array()):?>
               <a href="#" class="view">View  <?= $row["prd_view"]?></a>
               <?php endwhile; ?> 
               
               <button class="repoet-product">
                   <i class="fas fa-exclamation-circle"></i>
                   <a class="tele-repost-product">รายงานพฤติกรรม</a>
               </button>  
           </div>
            
            
            
            <div class="review-product">   
              <div class="gried-review">
                    <a class="tele-rexiew">รีวิว : (1)</a>
                    <div class="point-review-product">
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    <i class="far fa-star"></i>
                    </div>
                <div class="list-post">
                    <a class="tele-list-post">จัดเรียง</a>
                    <div class="drowdown-point-review">
                    <select>
                        <option value="">ล่าสุด</option>
                        <option value="">โพสต์แรก</option>
                    </select>
                    <i class="fas fa-chevron-down"></i> 
                    </div>
                </div>
                <div class="list-star" >  
                    <a class="tele-lit-star">กรอง  :</a>
                    <div class="drowdown-point-review">
                    <select>
                        <option value="">ทั้งหมด</option>
                        <option value="">1 ดาว</option>
                        <option value="">2 ดาว</option>
                        <option value="">3 ดาว</option>
                        <option value="">4 ดาว</option>
                        <option value="">5 ดาว</option>
                    </select>
                    <i class="fas fa-chevron-down"></i> 
                    </div>
                </div> 
                <button class="button-write-post">เขียนรีวิว</button>  
              </div>
              <div class="line-comment"></div>
            </div>
            <a class="line-comment"></a>
            <div class="comment">
                
                <div class="gride-commnet">
                  <div class="countstar-date-post-cmment">
                    <div class="point-review-product">
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>  
                    </div>
                 </div>
                 
                    <div class="NameCus-RepostPost">  
                        <input class="Name-cus-post">
                        <button class="report-post">รีวิว
                        </button>
                    </div>
                    <div class="line-comment"></div>
                </div>
            
            
            <div class="comment">
                
                <div class="gride-commnet">
                  <div class="countstar-date-post-cmment">
                    <div class="point-review-product">
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>  
                    </div>
                    <a class="Date-post">1 วันที่ผ่านมา</a>
                 </div>
                 
                    <div class="NameCus-RepostPost">  
                    <a class="Name-cus-post">โดย fon</a>
                    <button class="report-post">
                        <i class="fas fa-exclamation-circle"></i>  รายงาน
                    </button>
                    </div>
                    <div class="content-comment">
                    <a class="Name-cus-post">ร้านค้าใจดีมากคับ บริการทำความสะอาดฟรีด้วยคับ</a>
                    </div>
                    <div class="line-comment"></div>
                </div>
                

            </div>
            
        </div>
    </div> 
    </div>

</body>
</html>