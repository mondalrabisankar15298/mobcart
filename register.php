<?php
session_start();
include('db.php');
include('functions.php');
$empmsg_user_name = $empmsg_user_email = $empmsg_user_password = $empmsg_user_password_again = $empmsg_user_phn ="";
if(isset($_POST['submit'])){
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phn = $_POST['user_mobile'];
    $user_password = $_POST['user_password'];
    $user_password_again = $_POST['user_password_again'];
    $md5_user_password = md5($user_password);
    if(!email_validation($user_email)){
        $empmsg_user_email = "please enter a valid email address";
    }
    if(!(password_validation($user_password) == "accepted")){
        $empmsg_user_password=  password_validation($user_password);
    }
    if(!(mobile_validation($user_phn) == "accepted")){
        $empmsg_user_phn=  mobile_validation($user_phn);
    }
    if(!check_confirm_password($user_password,$user_password_again)){
        $empmsg_user_password_again = "Password and confirm password must be same.";
    }
    if(!(name_validation($user_name) == "accepted")){
        $empmsg_user_name= name_validation($user_name);
    }
    // if(empty($user_name)){
    //     $empmsg_user_name = "Fill up this Field";
    // }
    if(empty($user_email)){
        $empmsg_user_email = "Fill up this Field";
    }
    if(empty($user_password_again)){
        $empmsg_user_password_again = "Fill up this Field";
    }
    if(empty($user_password)){
        $empmsg_user_password = "Fill up this Field";
    }
    if(empty($user_phn)){
        $empmsg_user_phn = "Fill up this Field";
    }
    if((name_validation($user_name) == "accepted") && !empty($user_email) && !empty($user_password) && !empty($user_password_again) && (mobile_validation($user_phn) == "accepted") && email_validation($user_email) && (password_validation($user_password) == "accepted") && check_confirm_password($user_password,$user_password_again) ){
        
            $sql = "insert into users (user_name,user_email,user_phn,user_password) values ('$user_name ','$user_email','$user_phn','$md5_user_password')";
            if($conn->query($sql)== true){
                $_SESSION['status_reg'] = 'User Register Sucessfull';
                $_SESSION['alert_reg'] = 'success';
                header('location:login.php');
                // header('location:index.php?usercreate');

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
         
    <title>Registration Form</title>
</head>
<body>
    
    <div class="container">
        <div class="forms">
            

          
            <div class="form signup">
                <span class="title">Registration</span>

                <form action="register.php" method="POST">
                    <div class="input-field">
                        <input type="text" name="user_name" value="<?php if(isset($_POST['submit'])){echo $user_name;}  ?>" placeholder="Enter your name" >
                        <i class="uil uil-user"></i>
                        
                    </div>
                    <?php  if(isset($_POST['submit'])){echo $empmsg_user_name;}
                        ?>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" name="user_email" value="<?php if(isset($_POST['submit'])){echo $user_email; } ?>" >
                        <i class="uil uil-envelope icon"></i>
                        
                    </div>
                    <?php  
                      
                        if(isset($_POST['submit'])){echo $empmsg_user_email;}
                         ?>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your Mobile No." name="user_mobile" value="<?php if(isset($_POST['submit'])){echo $user_phn; } ?>" >
                        <i class="uil uil-phone icon"></i>
                       
                        
                    </div>
                    <?php  
                      
                        if(isset($_POST['submit'])){echo $empmsg_user_phn;}
                         ?>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Create a password" name="user_password" >
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                      
                      
                    </div>
                    <?php  if(isset($_POST['submit'])){echo $empmsg_user_password;} ?>
                    <div class="input-field">                   
                        <input type="password" class="password" placeholder="Confirm a password" name="user_password_again">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                        
                    </div>
                    <?php  if(isset($_POST['submit']))
                        {echo $empmsg_user_password_again;
                            
                        } 
                            
                        ?>
                    <!-- <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="termCon">
                            <label for="termCon" class="text">I accepted all terms and conditions</label>
                        </div>
                    </div> -->

                    <button id="button-36" name = "submit" role="button">Sign Up</button>
                </form>

                <div class="login-signup">
                    <span class="text">Already have an account?
                        <a href="login.php" >Login Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <script src="Script\login_script.js"></script>

</body>
</html>
