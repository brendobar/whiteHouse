<?php
session_start();



   if (!empty($_SESSION['user']))
  die('Вы уже авторизованы');

   if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["REQUEST_METHOD"])) {
      $db = mysqli_connect("localhost","root","","Shop",3306); 
      $myusername = mysqli_real_escape_string($db,$_POST['name']);
      $mypassword = mysqli_real_escape_string($db,$_POST['passwd']); 
      $pass=sha1($mypassword);
      
      $sql = "SELECT id_Buyer FROM Buyer WHERE Name = '$myusername' and Pass = '$pass'";
      $result = mysqli_query($db,$sql);
      
      $count = mysqli_num_rows($result);
      
      
      
      if($count == 1) {
         $_SESSION['user']=$myusername;
         header("Location: http://whitehouse/index.html?".session_name().'='.session_id()); 

         
      }else {
         header("Location: http://whitehouse/index.html");
      }
      $_SESSION['cart']=array();
   }


?>