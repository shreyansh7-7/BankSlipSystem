<?php 
session_start();
if($_SESSION["admin_login"] ==1){
foreach($_POST as $key => $value){
    $$key = $value;
}
//$(user_id, username , password, add)
//connectin to db
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname="Bank";
$conn = new mysqli($servername, $db_username, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//Creat Table if not exist.
if ($return = $conn->query("SHOW TABLES LIKE 'user'")){
    if($return->num_rows == 0) {
      $table = $conn->query("CREATE TABLE user (
        sr_no INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userr_id INT(10) UNIQUE,
        username VARCHAR(30) NOT NULL,
        pass_word VARCHAR(30) NOT NULL,
        user_login INT(2) NOT NULL DEFAULT 0,
        role_status INT(1) NOT NULL
      )");
      echo "User Table Created.";
    }
  }
//insert and update query.
if(isset($_POST['submit'])){
    $res = $conn->query("SELECT * FROM user WHERE `userr_id` = '$user_id'");
    if (($res->num_rows == 0 || $res->num_rows < 0) && isset($_POST['submit'])){
       
      $insert = $conn->query("INSERT INTO user ( userr_id, username, pass_word, role_status )
      VALUES ( '$user_id', '$username', '$password', '$ifadmin' )");
    }else {
      $update = $conn->query("UPDATE user SET userr_id ='$user_id', username ='$username', pass_word ='$password', role_status ='$ifadmin' WHERE userr_id ='$user_id'");
    }
  }

$display = $conn->query("SELECT * FROM user");
$view = $display->fetch_all();

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
                <a class="nav-link" href="login.php">User Login</a>
                </li>
            </ul>
        </nav>
        <div class="container" style="margin-top:80px;">
            <form name="input" action="" method="post">
                <div class="table-responsive-sm">          
                    <table class="table table-bordered table-info">
                        <tr>
                            <th>Sr. no.</th>
                            <th>User Id</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Login Status</th>
                            <th>Admin</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                <?php       foreach ($view as $key => $value) {  
                                //array_shift($value) ;
                                array_push($value , '<a href="http://localhost/php/MySql/add_user.php?user_id='. $value[1] .'" class="btn btn-warning"> Update </a>') ;
                                array_push($value , '<a href="http://localhost/php/MySql/user_delete.php?user_id='. $value[1] .'" class="btn btn-danger" > Delete </a>') ;?>
                                    <tr>
                            <?php foreach ($value as $num => $ans) { ?>
                                        
                                        <td><?php echo $ans; ?></td>
                                        
                            <?php } ?>
                                
                        </tr>
                    <?php   } ?>
                    </table>
                </div>
            </form>
            <button class="btn btn-dark"><a href="add_user.php" style="color:white;">Add User</a></button>
        </div>
    </body>
</html>
<?php }else{
    header('location: http://localhost/php/MySql/admin.php');
}
?>