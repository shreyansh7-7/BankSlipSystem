<?php
if (!isset($_SESSION)) {
  session_start();
}

if(isset($_POST['submit'])){
  //posting data from form itself
  $username =$_POST['uname'];
  $password = $_POST['psw'];
  include 'db.php';
  // echo "gvbnm,";
  // exit();
  //check for username and password if true or not.
  $res = $conn->query("SELECT * FROM user WHERE username = '$username' AND pass_word = '$password'");
  $result = $res->fetch_all();
  if (empty($result)){
    echo '<script>alert("User or password is wrong!")</script>';
    // exit();
  }else{
    $_SESSION["user_login"] =1;
    $_SESSION["username"]="$username";
    $update =$conn->query("UPDATE user SET user_login = 1 WHERE username = '$username'");
    header('location: http://localhost/php/MySql/bank_slip.php');
  }
}
else{
  
  if(isset($_SESSION["username"])){
    include 'db.php';
    $username=$_SESSION["username"];
    $display = $conn->query("SELECT user_login FROM user WHERE username = '$username'");
    $view = $display->fetch_all();
    // print_r($view);
    // exit;
    if($view[0][0] ==1){
      echo "user already logged in !";
      header('location: http://localhost/php/MySql/bank_slip.php');
    }
  }
}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    body {font-family: Arial, Helvetica, sans-serif;}
    form {border: 3px solid #f1f1f1;}

    input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    }

    button {
    background-color: #04AA6D;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    }

    button:hover {
    opacity: 0.8;
    }

    .cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
    }

    .imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    }

    img.avatar {
    width: 10%;
    border-radius: 10%;
    }

    .container {
    padding: 16px;
    }

    span.psw {
    float: right;
    padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
    span.psw {
        display: block;
        float: none;
    }
    .cancelbtn {
        width: 100%;
    }
    }
</style>
</head>
<body>

<h2>Login Form</h2>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <div class="imgcontainer">
    <img src="img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="container">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
        
    <button type="submit" name="submit">Login</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <button type="button" class="btn" style="color:white;"><a href="admin.php">Admin Login</a></button>
  </div>
</form>

</body>
</html>
