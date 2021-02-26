<?php  
session_start();
function showEvent(){
$tmp=1;
$connection = mysqli_connect("localhost","root","","Shop");
$res_con = $connection->query("SELECT * FROM Product");
	while($tmp<=9){

		$res = "SELECT * FROM Product where id_Product = '$tmp'";
		$result = mysqli_query($connection,$res);
      	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      	
        $id=$row['id_Product'];
		$name=$row['Goods_Name'];
		$price=$row['Price'];
		$picture = $row['img'];
        $newPrice = intval($price*85/100);

		echo ("

			<div class='single-products-catagory clearfix'>
                <a href='product-details.php?prod=".$id."'>
                    <img src='".$picture."' alt='".$name." style='width:500px; padding:50px;>
                    <div class='hover-content'>
                        <div class='line'></div>
                        <p>".$price." Руб. </p>
                        
                        <h4>".$name."</h4>
                    </div>
                </a>
            </div>
		");
		$tmp++;
	}
}

function showProduct(){
	$page = $_GET["page"];
    $filter = $_GET["filter"];
    $quantity = $_GET["limit"];
    $sort = $_GET["price"];
    $min = $_GET["min"];
    $max = $_GET["max"];

	$connection = mysqli_connect("localhost","root","","Shop");

    if(!isset($sort) || $sort=="P"){
        $sort_q="ORDER BY `Product_Amount` DESC";
    }elseif ($sort=="ASC") {
        $sort_q="ORDER by `Price` ASC";
    }elseif ($sort=="DESC") {
        $sort_q="ORDER by `Price` DESC";
    }
    if(!isset($quantity)) $quantity=6;  
	if(!isset($page)) $page=1;
	if(!is_numeric($page)) $page=1;
	if ($page<1) $page=1;
    if($filter=="") $filter = "all";
    if(!isset($min)) $min = 1000;
    if(!isset($max)) $max = 10000000;


    if($filter=="all"){
        $result2 = $connection->query("SELECT * FROM Product WHERE Price<=$max AND Price>=$min");
    }else{
        $result2 = $connection->query("SELECT * FROM Product WHERE Type='$filter' AND Price<=$max AND Price>=$min");
    }
	$numt=$result2->num_rows;
	$pages = $numt/$quantity;
	$pages = ceil($pages);
	if ($page>$pages) $page = 1;
	if (!isset($list)) $list=0;
	$list=--$page*$quantity;
	if($filter=="all"){
        $res = "SELECT * FROM Product WHERE Price<=$max AND Price>=$min $sort_q LIMIT $quantity OFFSET $list";
    }else{
        $res= "SELECT * FROM Product WHERE Type='$filter' AND Price<=$max AND Price>=$min $sort_q LIMIT $quantity OFFSET $list";
    }
	$result = mysqli_query($connection,$res);
	$num_result = mysqli_num_rows($result); 


	for ($i = 0; $i<$num_result; $i++) {
	    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        $id=$row['id_Product'];
		$name=$row['Goods_Name'];
		$price=$row['Price'];
		$picture = $row['img'];

	    echo("
                    <div class='col-12 col-sm-6 col-md-12 col-xl-6'>
                        <div class='single-product-wrapper'>
                            <div class='product-img'>
                            	<a href='product-details.php?prod=".$id."'>
                                	<img src='".$picture."' alt='".$name."'>
                                </a>
                            </div>

                            <div class='product-description d-flex align-items-center justify-content-between'>
                                <div class=product-meta-data>
                                 	<div class='line'></div>
                                    <p class='product-price'>".$price." Руб.</p>
                                    <a href='product-details.php?prod=".$id."'>
                                        <h6>".$name."</h6>
                                    </a>
                                </div>
                                <div class='ratings-cart text-right'>
                                    <div class='ratings'>
                                        <i class='fa fa-star' aria-hidden='true'></i>
                                        <i class='fa fa-star' aria-hidden='true'></i>
                                        <i class='fa fa-star' aria-hidden='true'></i>
                                        <i class='fa fa-star' aria-hidden='true'></i>
                                        <i class='fa fa-star' aria-hidden='true'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>		
	    ");
	}
	

	    

	 }

	
?>