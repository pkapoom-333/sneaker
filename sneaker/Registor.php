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
                  <?php if (isset($_SESSION['member_email'])) : ?>
                  <a href="add-product-pase1.php">ลงขาย</a>
                  <?php endif ?>  
                  <a href="Registor.php">สมัครสมาชิก</a>
                  <a href="login.php">เข้าสู่ระบบ</a>
                </div>
                </div>
            </div>
    </div> 
    <div class="lineNav"></div>
    <div class="Register">
        <div class="container-regiter">
            <div class="box-regiter">
                <a class="text-regiter">Registor</a>
            <form action="PHP-Regstor.php" method="POST">
                <?php if (isset($_SESSION['error'])) : ?>
                    <div class="error">
                            <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                            ?>  
                    </div>
                <?php endif ?>
                <div class="textbox-mail">
                    <input class="textbox-mail-regiter" name="member_email" type="email" required placeholder="ที่อยู่เมล"> 
                </div>
                <div class="textbox-password">
                    <input class="textbox-password-regiter" name="member_pwd" type="password" required placeholder="รหัสผ่าน">
                </div>
                <div class="textbox-Name">
                    <input class="textbox-Name-regiter" name="member_name" type="text"  required placeholder="ชื่อ">
                </div>
                <div class="textbox-surname">
                    <input class="textbox-surname-regiter" name="member_lstname" type="text"  required placeholder="นามสกุล">
                </div>  
                <div class="textbox-numphone">
                    <input class="textbox-numphone-regiter" name="member_phone" type="text"  required placeholder="เบอร์โทรศัพ">   
                </div> 
                <div class="Male-female">
                    <input type="radio" name="member_gender" value= "m" required class="radio-buttun-male">
                    <label class="text-male">ผู้ชาย</label>
                    <input type="radio" name="member_gender" value= "f" required class="radio-buttun-female">
                    <label class="text-male">ผู้หญิง</label>
                </div> 
                <div class="Application-conditions">
                    <input type="radio" name="Applicationconditions" class="radio-Application-conditions">
                    <label class="text-male">คุณยอมรับ นโยบายความเป็นส่วนตัว และ ข้อกำหนดการใช้ ของ Snakey Crawling</label>
                </div> 
                <input type="submit" class="accept-regiter" name="submit" value="Submit">
            </form>
            </div>
        </div>
    </div>
            
    

</body>
</html>
 