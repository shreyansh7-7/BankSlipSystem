<?php 
if(session_id() == ''){
session_start();
}
if(isset($_SESSION["user_login"]) && isset($_SESSION["username"]) ){
  
  if(isset($_POST['submit'])){

    $array= $_POST;
    foreach ($array as $key => $value) {
        $$key = $value;
    }
    $total=0;
    $name= $fname." ".$lname;
    $total+= $ten*10;
    $total+= $twenty*20;
    $total+= $fifty*50;
    $total+= $hundred*100;
    $total+= $two_hundred*200;
    $total+= $five_hundred*500;
    $total+= $two_thousand*2000;
  }
$servername = "localhost";
$db_username = "root";
$db_password = "";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
if($result = $conn->query("SHOW DATABASES LIKE 'Bank'")){
  if($result->num_rows == 0){
    $db = $conn->query("CREATE DATABASE Bank");
  }
}
$dbname="Bank";
include 'db.php';

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Creat Table if not exist.
if ($return = $conn->query("SHOW TABLES LIKE 'slip'")){
  if($return->num_rows == 0) {
    $table = $conn->query("CREATE TABLE slip (
      id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
      userr_id INT(10) ,
      slip_id INT(10) ,
      Customer_name VARCHAR(30) NOT NULL,
      Transaction_Date_and_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
      10_rupees INT(2),
      20_rupees INT(2),
      50_rupees INT(2),
      100_rupees INT(2),
      200_rupees INT(2),
      500_rupees INT(2),
      2000_rupees INT(2),
      Total_amount INT(5)
    )");
    echo "Slip Table Created.";
  }
}
if(isset($_POST['submit'])){
if ($return = $conn->query("SHOW TABLES LIKE 'userlevel'")){
  if($return->num_rows == 0) {
    $table = $conn->query("CREATE TABLE userlevel (
      userr_id INT(10) ,
      Total INT(20),
      user_level VARCHAR(30)
    )");
    echo "userlevel Table Created.";
  }
}
$total_user = $total;
// print($userid);
// exit();
$select =$conn->query("SELECT * FROM userlevel WHERE userr_id = $userid");
// print_r($select);
// exit();
if($select->num_rows == 0 || $select->num_rows <= 0){
  
  if($total_user>=0 && $total_user<25000 ){
    $level = 'SILVER';
  }elseif($total_user>=25000 && $total_user<50000){
    $level = 'GOLD';
  }elseif($total_user>=50000){
    $level = "PLATINUM";
  }
  // print($level);
  // exit();
  $in =$conn->query("INSERT INTO userlevel( userr_id, Total, user_level ) VALUES('$userid', '$total_user', '$level' )");
}else{  
  // print("jyhgfds");
  // exit();
    $q =($conn->query("SELECT Total FROM userlevel WHERE userr_id = $userid"))->fetch_all();
    $total_user += $q[0][0];
    if($total_user>=0 && $total_user<25000){
      $level = "SILVER";
    }elseif($total_user>=25000 && $total_user<=50000){
      $level = "GOLD";
    }elseif($total_user>=50000){
      $level = "PLATINUM";
    }
    $upd = $conn->query("UPDATE userlevel SET userr_id ='$userid',Total='$total_user', user_level ='$level' WHERE `userr_id`= '$userid' ");

}
}

//insert and update query.
if(isset($_POST['submit'])){
  $res = $conn->query("SELECT * FROM slip WHERE `slip_id` = '$slip_id'");
  if ($res->num_rows == 0 || $res->num_rows < 0){
    $insert = $conn->query("INSERT INTO slip ( userr_id,  slip_id, Customer_name, 10_rupees, 20_rupees, 50_rupees, 100_rupees, 200_rupees, 500_rupees, 2000_rupees, Total_amount )
    VALUES ( '$userid', '$slip_id', '$name', '$ten', '$twenty', '$fifty', '$hundred', '$two_hundred', '$five_hundred', '$two_thousand', '$total' )");
  }else {
    $update = $conn->query("UPDATE slip SET userr_id ='$userid', Customer_name='$name', 10_rupees='$ten', 20_rupees='$twenty', 50_rupees='$fifty', 100_rupees='$hundred', 200_rupees='$two_hundred', 500_rupees='$five_hundred', 2000_rupees='$two_thousand' WHERE slip_id='$slip_id'");
  }
}
$slipid =array_column($conn->query("SELECT slip_id FROM slip ")->fetch_all(), '0');
if(empty($slipid)){
    echo "<h3 style='margin: 100px 0px 0px 50px;'>No records found !</h3>";
  }
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Banking System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
      <a class="navbar-brand" href="#">CodeDuck</a>
      <ul class="navbar-nav">
          <li class="nav-item">
          <a class="nav-link" href="bank_slip.php">Home</a>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="bank_receipt.php">Receipt</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="logout.php">LogOut</a>
          </li>
      </ul>
    </nav>
    <div class="container ml-n2" style="margin-top:80px;">
    <div class="row ml-1" style=" background-color:#1e81b0;"><h3>Logged in : <?php echo $_SESSION["username"]; ?></h3></div>
      <div class="table-responsive-sm">
        <table class="table table-bordered table-dark">
  <?php if(!empty($slipid)){ ?>
            <tr>
              <th>User Level</th>
              <th>User Name</th>
              <th>Customer Name</th>
              <th>Transaction Date and Time</th>
              <th>Quantity of 10₹</th>
              <th>Quantity of 20₹</th>
              <th>Quantity of 50₹</th>
              <th>Quantity of 100₹</th>
              <th>Quantity of 200₹</th>
              <th>Quantity of 500₹</th>
              <th>Quantity of 2000₹</th>
              <th>Total Amount</th>
        <?php if($_SESSION["role_status"]==1){ ?>
              <th>Update</th>
              <th>Delete</th>
        <?php }?>
            </tr>
            
        <?php foreach ($slipid as $key => $value) { ?>
              <tr>
                  <?php $display = $conn->query("SELECT `userlevel`.`user_level`,
                                                        `user`.`username`,
                                                        `slip`.`Customer_name`, 
                                                        `slip`.`Transaction_Date_and_time`,
                                                        `slip`.`10_rupees`, 
                                                        `slip`.`20_rupees`, 
                                                        `slip`.`50_rupees`, 
                                                        `slip`.`100_rupees`, 
                                                        `slip`.`200_rupees`, 
                                                        `slip`.`500_rupees`, 
                                                        `slip`.`2000_rupees`,
                                                        `slip`.`Total_amount`  
                                                        FROM  user
                                                        LEFT JOIN slip 
                                                        ON `user`.`userr_id` = `slip`.`userr_id` 
                                                        LEFT JOIN userlevel 
                                                        ON `user`.`userr_id` = `userlevel`.`userr_id` 
                                                        WHERE  `slip`.`slip_id` = '$value' ");
                                                      $view = $display->fetch_all();
                                                      if($_SESSION["role_status"]==1){
                                                        array_push($view[0] , '<a href="http://localhost/php/MySql/bank_slip.php?slip_id='. $value .'" class="btn btn-warning"> Update </a>') ;
                                                        array_push($view[0] , '<a href="http://localhost/php/MySql/delete.php?slip_id='. $value .'" class="btn btn-danger" > Delete </a>') ;
                                                      }                                              
                                                      foreach($view[0] as $num => $ans){ ?>
                                                      <td><?php echo $ans; ?></td>
                                                <?php } ?>
              </tr>
      <?php   }
        } ?>
        </table>
      </div>
  <?php if($_SESSION["role_status"]==0){ ?>
      <button class="btn btn-dark" style="margin:0% 0% 0% 25%;"><a href='bank_slip.php'> Add entry</a></button> 
  <?php } ?>
    </div>
        
  </body>
</html>
<?php }else{
    header('location: http://localhost/php/MySql/login.php');
} ?>