<?php
session_start();
include('connection.php');

  if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION['member_email']);
    unset($_SESSION['member_id']);
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
                            <option value="">จังหวัด,เขต</option>
                            <option value="">กรุงเทพ</option>
                            <option value="">ฉะเชิงเทรา</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>    
               </div>
               <div class="Search-Rating-map">
                    <div class="drowdown-Rating-map">
                        <select>
                            <option value="">ดีมาก</option>
                            <option value="">ดี</option>
                            <option value="">ปานกลาง</option>
                            <option value="">แย่</option>
                            <option value="">แย่มาก</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                    </div>
                </div>
                <div class="Search-distance-map">
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
                                <div class="drowdown-Condition-map">
                                    <select>
                                    <option value="">สภาพสินค้า</option>
                                    <option value="">มื่อหนึ่ง</option>
                                    <option value="">มือสอง</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                            <div class="dropdown-ฺband">
                                <div class="drowdown-ฺband-map">
                                    <select>
                                    <option value="">แบรนด์</option>
                                    <option value="">Nike</option>
                                    <option value="">Adidas</option>
                                    <option value="">Vans</option>
                                    <option value="">Converse</option>
                                    <option value="">Fila</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i> 
                                </div>
                            </div>
                            <div class="dropdown-ฺType">
                                <div class="drowdown-ฺฺType-map">
                                    <select>
                                    <option value="">ประเภทสินค้า</option>
                                    <option value="">รองทั่วไป</option>
                                    <option value="">รองเท้าฟุตบอล</option>
                                    <option value="">รองเท้าบาสเกตบอล</option>
                                    <option value="">รองเท้าเทรานิ่ง</option>
                                    <option value="">ประเภทอื่น</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i> 
                                </div>
                            </div>
                            <div class="dropdown-ฺGender">
                                <div class="drowdown-ฺฺฺGender-map">
                                    <select>
                                    <option value="">เพศ</option>
                                    <option value="">ผู้ชาย</option>
                                    <option value="">ผู้หญิง</option>
                                    <option value="">เด็ก</option>
                                    </select>
                                    <i class="fas fa-chevron-down"></i> 
                                </div>
                            </div>
                            <div class="dropdown-ฺMinPice">
                                <input class="textMinPice-map" type="text"  placeholder="ราคาต่ำสุด"> 
                            </div>
                            <div class="dropdown-ฺMaxPice">
                                <input class="searMaxPice-map" type="text"  placeholder="ราคาสูงสุด">
                            </div>
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
                                
                               <div class="iteam-img">
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"> <img src='upload/<?= $row["img1"]?>' alt="product1" class="img-product-map"></a> 
                                </div>
                                <div class="text-iteamt">
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameproduct"><?= $row["prd_name"]?></a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NameSell"><?= $row["prd_Name_Maket"]?></a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameposition">กรุงเทพ,พยาไท,สยามพารากอน</a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="TimeOpen">เปิดทำการ: 10.00 น. - 21.00 น. </a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NumberPhone">เบอร์โทรติดต่อ: 024794547 </a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="RetingSeller">เรตติ้ง : ดีมาก</a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Condition">สภาพสินค้า : <?= $row["prd_status"]?></a>
                                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="PiceProduct"><?= $row["prd_price"]?> บาท</a>
                                    <button class="Position-Seller">เส้นทางสินค้า</button>
                                    <button class="Descritin-Product">รายละเอียก</button>
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
                <div class="swiper-slide">
                  <div href="pase-product.php" class="slider-box">
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"><img src='upload/<?= $row["img1"]?>' alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameproduct"><?= $row["prd_name"]?></a>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NameSell">ลงขายโดย : <?= $row["prd_Name_Maket"]?></a>
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
                <div class="swiper-slide">
                  <div href="pase-product.php" class="slider-box>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"><img src='upload/<?= $row["img1"]?>' alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameproduct"><?= $row["prd_name"]?></a>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NameSell">ลงขายโดย : <?= $row["prd_Name_Maket"]?></a>
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
                <div class="swiper-slide">
                  <div href="pase-product.php" class="slider-box>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>"><img src='upload/<?= $row["img1"]?>' alt="product1" class="img-product-onehands"></a> 
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="Nameproduct"><?= $row["prd_name"]?></a>
                    <a href="pase-product-test.php?show=<?php echo $row["prd_id"];?>" class="NameSell">ลงขายโดย : <?= $row["prd_Name_Maket"]?></a>
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
                        <a href="#"><img src="./product/nike-Recovered.png" alt="Bands" class="img-Bands"></a> 
                     </div> 
                    </div>
                  <div class="swiper-slide">
                     <div class="slider-box">
                      <a href="#"><img src="./product/adidas-resize.png" alt="Bands" class="img-Bands"></a> 
                   </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="slider-box">
                        <a href="#"><img src="./product/converse-resize.png" alt="Bands" class="img-Bands"></a> 
                  </div>
                  </div>
                  <div class="swiper-slide">
                  <div class="slider-box">
                    <a href="#"><img src="./product/vans-resize.png" alt="Bands" class="img-Bands"></a> 
                 </div> 
                  </div>
                  <div class="swiper-slide">
                 <div class="slider-box">
                  <a href="#"><img src="./product/nike-Recovered.png" alt="Bands" class="img-Bands"></a> 
               </div> 
              </div>
                    <div class="swiper-slide">
                        <div class="slider-box" >
                        <a href="#"><img src="./product/adidas-resize.png" alt="Bands" class="img-Bands"></a> 
                      </div> 
                    </div>
            
                    <div class="swiper-slide">
                        <div class="slider-box">
                        <a href="#"><img src="./product/converse-resize.png" alt="Bands" class="img-Bands"></a> 
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
    </section>  
   <br>
   <br>
</body>
</html>