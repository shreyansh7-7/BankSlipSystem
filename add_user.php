<?php
session_start();
 if($_SESSION["admin_login"] ==1){
 if (isset($_GET['user_id'])) {
    include 'db.php';
    $user_id = $_GET['user_id'];
    $user_data = $conn->query("SELECT * FROM user WHERE userr_id = '$user_id'");
    $user = $user_data->fetch_all();
    $conn->close();
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
                <a class="nav-link" href="users.php">Users</a>
                </li>
            </ul>
        </nav>
        <div class="container" style="margin-top:80px;">
            <form name="input" action="users.php" method="post">
                <div class="table-responsive-sm">          
                    <table class="table table-bordered table-success">
                        <thead>
                            <h2>User Information</h2>
                        </thead>
                        <tr>
                            <td>
                            <label for="user_id">User Id : </label>
                            </td>
                            <td>
                                <input type='number' min="0" class="ml-5" value="<?php if (isset($_GET['user_id'])) {echo $user[0][1]; } ?>" name="user_id" required /><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <label for="username">Username : </label>
                            </td>
                            <td>
                                <input type="text" class="ml-5" value="<?php if (isset($_GET['user_id'])) {echo $user[0][2]; } ?>" name="username" required /><br>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="password">Password : </label>
                            </td>
                            <td>
                                <input type="password" class="ml-5" value="<?php if (isset($_GET['user_id'])) {echo $user[0][3]; } ?>" name="password" required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Make this user admin(if yes then type 1)
                            </td>
                            <td>
                                <input type="number" class="ml-5" value="<?php if (isset($_GET['user_id'])) {echo $user[0][5]; } ?>" name="ifadmin" min="0" max="1" reqired>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" class="btn btn-dark" style="margin-left:45%"  name="submit" />
                </div>
            </form>
        </div>
    </body>
</html>
<?php }else{
    header('location: http://localhost/php/MySql/admin.php');
}
?>