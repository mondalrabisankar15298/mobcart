<?php
session_start();
include('db.php');
$user_name = "";
$user_email_current = "";

//$user_email = $_SESSION['user_email'];
if (!empty($_SESSION['user_login'])) {

    $user_email = $_SESSION['user_email'];
    $data = mysqli_query($conn, "SELECT * FROM `users` where user_email = '$user_email' ") or die('query failed');
    while ($row = mysqli_fetch_array($data)) {
        $user_name = $row['user_name'];
        $user_email_current = $row['user_email'];

    }

}
$select_rows = mysqli_query($conn, "SELECT * FROM `cart` where user_email = '$user_email_current' ") or die('query failed');
$row_count = mysqli_num_rows($select_rows);

// $select_wishlist = mysqli_query($conn,"SELECT * FROM `wishlist` where user_emial = '$user_email_current' ") or die('query failed');
// $wishlist_row_count = mysqli_num_rows($select_wishlist);
$select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` where user_email = '$user_email_current' ") or die('query failed');
$row_count_wishlist = mysqli_num_rows($select_wishlist);

if (isset($_POST['logout'])) {
    $_SESSION['status_logout'] = 'Logout Successfull';
    $_SESSION['alert_logout'] = 'success';
    header('location:logout.php');

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOBCART</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="Script\app.js" defer></script> 
  <link rel="stylesheet" type="text/css" href="CSS\style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
  <header>
    <div class="navbar_74">
      
      <ul class="menu_74">
        <span><a href="index.php">MobCart</a></span>
        <li class="menu_li"><a href="index.php">Home</a></li>
        <li class="menu_li"><a href="phone.php">Phone</a></li>
        <li class="menu_li"><a href="tablet.php">Tablet</a></li>
        <li class="menu_li"><a href="accessories.php">Accessories</a></li>
      <?php
        if($user_name !=""){


      ?>

        <div class="profile_id">
            <span class="profile_id_span"><i class="fas fa-user"></i> <?php echo ucfirst($user_name); ?></span>
            <div class="submenu">
                <a href="myorder.php">My Orders</a>
                <a href="logout.php">Log Out</a>
              </div>
            
        </div>

        <a href="wishlist.php"><i class="fas fa-heart icons_74"><span><?php echo $row_count_wishlist; ?></span></i></a>
        <a href="cart.php"><i class="fas fa-shopping-cart icons_74"><span><?php echo $row_count; ?></span></i></a>
      <?php
        }
        else{
      ?>
        <a href="login.php">
        <button class="button-74" role="button" name="login">Log In</button>
        </a>
      <?php
        }
      ?>

      </ul>

    </div>
  </header>


