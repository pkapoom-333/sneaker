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
    <link rel="stylesheet" href="./css/style-project.css"/>
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
    <div class="container">
        <div class="Gride-tool">
                
                <div class="Search-Map">
                <form action="NewBands.php" method="POST">
            <div class="Search-tetle">ค้นหาตำแหน่งร้านขายร้องเท้า</div>
                <button class="Search-position-button-map"><i class="fas fa-map-marked-alt"></i></button>
                <div class="dropdown-button">Advance Search</div>
                <div class="Search-map-tool">
                    <div class="drowdown-position-map">
                        <select>
                            <option value="">จังหวัด,เขต</option>
                            <option value="กรุงเทพ"   name="position_post">กรุงเทพ</option>
                            <option value="ฉะเชิงเทรา" name="position_post">ฉะเชิงเทรา</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>    
               </div>
               <div class="gride-pice">
               <div class="Search-Rating-map-tool">
                    <div class="drowdown-Rating-map">
                        <select>
                            <option value="ดีมาก">ดีมาก</option>
                            <option value="ดี">ดี</option>
                            <option value="ปานกลาง">ปานกลาง</option>
                            <option value="แย่">แย่</option>
                            <option value="แย่มาก">แย่มาก</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>
                </div>
                <div class="Search-distance-map-tool">
                    <div class="drowdown-distance-map">
                        <select>
                            <option value="">ระยะทาง</option>
                            <option value="">ใกล้สุด</option>
                            <option value="">ไกลสุด</option>
                            <option value="">5KM</option>
                            <option value="">10KM</option>
                            <option value="">20KM</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>
                </div> 
                </div>  
                <div class="Search-Map-tetle">ตัวช่วยการค้นหา</div>
                
                <div class="Search-type-Tool">
                    <div class="drowdown-Search-Tool">
                        <select name="status_post_one" onchange="this.form.submit();">
                        <option>สภาพสินค้า</option>
                        <option value="มื่อหนึ่ง">มื่อหนึ่ง</option>
                        <option value="มือสอง">มือสอง</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>
                </div>
                <div class="Search-type-Tool">
                    <div class="drowdown-Search-Tool">
                        <select name="band_post" onchange="this.form.submit();">
                        <option>แบรนด์</option>
                        <option value="Nike">Nike</option>
                        <option value="Adidas">Adidas</option>
                        <option value="Vans">Vans</option>
                        <option value="Converse">Converse</option>
                        <option value="Fila">Fila</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>
                </div>
                <div class="Search-type-Tool">
                    <div class="drowdown-Search-Tool">
                        <select name="type_post" onchange="this.form.submit();">
                        <option>ประเภทสินค้า</option>
                        <option value="รองเท้าทั่วไป">รองเท้าทั่วไป</option>
                        <option value="รองเท้าฟุตบอล">รองเท้าฟุตบอล</option>
                        <option value="รองเท้าบาสเกตบอล">รองเท้าบาสเกตบอล</option>
                        <option value="รองเท้าเทรานิ่ง">รองเท้าเทรานิ่ง</option>
                        <option value="ประเภทอื่น">ประเภทอื่น</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>
                </div>
                <div class="Search-sex-Tool">
                    <div class="drowdown-Search-Tool">
                        <select name="sex_post" onchange="this.form.submit();">
                        <option>เพศ</option>
                        <option value="ผู้ชาย">ผู้ชาย</option>
                        <option value="ผู้หญิง">ผู้หญิง</option>
                        <option value="เด็ก">เด็ก</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>
                </div>
                    <div class="Search-Arrange-Tool">
                        <div class="drowdown-Search-Tool">
                            <select name="Max_od_Min"onchange="this.form.submit();">
                                <option>จัดเรียง</option>
                                <option value="2">ถูกสุดไปแพงสุด</option>
                                <option value="1">แพงสุดไปถูกสุด</option>
                            </select>
                            <i class="fas fa-chevron-down"></i> 
                        </div>
                     </div>    
                <div class="Search-pice-tool">ราคา</div>
                    <div class="gride-pice">
                    
                    <div class="dropdown-ฺMinPice-Tool">
                    <input class="textMinPice-map" type="text" name="Min_post" placeholder="ราคาต่ำสุด"> 
                        
                    </div>
                    <div class="dropdown-ฺMaxPice-Tool">
                        <input class="searMaxPice-map" type="text" name="Max_post"  onchange="this.form.submit();" placeholder="ราคาสูงสุด">
                    </div>
                    </div>
                
                        
            </div> 
                </form> 
                    <script>
                    function onSelectChange(){
                    document.getElementById('frm').submit();
                    }
                    </script>
        <div class="item-Newbands-gride">
            <?php
                if(isset($_POST['search'])){
                    $Namesearch=$_POST['Namesearch'];
                    $sql = "SELECT * From product Where prd_name LIKE '%$Namesearch' or prd_brand LIKE'%$Namesearch' or prd_type LIKE '%$Namesearch' or prd_status LIKE '%$Namesearch'";
                    $query = mysqli_query($conn, $sql);
                     if($query->num_rows>0){            
                        while($row = $query->fetch_assoc()){ 
                            $id_market = $row["id_market"];
                            $res_product_Show_Market = $conn->query("SELECT * FROM market_info where mrk_id = '$id_market'");
                            while($rowMarket = $res_product_Show_Market->fetch_assoc()){
                                   $mrk_name = $rowMarket["mrk_name"]; 
                             }
                            $output .= '
                            <div href="pase-product.php" class="item-show" >
                            <a href="pase-product-test.php?show='. $row['prd_id'] .'"><img src="upload/'. $row['img1'] .'" alt="product1" class="img-product-onehands"></a> 
                            <a href="pase-product-test.php?show='. $row['prd_id'] .'" class="Nameproduct">'. $row['prd_name'] .'</a>
                            <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="NameSell">ลงขายโดย : '.$mrk_name.'</a>
                            <a href="pase-product-test.php?show='. $row['prd_id'] .'>" class="PiceProduct-show">'. $row['prd_price'] .'บาท</a> 
                            </div> ';
                        }
                     }else{
                        $output = "Not Found";
                     }
                     echo $output;
                } 
             
            ?>          
            
        
        
        
        
        
        </div>
     </div>
    </div>
                
    </div> 
  
</body>
<div class="Footter">
   </div>
</html>