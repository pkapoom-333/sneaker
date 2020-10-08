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
    
    
    <div class="pase-profile">
        <div class="container">
            <div class="bar-profile">
                <button class="button-profile-product">
                  สินค้าที่ลงขาย
                </button>
                <button class="button-profile-like-product">
                    รายการโปรด
                  </button>
                  <div class="gried-content-profile-bar">
                        <div class="left-bar-profile">
                            <div class="profile-sell-img">
                            <a href="#"><img src="./product/2.png" alt="Seller-img" class="Seller-img"></a>
                            </div>
                            <div class="profile-sell-text">
                            <a href="#" class="Date-Seller">ร้าน Snakey</a>
                            <a href="#" class="Date-Seller">เป็นสมาชิกมาแล้ว 1 ปี 4 เดือน 8 วัน</a>
                            <a href="#" class="Date-Seller">เรตติ้ง : ดีมาก</a>
                            <a href="#" class="Date-Seller">เปิดทำการ: 10.00 น. - 21.00 น. </a>
                            <a href="#" class="Date-Seller">เบอร์โทรติดต่อ: 024794547</a>
                            </div>
                        </div>
                        <div class="right-bar-profile">
                           <div class="gried-bar-ratting">
                            <a class="bar-content-ratting">เรตติ้ง : ดีมาก</a>
                            <div class="bar-content-icon-ratting">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                           </div>  
                         <div class="gried-bar-contect"> 
                           <div class="bar-facebook-profile">
                                <i class="fab fa-facebook"></i>
                                <a class="tele-facebook-product">Snakey</a>     
                            </div>
                            <div class="bar-ig-profile">
                                <i class="fab fa-instagram-square"></i>
                                <a class="tele-ig-product">Snakey_ig</a>
                            </div>
                            <div class="bar-line-peofile">
                                <i class="fab fa-line"></i>
                                <a class="tele-line-product">@line_Snakey</a>
                            </div>
                        </div>
                    </div>
                 
            </div>
            <div class="line-bar-profile"></div> 
            <div class="profile-product">
                <div class="gried-profile-product">
                    <button class="add-product">
                        <i class="fas fa-plus"></i>
                        <label class="text-add-product">เพิ่มสินค้า</label> 
                    </button> 
                    <div class="item-show">
                    <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                    <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                    <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                    <div class="gried-edit-pice">
                        <button class="button-edit-product">
                            <i class="fas fa-edit"></i>
                            <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                        </button>
                        <a href="#" class="PiceProduct-show">4500B</a> 
                    </div>
                    </div>
                    <div class="item-show">
                    <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                    <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                    <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                    <div class="gried-edit-pice">
                        <button class="button-edit-product">
                            <i class="fas fa-edit"></i>
                            <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                        </button>
                        <a href="#" class="PiceProduct-show">4500B</a> 
                    </div>   
                    </div>
                    <div class="item-show">
                    <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                    <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                    <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                    <div class="gried-edit-pice">
                        <button class="button-edit-product">
                            <i class="fas fa-edit"></i>
                            <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                        </button>
                        <a href="#" class="PiceProduct-show">4500B</a> 
                    </div> 
                    </div> 
                    <div class="item-show">
                    <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                    <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                    <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                    <div class="gried-edit-pice">
                        <button class="button-edit-product">
                            <i class="fas fa-edit"></i>
                            <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                        </button>
                        <a href="#" class="PiceProduct-show">4500B</a> 
                    </div>
                    </div>
                        <div class="item-show">
                        <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                        <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                        <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                        <div class="gried-edit-pice">
                            <button class="button-edit-product">
                                <i class="fas fa-edit"></i>
                                <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                            </button>
                            <a href="#" class="PiceProduct-show">4500B</a> 
                        </div>  
                        </div>
                        <div class="item-show">
                        <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                        <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                        <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                        <div class="gried-edit-pice">
                            <button class="button-edit-product">
                                <i class="fas fa-edit"></i>
                                <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                            </button>
                            <a href="#" class="PiceProduct-show">4500B</a> 
                        </div> 
                        </div> 
                    <div class="item-show">
                        <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                        <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                        <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                        <div class="gried-edit-pice">
                            <button class="button-edit-product">
                                <i class="fas fa-edit"></i>
                                <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                            </button>
                            <a href="#" class="PiceProduct-show">4500B</a> 
                        </div>  
                    </div>
                    <div class="item-show">
                        <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                        <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                        <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                        <div class="gried-edit-pice">
                            <button class="button-edit-product">
                                <i class="fas fa-edit"></i>
                                <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                            </button>
                            <a href="#" class="PiceProduct-show">4500B</a> 
                        </div> 
                    </div>
                    <div class="item-show">
                        <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                        <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                        <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                        <div class="gried-edit-pice">
                            <button class="button-edit-product">
                                <i class="fas fa-edit"></i>
                                <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                            </button>
                            <a href="#" class="PiceProduct-show">4500B</a> 
                        </div>  
                    </div> 
                    <div class="item-show">
                        <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                        <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                        <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                        <div class="gried-edit-pice">
                            <button class="button-edit-product">
                                <i class="fas fa-edit"></i>
                                <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                            </button>
                            <a href="#" class="PiceProduct-show">4500B</a> 
                        </div> 
                    </div>
                    <div class="item-show">
                        <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                        <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                        <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                        <div class="gried-edit-pice">
                            <button class="button-edit-product">
                                <i class="fas fa-edit"></i>
                                <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                            </button>
                            <a href="#" class="PiceProduct-show">4500B</a> 
                        </div> 
                    </div>
                    <div class="item-show">
                        <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                        <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                        <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                        <div class="gried-edit-pice">
                            <button class="button-edit-product">
                                <i class="fas fa-edit"></i>
                                <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                            </button>
                            <a href="#" class="PiceProduct-show">4500B</a> 
                        </div>  
                    </div> 
                    <div class="item-show">
                    <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                    <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                    <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                    <div class="gried-edit-pice">
                        <button class="button-edit-product">
                            <i class="fas fa-edit"></i>
                            <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                        </button>
                        <a href="#" class="PiceProduct-show">4500B</a> 
                    </div>
                    </div>
                    <div class="item-show">
                    <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                    <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                    <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                    <div class="gried-edit-pice">
                        <button class="button-edit-product">
                            <i class="fas fa-edit"></i>
                            <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                        </button>
                        <a href="#" class="PiceProduct-show">4500B</a> 
                    </div>
                    </div>  
                    <div class="item-show">
                        <a href="#"><img src="./product/1.png" alt="product1" class="img-product-onehands"></a> 
                        <a href="#" class="Nameproduct">Nike Air Max 270 React ENG</a>
                        <a href="#" class="NameSell">ลงขายโดย : ร้าน Snakey</a>
                        <div class="gried-edit-pice">
                            <button class="button-edit-product">
                                <i class="fas fa-edit"></i>
                                <label class="text-edit-product">แก้ไขรายละเอียดสินค้า</label>
                            </button>
                            <a href="#" class="PiceProduct-show">4500B</a> 
                        </div> 
                    </div> 
                </div>
            </div>
        </div>

    </div>

</body>
</html>