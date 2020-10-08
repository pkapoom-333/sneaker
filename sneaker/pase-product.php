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
    
    <div class="Show-product">
        <div class="container">
            <div class="Gride-product">
                <div class="Content-left">
                        <div class="tele-name-seller">ผู้จัดจำหน่าย</div>
                        
                        <button class="button-Seller">
                            <div class="content-sell-img">
                            <a href="#"><img src="./product/2.png" alt="Seller-img" class="Seller-img"></a>
                            </div>
                            <div class="content-sell-text">
                                <a href="#" class="Date-Seller">ร้าน Snakey

                                </a>
                                <a href="#" class="Date-Seller">เป็นสมาชิกมาแล้ว 1 ปี 4 เดือน 8 วัน</a>
                                <a href="#" class="Date-Seller">เรตติ้ง : ดีมาก</a>
                                <a href="#" class="Date-Seller">เปิดทำการ: 10.00 น. - 21.00 น. </a>
                                <a href="#" class="Date-Seller">เบอร์โทรติดต่อ: 024794547</a>
                            </div>
                            <div class="content-sell-icon">
                                <i class="fas fa-angle-right"></i>
                            </div>   
                        </button> 
                    
                        <div class="slider-product-show">
                        <div class="img-product-show">
                           <input type="radio" name="slide" id="img1">
                           <input type="radio" name="slide" id="img2">
                           <input type="radio" name="slide" id="img3">
                           <input type="radio" name="slide" id="img4">
                           <input type="radio" name="slide" id="img5">
                           <input type="radio" name="slide" id="img6"> 
                           
                           <img src="./product/1.png" class="m1" alt="img1">
                           <img src="./product/2.png" class="m2" alt="img2">
                           <img src="./product/3.png" class="m3" alt="img3">
                           <img src="./product/1.png" class="m4" alt="img4">
                           <img src="./product/2.png" class="m5" alt="img5">
                           <img src="./product/3.png" class="m6" alt="img6">
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
                    <a class="tele-name-product">Nike Air Max 270 </a>
                    <a class="tele-type-product">รองเท้าผู้ชาย </a>
                    <a class="tele-status-product">มือหนึ่ง</a>
                    <a class="tele-price-product"> ราคา 4500 บาท </a>
                    <a class="tele-siae-product">Size </a>
                    <div class="gride-lable-sizq">
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                        <a class="tele-size-product">EU 42 <br>(1)</a>
                    </div>
                    <a class="tele-conten-product">รายละเอียด </a>
                    <a class="tele-scrip-product">Nike Air Max 270 React ENG ผสานพื้นรองเท้าโฟมชั้นกลาง React แบบเต็มความยาวเท้าเข้ากับส่วน 270 Max Air เพื่อความสบายที่ใครก็เทียบไม่ติดและประสบการณ์รูปลักษณ์สวยสะดุดตา </a>
                    <a class="tele-contact-product">ช่องทางติดต่อ</a>
                        <div class="facebook">
                            <i class="fab fa-facebook"></i>
                            <a class="tele-facebook-product">Snakey</a>     
                        </div>
                        <div class="ig">
                            <i class="fab fa-instagram-square"></i>
                            <a class="tele-ig-product">Snakey_ig</a>
                        </div>
                        <div class="line">
                            <i class="fab fa-line"></i>
                            <a class="tele-line-product">@line_Snakey</a>
                        </div>
                    <a class="tele-about-product">รายละเอียดการลงขาย</a>
                        <div class="edit-product">
                            <i class="fas fa-edit"></i>
                            <a class="tele-edit-product">อัพเดทล่าสุด 21 มี.ค. 2563  11:42 น.</a>
                        </div>   
                        <div class="date-product">
                            <i class="fas fa-calendar-alt"></i>
                            <a class="tele-edit-product">ลงขายเมื่อ 13 มี.ค. 2563  11:23 น.</a>
                        </div>  
                        <div class="address-product">
                            <i class="fas fa-map-marker-alt"></i>
                            <a class="tele-edit-product">ปทุมธานี,ฟิวเจอร์พาร์ครังสิต</a>
                        
                        </div>  
                </div> 
            </div>  
            <div class="like-view">
                
                <button class="button-like">  
                   <i class="far fa-heart"></i>
                   <a href="#" class="like">รายการโปรด</a>
                </button> 
               
               <a href="#" class="view">100 view</a>
                
               
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
                 <a class="line-comment"></a>
                </div>
                

            </div>
            
        </div>
    </div> 
    </div>

</body>
</html>