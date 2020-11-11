<?php
session_start();
include('connection.php');
  if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['member_email']);
    unset($_SESSION['member_id']);
    unset($_SESSION['Show_market']);
    unset($_SESSION['add_market']);
    unset($_SESSION['Show_name']);
    unset($_SESSION['Edit']);
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
    <link rel="stylesheet" href="./css/style-project3.css"/>
    <link rel="stylesheet" href="./css/swiper.min.css"/>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
    <script>
          function initMap() {
                     <?PHP $LOCATION_SHOW = $conn->query("SELECT * From market_info");   ?>
                      var locations = [
                      <?php
                          while($row = $LOCATION_SHOW->fetch_assoc()){ 
                              echo '["'.$row['mrk_name'].'", '.$row['mrk_lat_location'].', '.$row['mrk_lgt_location'].'],'; 
                          } 
                      ?>   
                  ];
                  var map = new google.maps.Map(document.getElementById('Map-Search'), {
                    zoom: 8,
                    center: new google.maps.LatLng(13.7563, 100.5018),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                  });
                  var infowindow = new google.maps.InfoWindow();
                  var marker, i;
                  for (i = 0; i < locations.length; i++) {  
                    marker = new google.maps.Marker({
                      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                      map: map
                    });
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                      return function() {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                      }
                    })(marker, i));
                  }
              }
    </script>
    <!--map-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
   
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVBElTQx-QpLo8sXdciQFcS5Pbmzw0H7Q&callback=initMap"></script>

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
                <form action="Search-product.php" method="POST">
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
                    <a href="New-product.php?page=1">สินค้าใหม่</a>
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
                </div>
                </div>
            </div>
    </div>    
    <div class="lineNav"></div>
    <div class="Search-tetle-Map">ค้นหาร้าน</div>
    <section class="MapSearch"> 
        <div class="container">
             <div class="AdvanceSearch">
                <div class="Search-item-map">
                     <input class="text-item-map" type="text"  placeholder="ค้นหารองเท้า"> 
                     <button class="bntSearch-map"><i class="fas fa-search"></i></button>
                </div>
                <div class="Search-position-map">
                    <div class="drowdown-position-map">
                        <select>
                            <option>จังหวัด,เขต</option>
                            <option value="">กรุงเทพ</option>
                            <option value="">ฉะเชิงเทรา</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>    
               </div>
                <div class="Search-Arrange-map">
                    <div class="drowdown-Arrange-map">
                        <select>
                            <option value="">จัดเรียง</option>
                            <option value="">ถูกสุดไปแพงสุด</option>
                            <option value="">แพงสุดไปถูกสุด</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>
                 </div>
            </div>     
            
          <div class="ToolSearch">
            <div class="container">
               <div class="Gride-ToolSearch">    
                        <div class="Gride-tool-Gride">
                            <div class="Tool-dropdown-Condition">
                                <div class="drowdown-Condition-map" onclick="showcheckboxCondition()">
                                    <select>
                                    <option value="">สภาพสินค้า</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                    <div class="overSelect"></div>
                                </div>
                                <div id="checkboxCondition">
                                <?php
                                        $sql = "SELECT DISTINCT prd_status FROM product ORDER BY prd_status";
                                        $result= $conn->query($sql);
                                        while($row = $result->fetch_assoc()){ 
                                    ?>
                                    <label><input type="checkbox" class="input common_selector" value="<?=$row['prd_status'];?>" id="brand">    <?= $row["prd_status"]?></label>
                                    <?php } ?> 
                                </div>
                              </div>
                            <script>
                                var expanded = fales;
                                function showcheckboxCondition(){
                                    var reviewcountpoint = document.getElementById("checkboxCondition");
                                    if(!expanded){
                                        reviewcountpoint.style.display = "block";
                                        expanded = true; 
                                    }else{
                                        reviewcountpoint.style.display = "none";
                                        expanded = false; 
                                    }
                                }
                            
                            </script> 
                            <div class="dropdown-ฺband">
                                <div class="drowdown-ฺband-map" onclick="showcheckboxband()">
                                    <select> 
                                    <option value="">แบรนด์</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i> 
                                    <div class="overSelect"></div>
                                </div>
                                <div id="checkboxฺband">
                                <?php
                                        $sql = "SELECT DISTINCT prd_brand FROM product ORDER BY prd_brand";
                                        $result= $conn->query($sql);
                                        while($row = $result->fetch_assoc()){ 
                                  ?>
                                    <label><input type="checkbox" class="input common_selector" value="<?=$row['prd_brand'];?>" id="brand">    <?= $row["prd_brand"]?></label>
                                    <?php } ?> 
                                </div>
                            </div>
                            <script>
                                var expanded = fales;
                                function showcheckboxband(){
                                    var reviewcountpoint = document.getElementById("checkboxฺband");
                                    if(!expanded){
                                        reviewcountpoint.style.display = "block";
                                        expanded = true; 
                                    }else{
                                        reviewcountpoint.style.display = "none";
                                        expanded = false; 
                                    }
                                }
                            
                            </script> 
                            <div class="dropdown-ฺType">
                                <div class="drowdown-ฺฺType-map" onclick="showcheckboxprdtype()">
                                    <select>
                                    <option value="">ประเภทสินค้า</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                    <div class="overSelect"></div> 
                                </div>
                                <div id="checkboxฺprdtype">
                                <?php
                                        $sql = "SELECT DISTINCT prd_type FROM product ORDER BY prd_type";
                                        $result= $conn->query($sql);
                                        while($row = $result->fetch_assoc()){ 
                                  ?>
                                    <label><input type="checkbox" class="input common_selector" value="<?=$row['prd_type'];?>" id="brand">    <?= $row["prd_type"]?></label>
                                    <?php } ?> 
                                </div>
                            </div>
                            <script>
                                var expanded = fales;
                                function showcheckboxprdtype(){
                                    var reviewcountpoint = document.getElementById("checkboxฺprdtype");
                                    if(!expanded){
                                        reviewcountpoint.style.display = "block";
                                        expanded = true; 
                                    }else{
                                        reviewcountpoint.style.display = "none";
                                        expanded = false; 
                                    }
                                }
                            
                            </script>
                            <div class="dropdown-ฺGender" >
                                <div class="drowdown-ฺฺฺGender-map" onclick="showcheckboxprdฺGender()">
                                    <select>
                                    <option value="">เพศ</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i> 
                                    <div class="overSelect"></div>
                                </div>
                                <div id="checkboxฺprdฺฺฺGender">
                                <?php
                                        $sql = "SELECT DISTINCT prd_type FROM product ORDER BY prd_type";
                                        $result= $conn->query($sql);
                                        while($row = $result->fetch_assoc()){ 
                                  ?>
                                    <label><input type="checkbox" class="input common_selector" value="<?=$row['prd_type'];?>" id="brand">    <?= $row["prd_type"]?></label>
                                    <?php } ?> 
                                </div>
                            </div>
                            <div class="dropdown-ฺMinPice">
                                  <input type="hidden" id="hidden_minimum_price" value="0" />
                                  <input type="hidden" id="hidden_maximum_price" value="65000" />
                                  <p id="price_show">1000 - 50000</p>
                                  <div id="price_range" style="width:200px; hight:50px;  margin-top: -10px;margin-left:20px;"></div>
                            </div>
                            <script>
                                var expanded = fales;
                                function showcheckboxprdฺGender(){
                                    var reviewcountpoint = document.getElementById("checkboxฺprdฺฺฺGender");
                                    if(!expanded){
                                        reviewcountpoint.style.display = "block";
                                        expanded = true; 
                                    }else{
                                        reviewcountpoint.style.display = "none";
                                        expanded = false; 
                                    }
                                }
                            
                            </script>
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
                            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
                            <script type="text/javascript">

                                $(document).ready(function(){
                                    $("#price_range").slider({
                                    range:true,
                                    min:1000,
                                    max:50000,
                                    values:[1000, 50000],
                                    step:500,
                                    stop:function(event, ui)
                                    {
                                        $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                                        $('#hidden_minimum_price').val(ui.values[0]);
                                        $('#hidden_maximum_price').val(ui.values[1]);
                                        filter_data();
                                    }
                                    });
                                    
                            });      
                            </script> 
                        </div>
                        <div class="tool-map-search">
                            <div id="Map-Search"></div>
                        </div>
                        <div class="item">
                            <div class="iteam-Gride">
                            <?php
                              $res_product_Show = $conn->query("SELECT * FROM product LIMIT 15");
                            ?>
                            <?php while($row = $res_product_Show->fetch_assoc()):?>
                                    <?php  
                                      $id_market = $row["id_market"];
                                      $res_product_Show_Market = $conn->query("SELECT * FROM market_info where mrk_id = '$id_market'");
                                      while($rowMarket = $res_product_Show_Market->fetch_assoc()){
                                        $mrk_name = $rowMarket["mrk_name"]; 
                                        $mrk_open = $rowMarket["mrk_open"]; 
                                        $mrk_close = $rowMarket["mrk_close"];
                                        $mrk_phone = $rowMarket["mrk_phone"];
                                        $mrk_close = $rowMarket["mrk_close"];  
                                        $mrk_lat_location = $rowMarket["mrk_lat_location"];
                                        $mrk_lgt_location = $rowMarket["mrk_lgt_location"];
                                      }
                                    ?>    
                               <div class="iteam-img">
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"> <img src='upload/<?= $row["img1"]?>' alt="product1" class="img-product-map"></a> 
                                </div>
                                <div class="text-iteamt">
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameproduct"><?= $row["prd_name"]?></a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NameSell">ลงขายโดย:<?= $mrk_name?></a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameposition"></a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="TimeOpen">เปิดทำการ: <?= $mrk_open?>น. - <?= $mrk_close?>น. </a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NumberPhone">เบอร์โทรติดต่อ:<?= $mrk_phone?></a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="RetingSeller">เรตติ้ง : ดีมาก</a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Condition">สภาพสินค้า : <?= $row["prd_status"]?></a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="PiceProduct"><?= $row["prd_price"]?> บาท</a>
                                    <button onclick="location.href='https://www.google.co.th/maps/dir/<?php echo $MapUser;?>/<?php echo $mrk_lat_location;?>,<?php echo $mrk_lgt_location;?>/';" target="_blank" class="Position-Seller">เส้นทางสินค้า</button>
                                    <button href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"class="Descritin-Product">รายละเอียก</button>
                                    <div class="lineNav"></div>
                                </div> 
                            <?php endwhile; ?>  
                               
                                
                              
                           
                        </div>
                      </div>
                </div>
            </div>  
          </div>
        </div>
        
     </div>
                
            
    </section>
    <div class="Search-tetle-Map">สินค้ามือหนึ่ง</div>
    <section class="productonehands">
        <div class="container">
        <div class="swiper-container">
                <div class="swiper-wrapper">
                <?php
                    $onehand = "มือหนึ่ง";
                    $res_product_Show = $conn->query("SELECT * FROM product ORDER BY prd_view DESC LIMIT 15");
                
                ?>
                <?php while($row = $res_product_Show->fetch_assoc()):?>
                <?php  
                    $id_market = $row["id_market"];
                    $res_product_Show_Market = $conn->query("SELECT * FROM market_info where mrk_id = '$id_market'");
                    while($rowMarket = $res_product_Show_Market->fetch_assoc()){
                            $mrk_nameOnehand = $rowMarket["mrk_name"]; 
          
                    }
                ?>    
                <div class="swiper-slide">
                  <div href="pase-product.php" class="slider-box">
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"><img src='upload/<?= $row["img1"]?>' alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameproduct"><?= $row["prd_name"]?></a>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NameSell">ลงขายโดย : <?= $mrk_nameOnehand?></a>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="PiceProduct-slider"><?= $row["prd_price"]?> บาท</a> 
                  </div> 
                </div>
                <?php endwhile; ?> 
             </div>
            <!--jquery-->
    <script src="./js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        // init: false,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        breakpoints: {
          '@0.00': {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          '@0.75': {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          '@1.00': {
            slidesPerView: 3,
            spaceBetween: 40,
          },
          '@1.50': {
            slidesPerView: 4,
            spaceBetween: 50,
          },
        }
      });
    </script>     
        </div>
    
    </section>
    <div class="Search-tetle-Map">สินค้ามือสอง</div>
    <section class="productonehands">
        <div class="container">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                <?php
                    $secondhand = "มือสอง";
                    $res_product_Show = $conn->query("SELECT * FROM product Where prd_status = '$secondhand' LIMIT 15 ");
                
                ?>
                <?php while($row = $res_product_Show->fetch_assoc()):?>
                  <?php  
                    $id_market = $row["id_market"];
                    $res_product_Show_Market = $conn->query("SELECT * FROM market_info where mrk_id = '$id_market'");
                    while($rowMarket = $res_product_Show_Market->fetch_assoc()){
                            $mrk_namesecondhand = $rowMarket["mrk_name"]; 
          
                    }
                ?> 
                <div class="swiper-slide">
                  <div href="pase-product.php" class="slider-box">
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"><img src='upload/<?= $row["img1"]?>' alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameproduct"><?= $row["prd_name"]?></a>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NameSell">ลงขายโดย : <?= $mrk_namesecondhand?></a>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="PiceProduct-slider"><?= $row["prd_price"]?> บาท</a> 
                  </div> 
                </div>
                <?php endwhile; ?> 
             </div>
            <!--jquery-->
    <script src="./js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        // init: false,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        breakpoints: {
          '@0.00': {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          '@0.75': {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          '@1.00': {
            slidesPerView: 3,
            spaceBetween: 40,
          },
          '@1.50': {
            slidesPerView: 4,
            spaceBetween: 50,
          },
        }
      });
    </script>     
        </div>
    
    </section>
    <div class="Search-tetle-Map">สินค้าคนดูสูงสุด</div>
    <section class="productonehands">
        <div class="container">
        <div class="swiper-container">
                <div class="swiper-wrapper">
                <?php
                    $res_product_Show = $conn->query("SELECT * FROM product
                    ORDER BY prd_view DESC
                    LIMIT 15 ");
                
                ?>
                <?php while($row = $res_product_Show->fetch_assoc()):?>
                  <?php  
                    $id_market = $row["id_market"];
                    $res_product_Show_Market = $conn->query("SELECT * FROM market_info where mrk_id = '$id_market'");
                    while($rowMarket = $res_product_Show_Market->fetch_assoc()){
                            $mrk_nameShow = $rowMarket["mrk_name"]; 
          
                    }
                ?> 
                <div class="swiper-slide">
                  <div href="pase-product.php" class="slider-box">
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"><img src='upload/<?= $row["img1"]?>' alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameproduct"><?= $row["prd_name"]?></a>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NameSell">ลงขายโดย : <?= $mrk_nameShow ?></a>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="PiceProduct-slider"><?= $row["prd_price"]?> บาท</a> 
                  </div> 
                </div>
                <?php endwhile; ?> 
             </div>
                
            <!--jquery-->
    <script src="./js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        // init: false,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        breakpoints: {
          '@0.00': {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          '@0.75': {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          '@1.00': {
            slidesPerView: 3,
            spaceBetween: 40,
          },
          '@1.50': {
            slidesPerView: 4,
            spaceBetween: 50,
          },
        }
      });
    </script>     
        </div>
    
    </section>
    <div class="Search-tetle-Map">แบรนด์สินค้า</div>
    <section class="productonehands">
        <div class="container">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    
                   <div class="swiper-slide">
                      <div class="slider-box">
                        <a href="Bands.php?Band=Nike"><img src="./product/nike-Recovered.png" alt="Bands" class="img-Bands"></a> 
                     </div> 
                    </div>
                  <div class="swiper-slide">
                     <div class="slider-box">
                      <a href="Bands.php?Band=Adidas"><img src="./product/adidas-resize.png" alt="Bands" class="img-Bands"></a> 
                   </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="slider-box">
                        <a href="Bands.php?Band=Converse"><img src="./product/converse-resize.png" alt="Bands" class="img-Bands"></a> 
                  </div>
                  </div>
                  <div class="swiper-slide">
                  <div class="slider-box">
                    <a href="Bands.php?Band=Vans"><img src="./product/vans-resize.png" alt="Bands" class="img-Bands"></a> 
                 </div> 
                  </div>
                  <div class="swiper-slide">
                 <div class="slider-box">
                  <a href="Bands.php?Band=Nike"><img src="./product/nike-Recovered.png" alt="Bands" class="img-Bands"></a> 
               </div> 
              </div>
                    <div class="swiper-slide">
                        <div class="slider-box" >
                        <a href="Bands.php?Band=Adidas"><img src="./product/adidas-resize.png" alt="Bands" class="img-Bands"></a> 
                      </div> 
                    </div>
            
                    <div class="swiper-slide">
                        <div class="slider-box">
                        <a href="Bands.php?Band=Converse"><img src="./product/converse-resize.png" alt="Bands" class="img-Bands"></a> 
                        </div> 
                    </div>
              </div>
          </div>
              
        </div>
    
            <!--jquery-->
    <script src="./js/swiper.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        // init: false,
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        breakpoints: {
          '@0.00': {
            slidesPerView: 1,
            spaceBetween: 10,
          },
          '@0.75': {
            slidesPerView: 2,
            spaceBetween: 20,
          },
          '@1.00': {
            slidesPerView: 3,
            spaceBetween: 40,
          },
          '@1.50': {
            slidesPerView: 4,
            spaceBetween: 50,
          },
        }
      });
    </script>  
</body>
    <div class="Footter">
   </div>
</html>