<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
if(empty($_POST["username"]) && empty($_POST["password"])){
  header('Location: ../login/');
}
header('Location: ../otp/');

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify'])) {
  for($i = 1; $i < 5; $i++){
    if(empty($_POST[$i])){
      header('Location: ../otp/');
    }
  }
  
  header('Location: ../dashboard/dashboard.php');
  
  }

?>