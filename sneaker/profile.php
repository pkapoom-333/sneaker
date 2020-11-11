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
    <link rel="stylesheet" href="./css/style-project3.css"/>
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
    
    
    <div class="pase-profile">
        <div class="container">
            <div class="bar-profile">
                <button onclick="location.href='profile.php';" class="button-profile-product">
                  สินค้าที่ลงขาย
                </button>
                <button  onclick="location.href='profile-like.php';" class="button-profile-like-product">
                    รายการโปรด
                  </button>
            </div>     
                  <div class="gried-content-profile-bar">
                                <?php
                                    if (!empty($_SESSION['member_id'])) {
                                        $id_market = $_SESSION['member_id'];
                                         $res_maket = $conn->query("SELECT * From market_info Where mrk_id  = '$id_market'");
                                         $res_maket_Product = $conn->query("SELECT * FROM product WHERE id_market  = '$id_market'");
                                         $countview=0.00;
                                         $Sumreview=0.00;
                                         $AVreview=0.00;  
                                         $countrow=0;
                                         while($row = $res_maket_Product->fetch_assoc()){
                                             $countrow++;
                                             $Sumreview = $Sumreview +$row['prd_review'];
                                             $countview++;
                                             $countrow++;
                                             if($countview>0){
                                                 $AVreview = $Sumreview/$countview;
                                                 $Updaterating = "UPDATE market_info SET mrk_count_prd = '$AVreview'  Where mrk_id = '$id_market' ";
                                                 mysqli_query($conn,$Updaterating);
                                             }
                                         }  
                                    } 

                                ?>
                                <?php while($row = $res_maket->fetch_array()):?>
                                <div class="left-bar-profile">
                                    <div class="profile-sell-img">
                                    <a href="#"><img src='uploadprofile/<?= $row["mrk_pic"]?>' alt="Seller-img" class="Seller-img"></a>
                                    </div>
                                    <div class="profile-sell-text">
                                    <a href="#" class="Date-Seller">ลงขายโดย :<?= $row["mrk_name"]?></a>
                                    <a href="#" class="Date-Seller">เป็นสมาชิกตั้งแต่ :<?= $row["mrk_regis_time"]?></a>
                                    <a href="#" class="Date-Seller">เรตติ้ง : ดีมาก</a>
                                    <a href="#" class="Date-Seller">เปิดทำการ: <?= $row["mrk_open"]?> - <?= $row["mrk_open"]?></a>
                                    <a href="#" class="Date-Seller">เบอร์โทรติดต่อ: <?= $row["mrk_phone"]?></a>
                                    </div>
                                </div>
                                <div class="right-bar-profile">
                                <div class="gried-bar-ratting">
                                    <a class="bar-content-ratting">เรตติ้ง : ดีมาก</a>
                                    <div class="bar-content-icon-ratting">
                                    <?php if ($row["mrk_count_prd"]==5.00) : ?>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="fas fa-star" style="color: #021F54;"></i>  
                                    <?php endif ?> 
                                    <?php if ($row["mrk_count_prd"]>=4.00&&$row["mrk_count_prd"]<=4.99) : ?>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i> 
                                    <?php endif ?> 
                                    <?php if ($row["mrk_count_prd"]>=3.00&&$row["mrk_count_prd"]<=3.99) : ?>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="fas fa-star"style="color: #021F54;"></i>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i>
                                    <?php endif ?> 
                                    <?php if ($row["mrk_count_prd"]>=2.00&&$row["mrk_count_prd"]<=2.99) : ?>
                                    <i class="fas fa-star"style="color: #021F54;"></i>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i>
                                    <?php endif ?> 
                                    <?php if ($row["mrk_count_prd"]>=0.00&&$row["mrk_count_prd"]<=1.99) : ?>
                                    <i class="fas fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i>
                                    <i class="far fa-star" style="color: #021F54;"></i>
                                    <?php endif ?>
                                    </div>
                                </div>  
                                <div class="gried-bar-contect"> 
                                <div class="bar-facebook-profile">
                                        <i class="fab fa-facebook"></i>
                                        <a class="tele-facebook-product"><?= $row["mrk_fb"]?></a>     
                                    </div>
                                    <div class="bar-ig-profile">
                                        <i class="fab fa-instagram-square"></i>
                                        <a class="tele-ig-product"><?= $row["mrk_line"]?></a>
                                    </div>
                                    <div class="bar-line-peofile">
                                        <i class="fab fa-line"></i>
                                        <a class="tele-line-product"><?= $row["mrk_ig"]?></a>
                                    </div>
                                </div>
                                <?php endwhile; ?> 
                        
                    </div>
                 
            </div>
           <div class="line-bar-profile"></div> 
            <div class="profile-product">
                <div class="gried-profile-product">
                    <button onclick="location.href='add-product-pase2.php';" class="add-product">
                        <i class="fas fa-plus"></i>
                        <label class="text-add-product">เพิ่มสินค้า</label> 
                    </button> 
                    <?php
                    if (!empty($_SESSION['member_id'])) {
                        $id_market = $_SESSION['member_id'];
                        $res_file_market = $conn->query("SELECT * From market_info Where mrk_id = '$id_market'");
                            while($row = $res_file_market->fetch_array()){
                                      $id_market = $row['mrk_id']; 
                                      $mrk_name = $row["mrk_name"]; 
                            }
                            $res_maket_Product = $conn->query("SELECT * FROM product WHERE id_market  = '$id_market'");
                    
                    } 
                    ?>
                    <?php while($row = $res_maket_Product->fetch_assoc()):?>
                    <div class="item-show">
                        <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"><img src='upload/<?= $row["img1"]?>' alt="product1" class="img-product-onehands"></a> 
                        <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameproduct"><?= $row["prd_name"]?></a>
                        <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NameSell">ลงขายโดย : <?= $mrk_name?></a>
                        <div class="gried-edit-pice">
                        <a href="Edit-product-pase2.php?Eait=<?php echo $row["prd_id"];?>" class="button-edit-product">
                            <i href="Edit-product-pase2.php?Eait=<?php echo $row["prd_id"];?>" class="fas fa-edit"></i>
                            <label href="Edit-product-pase2.php?Eait=<?php echo $row["prd_id"];?>" class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                        </a>
                        <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="PiceProduct-show"><?= $row["prd_price"]?> บาท</a> 
                        </div>   
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

    </div>
    <div class="Footter">
    </div>
</body>                 
</html>