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
    <link rel="stylesheet" href="CSS\style.css">
    <!-- <link rel="stylesheet" href="CSS\cart.css"> -->
</head>

<body>
    <!-- HEADER -->

    <header>

        <div class="container" id="navbar_container">
            <div class="navbar">
                <a class="logo" href="index.php">MobCart</a>
                <ul class="nav-list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="phone.php">Phone</a></li>
                    <li><a href="tablet.php">Tablet</a></li>
                    <li><a href="accessories.php">Accessories</a></li>
                    <li><a href="accessories.php">Rabi</a>
                        <ul class="hidden_header">
                            <li><a href="">My Orders</a></li>
                            <li><a href="">Logout</a></li>

                        </ul>
                    </li>

                </ul>
                <div class="icon">

                    <img src="images\user.png">
                    <?php echo ucfirst($user_name);
                    if ($user_name == "") {
                        ?>
                        <a href="login.php">

                            <button class="button-74" role="button" name="login">Log In</button>
                            </form>
                        </a>

                        <?php
                    } else {
                        ?>
                        <a href="logout.php">

                            <button class="button-74" role="button" name="logout">Logout</button>

                        </a>

                        <a href="wishlist.php">
                            <img src="images\heart.png">
                            <SPAN>
                                <?php echo $row_count_wishlist; ?>
                            </SPAN>

                        </a>

                        <a href="cart.php">
                            <img src="images\shopping-cart.png">
                            <SPAN>
                                <?php echo $row_count; ?>
                            </SPAN>


                        </a>

                        <?php
                    }


                    ?>




                </div>

                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                    <i class="fas fa-times"></i>
                </div>
            </div>
        </div>
    </header>