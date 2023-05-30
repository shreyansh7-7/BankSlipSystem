<?php 
session_start();
    if(isset($_SESSION["user_login"]) && isset($_SESSION["username"]) ){
        $user_name=$_SESSION["username"];
        include 'db.php';
        $user_data = ($conn->query("SELECT userr_id as user_id FROM user"))->fetch_all();
        $users = array_column($user_data, '0');
        $geting =($conn->query("SELECT userr_id, role_status FROM user WHERE username = '$user_name'"))->fetch_all();   
        $_SESSION["role_status"]=$geting[0][1];
    if (isset($_GET['slip_id']) && $_SESSION["role_status"]==1 ) {
        $slip_id =$_GET['slip_id'];
        $slip_data = $conn->query("SELECT * FROM slip WHERE slip_id='$slip_id'");
        $slip = $slip_data->fetch_all();
        $array = explode(" ",$slip[0][3]);
        $conn->close();
    }
?>
<?php if($_SESSION["role_status"]==0 || ($_SESSION["role_status"]==1 && isset($_GET['slip_id']))){ ?>
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
            <a class="nav-link" href="bank_receipt.php">Receipt</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">LogOut</a>
            </li>
        </ul>
        </nav>
        <div class="container" style="margin-top:80px;">
        <div class="row" style=" background-color:#1e81b0;"><h3>Logged in : <?php echo $_SESSION["username"]; ?></h3></div>
            <form action="bank_receipt.php" method="post">
                <div class="table-responsive-sm">          
                    <table class="table table-bordered table-dark">
                        <thead>
                            <h3>Banking</h3>
                        </thead>
                            <tr>
                                <td>Slip Id</td>
                                
                                <td><input  name="slip_id" type='number' min="0" required value= <?php if (isset($_GET['slip_id'])) {echo $slip[0][2]; }?> ) ></td>
                            </tr>
                            <tr>
                                <td>First Name</td>
                                <td><input  name="fname"  type='text' required value = "<?php if (isset($_GET['slip_id'])) {echo $array[0]; } ?>"></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td><input  name="lname" type='text' required value = "<?php if (isset($_GET['slip_id'])) {echo $array[1]; } ?>"></td>
                            </tr>
                            
                        <tr>
                            <td><h4>Cash Information</h4></td>
                        </tr>
                            <tr>
                                <td>10 ₹</td>
                                <td>
                                <select name="ten" class="form-select" style="width:100px; text-align:center;">
                                            
                            <?php   for ($i=0; $i <=10 ; $i++) { 

                                        if($i ==  $slip[0][5]){    ?>
                                            <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                            <?php       }else{  ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php       }
                                    }   ?>
                                </select>

                                </td>
                            </tr>
                            <tr>
                                <td>20 ₹</td>
                                <td>
                                    <select name="twenty" class="form-select" style="width:100px; text-align:center;">
                                <?php   for ($i=0; $i <=10 ; $i++) { 
                                            if($i ==  $slip[0][6]){    ?>
                                                <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                <?php       }else{ ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php       }
                                        }   ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>50 ₹</td>
                                <td>
                                    <select name="fifty" class="form-select" style="width:100px; text-align:center;">
                                <?php   for ($i=0; $i <=10 ; $i++) { 
                                            if($i ==  $slip[0][7]){    ?>
                                                <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                <?php       }else{ ?>
                                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php       }
                                        }   ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>100 ₹</td>
                                <td>
                                    <select name="hundred" class="form-select" style="width:100px; text-align:center;">
                                <?php   for ($i=0; $i <=10 ; $i++) { 
                                                if($i ==  $slip[0][8]){    ?>
                                                    <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                <?php            }else{ ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php            }
                                        }   ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>200 ₹</td>
                                <td>
                                    <select name="two_hundred" class="form-select" style="width:100px; text-align:center;">
                                <?php   for ($i=0; $i <=10 ; $i++) { 
                                                if($i ==  $slip[0][9]){    ?>
                                                    <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                <?php           }else{ ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php           }
                                        }   ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>500 ₹</td>
                                <td>
                                    <select name="five_hundred" class="form-select" style="width:100px; text-align:center;">
                                <?php   for ($i=0; $i <=10 ; $i++) { 
                                                if($i ==  $slip[0][10]){    ?>
                                                    <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                <?php           }else{ ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php          }
                                        }   ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>2000 ₹</td>
                                <td>
                                    <select name="two_thousand" class="form-select" style="width:100px; text-align:center;">
                                <?php   for ($i=0; $i <=10 ; $i++) { 
                                            if($i ==  $slip[0][11]){    ?>
                                                    <option value="<?php echo $i; ?>" selected><?php echo $i; ?></option>
                                <?php       }else{  ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php       }
                                        }   ?>
                                    </select>
                                </td>
                            </tr>
                    </table> 
                </div>
                <div class="row p-2" style="background-color:#1e81b0" >
                    <div class="col" >User Id :</div>
                    <div class="col">
                <?php if($geting[0][1]==1){    ?>
                        <select name="userid" class="form-select" style="width:100px; text-align:center;">
                                                
                        <?php   foreach($users as $key => $value){  

                                    if($geting[0][0] == $value){ ?>
                                        <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                            <?php   }else{ ?>
                                        <option value="<?php echo $value; ?>" ><?php echo $value; ?></option>
                            <?php   }
                                }  ?>
                        </select>
                <?php }else{  ?>
                        <select name="userid" class="form-select" style="width:100px; text-align:center;" >
                                                
                        <?php   foreach($users as $key => $value){  

                                    if($geting[0][0] == $value){ ?>
                                        <option value="<?php echo $value; ?>" selected><?php echo $value; ?></option>
                              <?php }else{ ?>
                                        <option value="<?php echo $value; ?>" disabled><?php echo $value; ?></option>
                              <?php }
                                }  ?>
                        </select>
            <?php    } 
                ?>
                    </div>
                </div>
                <button type="submit" name="submit"  class="btn btn-dark mt-5 ml-5">Submit</button>
            </form>
        </div>
    </body>
</html>

<?php }else{
    include 'bank_receipt.php';
} ?>

<?php }else{
    header('location: http://localhost/php/MySql/login.php');
} ?>