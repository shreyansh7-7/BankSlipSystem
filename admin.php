<?php
session_start();
$_SESSION["admin_login"] =0;
    if(isset($_POST['submit'])){
        $adminname =$_POST['adminname'];
        $password = $_POST['password'];
        if($adminname =="admin" && $password == "123"){
            $_SESSION["admin_login"] =1;
            header('location: http://localhost/php/MySql/users.php');
        }else{
            echo '<script>alert("Admin name or password is wrong!")</script>';
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
        </nav>
        <div class="container" style="margin-top:80px;">
            <form name="input" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="table-responsive-sm">          
                    <table class="table table-bordered table-dark">
                        <thead>
                            <h2>Admin Information</h2>
                        </thead>
                        <tr>
                            <td>
                            <label for="username">Admin name : </label>
                            </td>
                            <td>
                                <input type="text" class="ml-5" value="" name="adminname" required /><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password : </label>
                            </td>
                            <td>
                                <input type="password" class="ml-5" value="" id="password" name="password" required />
                            </td>
                        </tr>
                    </table>
                    <input type="submit" class="btn btn-dark" style="margin-left:45%"  name="submit" />
                </div>
            </form>
        </div>
    </body>
</html>
