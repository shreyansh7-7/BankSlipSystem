<?php
session_start();
if($_SESSION["user_login"] ==1 && $_SESSION["role_status"]==1){
if (isset($_GET['slip_id'])) {
  include 'db.php';
  $slip_id = $_GET['slip_id'];
  echo '<script>alert("Do you want to delete? sure?")</script>';
  $select = ($conn->query("SELECT Total_amount,userr_id FROM slip WHERE slip_id ='$slip_id'"))->fetch_all();
  $selected_total = $select[0][0];
  $selected_uid = $select[0][1];

  
  $sel = ($conn->query("SELECT Total FROM userlevel WHERE userr_id ='$selected_uid'"))->fetch_all();
  $edit = $sel[0][0];
  $edit -= $selected_total;
  if($edit>=0 && $edit<25000 ){
    $level = 'SILVER';
  }elseif($edit>=25000 && $edit<50000){
    $level = 'GOLD';
  }elseif($edit>=50000){
    $level = "PLATINUM";
  }
  if($edit<=0){
      $conn->query("DELETE FROM userlevel WHERE userr_id = '$selected_uid'");
  }else{
  $minus = $conn->query("UPDATE userlevel SET Total = '$edit', user_level='$level' WHERE userr_id = '$selected_uid'");
  }
  $conn->query("DELETE FROM slip WHERE slip_id='$slip_id'");
  header('location: http://localhost/php/MySql/bank_receipt.php');

  $conn->close();
}
}else{
  header('location: http://localhost/php/MySql/login.php');
}
?>