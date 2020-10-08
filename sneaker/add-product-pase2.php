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
            img{
                display: block;
                margin-left: 80px;
                width: 140px;
                height: 130px;
                background: #FFFFFF;
                border: 1px solid #021F54;
                box-sizing: border-box;
                margin-top: 20px;
                font-size: 200px;
            }
            span{
                 display:inline-block;
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
    <div class="register-product">
        <form action="PHP-addproduct2.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" required> 
        <div class="container"> 
            <div class="Greid-register-product">     
                <div class="Gride-right-register-product">
                    <label class="tele-register-product">อัพโหลดรูปสินค้า</label>
                    <div class="add-img-product" id='galery'></div>   
                    <input type="file" name="img_product_1[]" multiple required id="addImageInGalery">
                </div>
                <div class="Gride-left-register-product">
                    <div class="add-Name-product">
                        <label class="tele-add-Name-product">ชื่อสินค้า</label>
                        <input class="textbox-add-name-product" type="text" name="prd_name" required>
                    </div>
                    <div class="add-band-product">
                        <label class="tele-add-band-product">แบรนด์</label>
                        <div class="drowdown-ฺband-product"placeholder="แบรนด์">
                        <select name="prd_brand">
                        <option value="Null">แบรนด์</option>
                        <option value="Nike">Nike</option>
                        <option value="Adidas">Adidas</option>
                        <option value="Vans">Vans</option>
                        <option value="Converse">Converse</option>
                        <option value="Fila">Fila</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                        </div>
                    </div>
                    <div class="gried-Type-Condition-pice-gender">
                      <div class="add-Type-product">
                        <label class="tele-add-Type-product">ประเภทรองเท้า</label>
                        <div class="drowdown-ฺType-product">
                            <select name="prd_type" >
                            <option value="Null">ประเภทสินค้า</option>
                            <option value="รองเท้าทั่วไป">รองเท้าทั่วไป</option>
                            <option value="รองเท้าฟุตบอล">รองเท้าฟุตบอล</option>
                            <option value="รองเท้าบาสเกตบอล">รองเท้าบาสเกตบอล</option>
                            <option value="รองเท้าเทรานิ่ง">รองเท้าเทรานิ่ง</option>
                            <option value="ประเภทอื่น">ประเภทอื่น</option>
                            </select>
                            <i class="fas fa-chevron-down"></i> 
                        </div>  
                      </div>  
                      <div class="add-Condition-product">
                        <label class="tele-add-Condition-product">สภาพสินค้า</label>
                           <div class="drowdown-Condition-product">
                            <select name="prd_status" >
                            <option value="Null">ประเภทสินค้า</option>
                            <option value="มื่อหนึ่ง">มื่อหนึ่ง</option>
                            <option value="มือสอง">มือสอง</option>
                            </select>
                            <i class="fas fa-chevron-down"></i>
                        </div> 
                      </div>
                       <div class="add-pice-product">
                        <label class="tele-add-pice-product">ระบุราคาของสินค้า</label>
                         <div class="textbox-pice-product">  
                            <input class="textbox-pice-product" name="prd_price" type="text" required>
                         </div>
                       </div>
                       <div class="add-gender-product">
                        <label class="tele-add-gender-product">สำหรับเพศใด</label>
                        <div class="drowdown-ฺgender-product" >
                            <select name="prd_gender">
                            <option value="ผู้ชาย">ผู้ชาย</option>
                            <option value="ผู้หญิง">ผู้หญิง</option>
                            <option value="เด็ก">เด็ก</option>
                        </select>
                        <i class="fas fa-chevron-down"></i> 
                        </div> 
                       </div>
                    </div>
                    <label class="tele-add-site-product">ใส่จำนวนสินค้า ใต้ไซต์รองเท้าที่ต้องการขาย</label>
                    <div class="gride-lable-site-product">
                        <input class="tele-site-product" name="size_39" type="text" placeholder="EU 39">
                        <input class="tele-site-product" name="size_40" type="text" placeholder="EU 40">
                        <input class="tele-site-product" name="size_40_5" type="text" placeholder="EU 40.5">
                        <input class="tele-site-product" name="size_41" type="text" placeholder="EU 41">
                        <input class="tele-site-product" name="size_41_5" type="text" placeholder="EU 41.5">
                        <input class="tele-site-product" name="size_42" type="text" placeholder="EU 42">
                        <input class="tele-site-product" name="size_42_5" type="text" placeholder="EU 42.5">
                        <input class="tele-site-product" name="size_43" type="text" placeholder="EU 43">
                        <input class="tele-site-product" name="size_44" type="text" placeholder="EU 44">
                        <input class="tele-site-product" name="size_44_5" type="text" placeholder="EU 44.5">
                        <input class="tele-site-product" name="size_46" type="text" placeholder="EU 46">
                        <input class="tele-site-product" name="size_47" type="text" placeholder="EU 47">
                        <input class="tele-site-product" name="size_47_5" type="text" placeholder="EU 47.5">
                    </div>

                </div>
            </div>
            <label class="tele-add-scrip-product">ใส่รายละเอียดสินค้า</label>
            <input class="textbox-add-scrip-product" name="prd_detail" type="text" required>
            <div class="Application-conditions-product">
                <input type="radio" name="radioApplicationconditions" class="radio-Application-conditions">
                <label class="text-male">คุณยอมรับ นโยบายความเป็นส่วนตัว และ ข้อกำหนดการใช้ ของ Snakey Crawling</label>
            </div>
            <button href="profile.html" class="accept-regiter-product" name="addproduct2" value="addproduct2" >ตกลง</button>
            <button class="cancle-regiter-product">ยกเลิก</button>
        </div>
        </form>
    </div>
    <script>
            // Verifica se as APIs de arquivo são suportadas pelo navegador.
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                // Todas as APIs são suportadas!
            } else {
                alert('A APIs de arquivos não é totalmente suportada neste navegador.');
            }


            function handleFileSelect(evt) {
                var files = evt.target.files; // Objeto FileList guarda todos os arquivos.
                var output = [];
                //Intera sobre os arquivos e lista esses objetos no output.
                for (var i = 0, f; f = files[i]; i++) {
//        console.log('Objeto do arquivo', f);
                    // Informação adicional se for imagem:
                    if (f.type.match('image.*')) {
                        var reader = new FileReader();
                        //A leitura do arquivo é assíncrona
                        reader.onload = (function(theFile) {
                            return function(e) {
//                                console.log('Img info', e, theFile);
                                // Gera a miniatura:
                                var img = document.createElement('img');
                                img.src = e.target.result;
                                img.title = escape(theFile.name);
                                var span = document.createElement('span');
                                //Obtém o tamanho:
                                //Só é possível obter o tamanho do arquivo após o carregamento dele na miniatura, como o src é um base64 gerado à partir do arquivo local não terá custo de carregamento através da rede.
                                img.onload = function() {
                                    var i = document.createElement('i');
                               /* i.innerHTML = "<br>Tamanho Miniatura: " + img.width + "px Largura - " + img.height + "px Altura <br> Tamanho original:" + img.naturalWidth + "px Largura - " + img.naturalWidth + "px Altura";
                                    span.appendChild(i);
                                    //Esse método retorna o tamanho calculado: Resultado esperado ((proporcional)x75)

                                    //var width = img.clientWidth;
                                    //var height = img.clientHeight;*/
                                }

                                span.appendChild(img);
                                document.getElementById('galery').insertBefore(span, null);
                            };
                        })(f);
                        // Read in the image file as a data URL.
                        reader.readAsDataURL(f);
                    } else if (f.type.match('application/pdf')) {
                        console.log('pdf');
                    }
                   document.getElementById('galery').innerHTML =  output.join('') ;
                }
                
            }

            document.getElementById('addImageInGalery').addEventListener('change', handleFileSelect, false);

        </script> 
    

</body>
</html>