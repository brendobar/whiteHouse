<?php
session_start();
$num_res=0;
$name=clean($_POST["name"]);
$passwd=clean($_POST["passwd"]);
$address=clean($_POST["address"]);

$password_hash=sha1($passwd);

if(!empty($name) || !empty($passwd) || !empty($address)){
	$connection = new mysqli("localhost","root","","Shop");
	$result_n=$connection->query("SELECT * from Buyer WHERE Name = '$name'");
	$name_res=$result_n->num_rows;
	if($name_res>0) {
		echo "<script>alert(\"Логин(Почта) уже используется.\");</script>";
	}else{
		if(filter_var($name,FILTER_VALIDATE_EMAIL)){
				$id_prep="SELECT COUNT(*) as total FROM `Buyer`";

				$res = mysqli_query($connection,$id_prep);
				$row = mysqli_fetch_assoc($res);
				$id = $row['total']+1;
				$stmt=$connection->prepare("INSERT INTO `Buyer` (`id_Buyer`, `Name`, `Address`, `Pass`) VALUES (?,?,?,?)");
				$stmt->bind_param("isss",$id,$name,$address,$password_hash);
				if($stmt->execute()){
					header("Location: http://whitehouse/index.html");
				}else{
					echo "<script>
					alert(\"Ошибка сервера, попробуйте позже\");
					history.pushState({}, '', 'http://whitehouse/index.html');
					location.reload();
					</script>";
				}


			
				$stmt->close();
				$connection->close();
		}else{
			echo "<script>alert(\"Не корректная почта.\");</script>";
		}
	}
}else{
	echo "<script>alert(\"Заполните все поля.\");</script>";
}
function clean($value = "") 
{ 
$value = trim($value); 
$value = stripslashes($value); 
return $value; 
} 
?>