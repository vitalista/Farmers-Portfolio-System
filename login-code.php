<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
if(empty($_POST["username"]) && empty($_POST["password"])){
  header('Location: index.php');
}
header('Location: dashboard.php');

}
?>