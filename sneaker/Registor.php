<?php
    session_start();

    require_once "connection.php" ;
    
    if(isset($_POST['submit'])){
        $email = $_POST['member_username'];
        $password = $_POST['member_pwd'];
        $userfristname = $_POST['member_name'];
        $userlastname  = $_POST['member_lstname'];
        $numberphone = $_POST['member_phone']; 
        $male = $_POST['member_gender'];
        $female = $_POST['member_gender'];   
        
        $user_check = "SELECT * FROM member WHERE member_username = '$member_username' LIMIT 1";
        $result = mysqli_query($mysql_connect,$user_check);
        $member = mysqli_fetch_assoc($result);

        if ($member['member_username'] == $email) {
            echo "<script>alert('Username already exists');</script>";
        } else {
            $passwordenc = md5($password);

            $query = "INSERT INTO member (userfristname, password, userfristname, userlastname , numberphone) 
            VALUE ('$member_username','$member_pwd','$member_name','$member_lstname','$member_phone')";
            $result = mysqli_query($connection,$query);

            
    
    
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
    <link rel="stylesheet" href="./css/style.css"/>
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
                        <a href="profile.html">แก้ไขข้อมูลส่วนตัว</a>
                        <a href="profile.html">แก้ไขข้อมูลร้านค้า</a>
                        <a href="profile.html">รายการโปรด</a> 
                        <a href="#">ออกจากระบบ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="Nav">
        <div class="container">
            <div class="nav-grid">
                <div class="navMenu">
                    <a href="Home.html">หน้าแรก</a>
                    <a href="NewBands.html">สินค้าใหม่</a>
                    <a href="#">แบรนด์</a>
                 </div>
                
                 <div class="Rnav">
                  <a href="#">ลงขาย</a>
                  <a href="Registor.html">สมัครสมาชิก</a>
                  <a href="login.html">เข้าสู่ระบบ</a>
                </div>
                </div>
            </div>
    </div> 
    <div class="lineNav"></div>
    <div class="Register">
        <div class="container-regiter">
            <div class="box-regiter">
                <a class="text-regiter">Registor</a>
            <form action="<?php echo $_SERVER['member']; ?>" method="post">
                <div class="textbox-mail">
                    <input class="textbox-mail-regiter" name="email" type="text"  placeholder="ที่อยู่เมล"> 
                </div>
                <div class="textbox-password">
                    <input class="textbox-password-regiter" name="password" type="password"  placeholder="รหัสผ่าน">
                </div>
                <div class="textbox-Name">
                    <input class="textbox-Name-regiter" name="userfristname" type="text"  placeholder="ชื่อ">
                </div>
                <div class="textbox-surname">
                    <input class="textbox-surname-regiter" name="userlastname" type="text"  placeholder="นามสกุล">
                </div>  
                <div class="textbox-numphone">
                    <input class="textbox-numphone-regiter" name="numberphone" type="text"  placeholder="เบอร์โทรศัพ">   
                </div> 
                <div class="Male-female">
                    <input type="radio" name="male" class="radio-buttun-male">
                    <label class="text-male">ผู้ชาย</label>
                    <input type="radio" name="female" class="radio-buttun-female">
                    <label class="text-male">ผู้หญิง</label>
                </div> 
                <div class="Application-conditions">
                    <input type="radio" name="radioApplicationconditions" class="radio-Application-conditions">
                    <label class="text-male">คุณยอมรับ นโยบายความเป็นส่วนตัว และ ข้อกำหนดการใช้ ของ Snakey Crawling</label>
                </div> 
                <button href="profile.html"  class="accept-regiter" type="submit "name="submit" >เข้าร่วมกับเรา</button>
            </form>
            </div>
        </div>
    </div>
            
    

</body>
</html>
 