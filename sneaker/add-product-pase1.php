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

    <style>
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}
    </style>
    
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
    <div class="register-maket">
        <div class="container">
            <form action="PHP-addproduct1.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()" required>
              <div class="Greid-register-market">
             
                <div class="Gride-right-register-market">
                    <label class="tele-register-market">รายละเอียดข้อมูลผู้ขาย</label>
                    <label class="tele-add-img-market">อัพโหลดโปรไพล์</label>
                        <button class="add-img-market" type="file" name="mrk_pic">
                        <i class="fas fa-image"></i>
                        <a class="tele-add-img">ใส่ได้ 1 รูป</a>
                        </button> 
                        <input type="file" name="mrk_pic" required>         
                    <label class="tele-add-contact-market">ช่องทางติดต่อ(อย่างน้อยหนึ่งช่องทาง)</label>
                    <div class="add-contact-market">
                        <input class="add-contact-market-facebook" type="text" name="mrk_fb" placeholder="Facebook" required maxlength="25">
                        <input class="add-contact-market-ig" type="text"  name="mrk_ig" placeholder="Instagram" required maxlength="25">
                        <input class="add-contact-market-LineID" type="text"  name="mrk_line" placeholder="LineID" required maxlength="25">
                    </div>  
                    <label class="tele-add-timeOpen-market">เวลาเปิดทำการหรือเวลาที่สามารถติดต่อ</label>
                    <div class="add-timeOpen-market">
                        
                        <input type="time" id="appt" name="mrk_open" class="drowdown-timeOpen" required> 
                        
                        <input type="time" id="appt" name="mrk_close" class="drowdown-timeClose" required>
                    </div>    
                    <div class="Application-conditions-market">
                        <input type="radio" name="radioApplicationconditions" class="radio-Application-conditions" required>
                        <label class="text-male">คุณยอมรับ นโยบายความเป็นส่วนตัว และ ข้อกำหนดการใช้ ของ Snakey Crawling</label>
                    </div>
                    <button class="accept-regiter-merket" name="addproduct1" value="addproduct1">ตกลง</button>
                    <button class="cancle-regiter-merket">ยกเลิก</button>
                </div>
                <div class="Gride-left-register-market">
                    <label class="tele-add-Name-market" >ชื่อร้านค้าหรือชื่อผู้ขาย</label>
                    <input class="textbox-add-name-market" type="text" name="mrk_name" required minlength="5" maxlength="30">
                    <label class="tele-add-IDcade-market">รหัสบัตรประชาชน</label>
                    <input class="textbox-add-IDcade-market" type="number" name="mrk_personal_id" required  pattern="\d*" step="0.01" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "13" />
                    <label class="tele-add-contact-phone-market">เบอร์ติดต่อ</label>
                    <input class="textbox-add-contact-phone-market" type="number" name="mrk_phone" required pattern="\d*" step="0.01" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength = "10" />
                    <label class="tele-add-addaress-market">ตำแหน่งร้านหรือจุดรับสินค้า</label>
                    <div class="add-addaress-market" >
                        <div class="gried-addaress-maket">
                            <input class="textbox-add-addaress-market" type="text" name="mrk_address" placeholder="ที่อยู่" required maxlength="30">
                            <input class="textbox-add-canton-market" type="text" name="mrk_sub_district" placeholder="ตำบล/แขวง" required maxlength="30">
                            <input class="textbox-add-district-market" type="text" name="mrk_district" placeholder="อำเภอ/เขต" required  maxlength="30">
                            <input class="drowdown-add-city" name="mrk_city" id="mrk_city" placeholder="จังหวัด" required maxlength="30">
                            <input class="textbox-add-Postal-code-market" type="text" name="mrk_zipcode" placeholder="รหัสไปรษณีย์" required  maxlength="30">
                        </div>

                    </div>
                    <label class="tele-add-Latitude-longitude-market">ตำแหน่งละติจูดและลองจิจูด</label>
                    <div class="gried-Latitude-longitude-maket">
                    <input class="textbox-add-Latitude-market" type="text" name="mrk_lat_location" required minleght="10" maxlength="25"> 
                    <input class="textbox-add-longitude-market" type="text" name="mrk_lgt_location" required minleght="10" maxlength="25"> 
                            <div class="Latitude-longitude-market">
                            <i class="fas fa-exclamation-circle"></i>  
                            <label class="tele-Latitude-longitude-market">วิธีการหาตำแหน่งละติจูดและลองจิจูด</label>
                            </div>
                    </div>
                </div>
                
            </div>
            </form>
        </div>
    </div>


</body>
</html>