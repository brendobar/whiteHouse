<?php  
session_start();

$item = $_GET["prod"];
$connection = mysqli_connect("localhost","root","","Shop");
$res_con = $connection->query("SELECT * FROM Product");


		$res = "SELECT * from Product where id_Product = '$item'";
		$result = mysqli_query($connection,$res);
      	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      	
        $id=$row['id_Product'];
		$name=$row['Goods_Name'];
		$price=$row['Price'];
		$type=$row['Type'];
		$amount=$row['Product_Amount'];
		$picture = $row['img'];
		$stock_id = $row['id_Goods'];
		$text=$row['description'];

		$stock_p = $connection->query("SELECT `Goods_Amount` FROM `Shop`.`Warehouse` WHERE `id_Goods` = $stock_id");
		$row2 = mysqli_fetch_array($stock_p,MYSQLI_ASSOC);
		$stock = $row2['Goods_Amount'];
		
		if($amount != 0){
			$av = "В наличии";
			$color = "#20d34a";
		}elseif($amount==0 and $stock!=0){
			$av = "В наличии на складе";
			$color="yellow";
		}else{
			$av = "Нет в наличии";
			$color="red";
		}

$A = "'qty'";

$cor=0;
if(isset($_SESSION['cart'])){
    $cor=count($_SESSION['cart']);
}else{
    $cor=0;
}



		echo ('

			<!DOCTYPE html>
<html lang="rus">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <title>whitehouse - Furniture Ecommerce Template | Product Details</title>

    <link rel="icon" href="img/core-img/favicon.ico">

    <link rel="stylesheet" href="css/core-style.css">
    <link rel="stylesheet" href="style.css">


        <div class="hidden">
            <div class="cng_form">

                <form id="form-login" action="js/login.php" method="POST">
                    <input type="text" name="name" placeholder="Логин" required></input><br>
                    <input type="password" name="passwd" placeholder="Пароль" required></input><br>
                    <button id="log_in">Войти</button>
                    <p class="message">Нет аккаунта? <a href="#form-register" class="reg2">Регистрация</a></p>

                </form>


                <form id="form-register" action="js/register.php" method="POST">
                    <input type="text" name="name" placeholder="Почта" required></input><br>
                    <input type="text" name="passwd" placeholder="Пароль" required></input><br>
                    <input type="text" name="address" placeholder="Адрес" required></input><br>
                    <button id="send_r">Зарегестрироватся</button>
                    <p class="message">Зарегестрированны? <a href="#form-login" class="reg3">Вход</a></p>
                </form>
            </div>
        </div>



</head>

<body>


    <div class="main-content-wrapper d-flex clearfix">

        <div class="mobile-nav">
            <div class="whitehouse-navbar-brand">
                <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <div class="whitehouse-navbar-toggler">
                <span></span><span></span><span></span>
            </div>
        </div>

        <header class="header-area clearfix">
            <div class="nav-close">
                <i class="fa fa-close" aria-hidden="true"></i>
            </div>
            <div class="logo">
                <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
            </div>
            <nav class="whitehouse-nav">
                <ul>
                    <li><a href="index.html">Главная</a></li>
                    <li><a href="shop.html">Магазин</a></li>
                    <li><a href="cart.html" class="cart-nav">Корзина <span>('.$cor.')</span></a></li>
                </ul>
            </nav>
            <div class="whitehouse-btn-group mt-30 mb-100">
                <a href="js/logout.php" id="logout"class="btn whitehouse-btn mb-15">Выйти</a>
            </div>
            <div class="cart-fav-search mb-100">
                <a href="#form-login" class="fav-nav" id="cng"><img src="img/core-img/register.png" alt="">Вход/Регистрация</a>
            </div>
        </header>

        <div class="single-product-area section-padding-100 clearfix">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mt-50">
                                <li class="breadcrumb-item"><a href="http://whitehouse/index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="http://whitehouse/shop.html?&filter='.$type.'">'.$type.'</a></li>
                                <li class="breadcrumb-item active" aria-current="page">'.$name.'</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url('.$picture.');">
                                    </li>
                                    <!--<li data-target="#product_details_slider" data-slide-to="1" style="background-image: url(img/product-img/pro-big-2.jpg);">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="2" style="background-image: url(img/product-img/pro-big-3.jpg);">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="3" style="background-image: url(img/product-img/pro-big-4.jpg);">
                                    </li>-->
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <a class="gallery_img" href="img/product-img/pro-big-1.jpg">
                                            <img class="d-block w-100" src="'.$picture.'" alt="First slide">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="single_product_desc">
                            <div class="product-meta-data">
                                <div class="line"></div>
                                <p class="product-price">'.$price.' Руб.</p>
                                    <h6 style="font-size: 30px;">'.$name.'</h6>
                                <div class="ratings-review mb-15 d-flex align-items-center justify-content-between">
                                    <div class="ratings">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <p class="avaibility"><i style="color:'.$color.'" class="fa fa-circle"></i> '.$av.'</p>
                            </div>

                            <div class="short_overview my-5">
                                <p>'.$text.'</p>
                            </div>

                            <form name="crt" class="cart clearfix" method="post">
                                <div class="cart-btn d-flex mb-50">
                                    <p>Кол-во</p>
                                    <div class="quantity">
                                        <span class="qty-minus" onclick="var effect = document.getElementById('.$A.'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
                                        <input type="number" class="qty-text" id="qty" step="1" min="1" max="300" name="quantity" value="1">
                                        <span class="qty-plus" onclick="var effect = document.getElementById('.$A.'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-caret-up" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <button onmouseenter="checkLogin(this)" type="submit" name="addtocart" value="'.$id.'" class="btn whitehouse-btn">Добавить в корзину</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="footer_area clearfix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-lg-4">
                    <div class="single_widget_area">
                        <div class="footer-logo mr-50">
                            <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="single_widget_area">
                        <div class="footer_menu">
                            <nav class="navbar navbar-expand-lg justify-content-end">
                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#footerNavContent" aria-controls="footerNavContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
                                <div class="collapse navbar-collapse" id="footerNavContent">
                                    <ul class="navbar-nav ml-auto">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="index.html">Главная</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="shop.html">Магазин</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="cart.html">Корзина</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/active.js"></script>
    <script src="js/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="js/login.js"></script>
    <script>
    function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(";");
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==" ") c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function checkLogin(e){
        var is_session = getCookie("ses");
        if(is_session == "true"){
            frm = document.forms.crt;
            frm.setAttribute("action", "cart.html");
        }else{
            e.setAttribute("href", document.location.href);
            e.onclick = function(){
                alert("Чтобы добавить товар в корзину войдите пожалуйста в свою учетную запись.");
            };
        }
    }
    </script>

</body>

</html>

		');

?>