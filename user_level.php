<?php
session_start(); 
include 'oopDb.php';

$query =($conn->query("SELECT userr_id, Total_amount FROM slip "))->fetch_all();

$userid =array_column($query, '0');
print_r($userid);
$total =array_column($query, '1');
if ($return = $conn->query("SHOW TABLES LIKE 'userlevel'")){
    if($return->num_rows == 0) {
      $table = $conn->query("CREATE TABLE userlevel (
        userr_id INT(10) ,
        user_level VARCHAR(30) NOT NULL 
      )");
      echo "userlevel Table Created.";
    }
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
     
      </div>
  
  </body>
</html>