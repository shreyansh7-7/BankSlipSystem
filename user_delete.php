<?php
session_start();
if($_SESSION["admin_login"] ==1){
  if (isset($_GET['user_id'])) {
    include 'db.php';
    $user_id = $_GET['user_id'];
    
    $conn->query("DELETE FROM user WHERE userr_id='$user_id'");
    header('location: http://localhost/php/MySql/users.php');
    $conn->close();
  }
}else{
  header('location: http://localhost/php/MySql/admin.php');
}
?>