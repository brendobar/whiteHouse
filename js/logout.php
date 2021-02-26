<?php
session_start();
if(isset($_SESSION['user'])) { 
	header("Location: http://whitehouse/index.html"); 
	session_destroy();
	echo "<script>location.reload();</script>";

}else { 
session_destroy();
echo "<script>
					alert(\"Пожалуйста войдите в аккаунт\");
					history.pushState({}, '', 'http://whitehouse/index.html');
					location.reload();
					</script>";
}


function checkGood($arr, $id){
    foreach ($arr as $subArr) {
        $check_id = $subArr['good'];
        if($check_id==$id){
            return false;
        }else{
            return true;
        }
    }   
}



?>