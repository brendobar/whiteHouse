<?php
session_start();
$connection = new mysqli("localhost","root","","Shop");

foreach( $_SESSION['cart'] as $key ){
	$user = $key['user']; 
	$good = $key['good'];
	$count = $key['count'];

    $sql = "SELECT `id_Buyer` FROM `Buyer` WHERE `Name` = '$user'";
    $result = mysqli_query($connection,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$usr = $row['id_Buyer'];



	$id_prep="SELECT COUNT(*) as total FROM `Orders`";
	$res = mysqli_query($connection,$id_prep);
	$row = mysqli_fetch_assoc($res);
	$id = $row['total']+1;


	$stmt=$connection->prepare("INSERT INTO `Orders`(`id_Order`, `id_Buyer`, `id_Product`, `Amount`) VALUES (?,?,?,?)");

	$stmt->bind_param("iiii",$id,$usr,$good,$count);
	if($stmt->execute()){
		echo "<script>
		alert(\"Заказ успешно оформлен\");
		history.pushState({}, '', 'http://whitehouse/index.html');
		location.reload();
		</script>";
	}else{
		echo "<script>
		alert(\"Ошибка сервера, попробуйте позже\");
		history.pushState({}, '', 'http://whitehouse/index.html');
		location.reload();
		</script>";
	}
	

}
for($i=0;$i<99;$i++){
	unset($_SESSION['cart'][$i]);
}


				
				

?>