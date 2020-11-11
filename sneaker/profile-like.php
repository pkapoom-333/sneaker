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
                  <div class="gried-content-profile-bar">
                                
                        
                    </div>
                 
            </div>
            <div class="line-bar-profile"></div> 
            <div class="profile-product">
                <div class="gried-profile-product">
                    <?php
                    
                    if (!empty($_SESSION['member_id'])) {
                        $id_like = $_SESSION['member_id'];
                        $res_maket = $conn->query("SELECT * From fav Where member_id  = '$id_like'");
                    } 
                    ?>
                    <?php while($row = $res_maket->fetch_assoc()):?>
                    <?php  
                        $prd_Show = $row["prd_id"];
                        $res_product_Show_Market = $conn->query("SELECT * FROM product where prd_id = '$prd_Show'");
                        while($rowMarket = $res_product_Show_Market->fetch_assoc()){
                               $prd_id = $rowMarket["prd_id"]; 
                               $img1 = $rowMarket["img1"]; 
                               $prd_name = $rowMarket["prd_name"];
                               $prd_Name_Maket = $rowMarket["prd_Name_Maket"];
                               $prd_price = $rowMarket["prd_price"];  
                        }
                    ?> 
                    <div class="item-show">
                        <a href="pase-product-test.php?show=<?php echo $prd_id;?>"><img src='upload/<?= $img1?>' alt="product1" class="img-product-onehands"></a> 
                        <a href="pase-product-test.php?show=<?php echo $prd_id;?>" class="Nameproduct"><?= $prd_name?></a>
                        <a href="pase-product-test.php?show=<?php echo $prd_id;?>" class="NameSell">ลงขายโดย : <?= $prd_Name_Maket?></a>
                        <div class="gried-edit-pice">
                        <a href="Edit-product-pase2.php?Eait=<?php echo $prd_id;?>" class="button-edit-product">
                            <i href="Edit-product-pase2.php?Eait=<?php echo $prd_id;?>" class="fas fa-edit"></i>
                            <label href="Edit-product-pase2.php?Eait=<?php echo $prd_id;?>" class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                        </a>
                        <a href="pase-product-test.php?show=<?php echo $prd_id;?>" class="PiceProduct-show"><?= $prd_price?> บาท</a> 
                        </div>   
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>

    </div>                   
</body>
    <div class="Footter">
    </div>
</html>