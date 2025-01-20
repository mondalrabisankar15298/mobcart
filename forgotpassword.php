<?php
session_start();
include('db.php');
include('functions.php');

if(isset($_POST['submit'])){
    $error=$empmsg_phn = $empmsg_email ="";
    $email = $_POST['user_email'];
    $phone = $_POST['user_phone'];

    if(!email_validation($email)){
        $empmsg_email = "Please enter a valid email.";
    }
    if(!(mobile_validation($phone) == "accepted")){
        $empmsg_phn = mobile_validation($phone);
    }
    if(email_validation($email) && (mobile_validation($phone) == "accepted")){
        $sql = "SELECT * FROM `users` where user_email = '$email' and user_phn = '$phone'";
        $query = mysqli_query($conn,$sql);
        if($query -> num_rows >0){
            $_SESSION['email'] = $email;
            $_SESSION['match'] = "Successfull";

        }
        else{
            $error = "Invalid Credentials!";


        }


    }

}

if(isset($_POST['confirm'])){
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $md5_password = md5($password);
    $email = $_SESSION['email'];
    $empmsg_password = $show = $error1 = $empmsg_confirm_password= "";
    if(!(password_validation($password) =="accepted")){
        $empmsg_password = password_validation($password);
    }
    if(!check_confirm_password($password,$confirm_password)){
        $$empmsg_confirm_password = "Password and Confirm password must be same";
    }
    if(password_validation($password) && check_confirm_password($password,$confirm_password)){
        $sql = "update `users` set user_password = '$md5_password' where user_email ='$email';" ;
        $update_password = mysqli_query($conn,$sql);
        if($update_password){
            $show = "Password Change Successful.";

        }
        else{
            $error1 = "Password Change Failed";
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
    <!-- ===== Font Awesome icons library CSS ===== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="CSS\login_style.css">

    <title>Forgot Password Page</title>
</head>

<body>
<?php
if(empty($_SESSION['match'])){
?>
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Forgot Password</span>

                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" name="user_email" value="<?php  if(isset($_POST['submit'])){ echo $email; }   ?>" required>
                        <i class="fas fa-envelope icon"></i>
                    </div>
                    <?php  if(isset($_POST['submit'])){ echo $empmsg_email; }   ?>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your phone" name="user_phone" value="<?php  if(isset($_POST['submit'])){ echo $phone; }   ?>" required>
                        <i class="fas fa-phone icon"></i>
                    </div>
                    <?php  if(isset($_POST['submit'])){ echo $empmsg_phn; }   ?>
                    <button id="button-36" name="submit" role="button">Submit</button>
                   <span class="title1"><?php  if(isset($_POST['submit'])){ echo $error; }   ?></span> 
                </form>

            </div>
            
        </div>
    </div>
    <?php
}
else{
    ?>


    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Change Password</span>
                <form action="" method="post">
                    <div class="input-field">
                        <input type="password" class ="password" placeholder="Enter new password" name="password">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <?php  if(isset($_POST['confirm'])){ echo $empmsg_password; }   ?>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Confirm new password" name="confirm_password" >
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <?php  if(isset($_POST['confirm'])){ echo $empmsg_confirm_password; }   ?>
                    <button id="button-36" name="confirm" role="button">Confirm</button>
                    <span class="title1"><?php  if(isset($_POST['confirm'])){ echo $error1; }   ?></span> 
                    <span class="title1"><?php  if(isset($_POST['confirm'])){ echo $show; }   ?></span> 
                    <?php
                    if(isset($_POST['confirm'])){
                        if($show!=''){
                    ?>     
                        <a href="login.php"><button id="button-36" role="button">Go To Login Page</button></a>   
                    <?php
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>
    <script src="Script\login_script.js"></script>





</body>

</html>