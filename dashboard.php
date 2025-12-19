<?php 
session_start();
if(!isset($_SESSION['username'])){
    echo "<script> window.open('login.php', '_self') </script>";
    exit();
}else{
    echo "Welcome to your dashboard, " . $_SESSION['username'];
    echo "<br><a href='logout.php'>Logout</a>";
}
 ?>