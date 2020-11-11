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
    <link rel="stylesheet" href="./css/style-project1.css"/>
    <link rel="stylesheet" href="./css/swiper.min.css"/>

    
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>


    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>   


    
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
                <div class="Search-tetle">ค้นหาตำแหน่งร้านขายร้องเท้า</div>
                <button class="Search-position-button-map"><i class="fas fa-map-marked-alt"></i></button>
                <div class="Search-Map-tetle" id="test" >ตัวช่วยการค้นหา</div>
                
                <div class="Search-band-Tool">สภาพสินค้า
                    <?php
                         $sql = "SELECT DISTINCT prd_status FROM product ORDER BY prd_status";
                         $result= $conn->query($sql);
                         while($row = $result->fetch_assoc()){ 
                    ?>
                        <div class="checkbox-Search-Tool">
                            <input type="checkbox" class="input common_selector" value="<?=$row['prd_status'];?>" id="status">    <?= $row["prd_status"]?>
                        </div>
                    <?php } ?> 
                </div>
                
                <div class="Search-band-Tool">แบรนด์
                    <?php
                         $sql = "SELECT DISTINCT prd_brand FROM product ORDER BY prd_brand";
                         $result= $conn->query($sql);
                         while($row = $result->fetch_assoc()){ 
                    ?>
                        <div class="checkbox-Search-Tool">
                            <input type="checkbox" class="input common_selector" value="<?=$row['prd_brand'];?>" id="brand">    <?= $row["prd_brand"]?>
                        </div>
                    <?php } ?> 
                </div>
                <div class="Search-band-Tool">ประเภทสินค้า
                    <?php
                         $sql = "SELECT DISTINCT prd_type FROM product ORDER BY prd_type";
                         $result= $conn->query($sql);
                         while($row = $result->fetch_assoc()){ 
                    ?>
                        <div class="checkbox-Search-Tool">
                            <input type="checkbox" class="input common_selector" value="<?=$row['prd_type'];?>" id="type" >    <?= $row["prd_type"]?>
                        </div>
                    <?php } ?> 
                </div>
                <div class="Search-band-Tool">เพศ
                    <?php
                         $sql = "SELECT DISTINCT prd_gender FROM product ORDER BY prd_gender";
                         $result= $conn->query($sql);
                         while($row = $result->fetch_assoc()){ 
                    ?>
                        <div class="checkbox-Search-Tool">
                            <input type="checkbox" class="input common_selector" value="<?=$row['prd_gender'];?>" id="gender">    <?= $row["prd_gender"]?>
                        </div>
                    <?php } ?> 
                </div> 
                <div class="Search-pice-tool">ราคา</div>
                    <input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
                    <p id="price_show">1000 - 50000</p>
                    <div id="price_range" style="width:250px; hight:50px;"></div>
            </div> 
        <div class="item-Newbands-gride" id="result">
                
        </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">

     $(document).ready(function(){
        filter_data();
        function filter_data()
        {
            var action = 'data';
            var status = get_filter_text('status');
            var brand = get_filter_text('brand');
            var type = get_filter_text('type');
            var gender = get_filter_text('gender'); 
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            $.ajax({
            url:"Tool.php",
            method:"POST",
            data:{action:action,status:status,brand:brand,type:type,gender:gender,minimum_price:minimum_price,maximum_price:maximum_price},
            success:function(data){
                $("#result").html(data); 
            }
            });
        
        
        }   
        function get_filter_text(text_id){
            var filterData = [];
            $('#'+text_id+':checked').each(function(){
                filterData.push($(this).val());
            });
            return filterData;
        }
        
        $(".common_selector").click(function(){
            filter_data();
        });

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
     </div>
    </div>
                
    </div>                
</body>
    <div class="Footter">
   </div>
</html>