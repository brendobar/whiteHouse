<?php
session_start();

function request_url()
{
  $result = ''; 

  $result .= $_SERVER['REQUEST_URI'];
  return $result;
}


function Page(){
	error_reporting(0);
	$page = $_GET["page"];
    $filter = $_GET["filter"];
    $quantity = $_GET["limit"];
    $sort=$_GET["price"];
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
    if(!isset($min)) $min = 10;
    if(!isset($max)) $max = 10000000;


	$url = request_url();
	$url = str_replace("/shop.html","",$url);
	if(!isset($url)){
		$url_new = "";
	}else{
		$c = stristr($url, '?');


		$c_temp = stristr($c, '?');
		$c_temp = str_replace("?","",$c_temp);



		if(stristr($c_temp, '=', true)=="page"){
			$search = "?page=".strval($page)."";
			$url_new = str_replace($search,"",$url);
		}else{
			$url_new = $c_temp;
		}
	}


    if($filter=="all"){
        $result2 = $connection->query("SELECT * FROM Product WHERE Price<=$max AND Price>=$min");
        $q = "SELECT * FROM Product WHERE Price<=$max AND Price>=$min";
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
		$th = $page+1;	    
	    $start = 1;	    
	    $end = $pages;
	    for ($j = 1; $j<=$pages; $j++){
	    	if($pages==1){
	    		echo ("
	    			<li class='page-item active' style='display:none'><a class='page-link' href='#'>".$j."</a></li>
	    		    ");
	    	}else{
	    		if ($j>=$start && $j<=$end){
	    		    		if ($j==$th){
	    		    			echo ("
	    							<li class='page-item active'><a class='page-link' href='#'>".$j."</a></li>
	    		    			");
	    		    		}else{		
	    		    			echo ("
	    		    				<li class='page-item'><a class='page-link' href='http://whitehouse/shop.html?page=".$j."".str_replace("?","",$url_new)."'>".$j."</a></li>
	    		    			");
	    		    		}
	    		    	}
	    		    }
	    }
}
?>