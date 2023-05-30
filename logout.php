<?php

session_start();
if(isset($_SESSION["user_login"]) && isset($_SESSION["username"]) ){
    include 'db.php';
    $display = $conn->query("SELECT * FROM user");
    $view = $display->fetch_all();
    $username=$_SESSION["username"];
    $update =$conn->query("UPDATE user SET user_login = 0 WHERE username = '$username'");
    $display = $conn->query("SELECT * FROM user");
unset($_SESSION);
session_destroy();
}
header('location: http://localhost/php/MySql/login.php');
?>
