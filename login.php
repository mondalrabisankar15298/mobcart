<?php
session_start();
include('db.php');
include('functions.php');
include('admindetails.php');
$tablename = 'users';
$empmsg_user_password = $empmsg_user_email = "";
if(isset($_POST['submit'])){
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $md5_user_password = md5($user_password);
    // if(empty($user_email)){
    //     echo " Fill up this field";
    // }
    // if(empty($user_password)){
    //     echo 'Fill up this field';
    // }

    // if single admin
    if(!email_validation($user_email)){
        $empmsg_user_email = "please enter a valid email.";
    }
    if(empty($user_email)){
        $empmsg_user_email = "Fill up this Field";
    }
    if(empty($user_password)){
        $empmsg_user_password = "Fill up this Field";
    }
    // if(false ==(password_validation($user_password) == "accepted")){
    //     $empmsg_user_password=  password_validation($user_password);
    // }
    if(!empty($user_email) && !empty($user_password) && email_validation($user_email)){
        $sql = "select * from $tablename where user_email = '$user_email' and user_password = '$md5_user_password'";
        if(($admin_email == $user_email)  ){   //admin login check
            if($admin_password == $user_password){ //if successfull
                $_SESSION['admin_login'] = ' admin login success';
                $_SESSION['status'] = 'Admin Login Successfully';
                $_SESSION['alert'] = 'success';
                header('location:admin_home.php');
            }
            else{   //if invalid admin data
                $_SESSION['status1'] = 'Invalid Data';
                $_SESSION['alert1'] = 'error';
            }

        }
        else{
            $query = mysqli_query($conn,$sql);
            if($query ->num_rows  >0){
                $_SESSION['user_login'] = 'user login success';
                $_SESSION['status'] = 'User Login Successfully';
                $_SESSION['alert'] = 'success';
                $_SESSION['user_email'] = $user_email;
                

                header('location:index.php');
                
            }
            else
            {
               
                $_SESSION['status1'] = 'Invalid Data';
                $_SESSION['alert1'] = 'error';
                

            }

        }
    }

  
}





?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="CSS\login_style.css">
         
    <title>Login Page</title>
</head>
<body>
    
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form  action="login.php" method="POST">
                    <div class="input-field">
                        <input  type="text" placeholder="Enter your email" name="user_email" value = "<?php if(isset($_POST['submit'])){echo $user_email;}?>" >
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <?php 
                           if(isset($_POST['submit'])){echo $empmsg_user_email;}
                        ?>
                    <div class="input-field">
                        <input type="password"  class="password" placeholder="Enter your password" name="user_password"  value = "<?php if(isset($_POST['submit'])){ echo $user_password;}?>">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <?php 
                           if(isset($_POST['submit'])){echo $empmsg_user_password;}
                        ?>
                    <div class="checkbox-text">
                        <!-- <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                         -->
                        <a href="forgotpassword.php" class="text">Forgot password?</a>
                    </div>
                    <button id="button-36" name = "submit" role="button">Login</button>
                   
                </form>

                <div class="login-signup">
                    <span class="text">Don't have an account?
                        <a href="register.php">Signup Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

            <script src="Script\login_script.js"></script>
</body>
</html>

<?php
include('alert\alert1.php');
?>