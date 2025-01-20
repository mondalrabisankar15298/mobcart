<?php
require("header.php");
include('db.php');
if(!empty($_SESSION['user_login'])){
}
else{
   header('location:login.php');
}

?>

<?php
if(isset($_POST['placeorder'])){
$user_email = $_SESSION['user_email']; 
$totalorder_price = $_GET['total'];
if($totalorder_price<0){
    header('location:cart.php');
}
$order_status = "Pending";
$name = $_POST['name'];
$phone = $_POST['phone'];
$area = $_POST['area'];
$city = $_POST['city'];
$state = $_POST['state'];
$landmark = $_POST['landmark'];
$pincode =  $_POST['pincode'];
$payment_type =  $_POST['payment_method'];
if($payment_type =="card"){
    $payment_status = "Success";
}
else{
    $payment_status = "Pending";
}
$sql = "INSERT INTO `order` (`order_id`, `user_email`, `phone`, `name`, `area`, `city`, `state`, `pincode`, `landmark`, `totalorder_price`, `order_status`, `payment_type`, `payment_status`, `order_date`) VALUES (NULL, '$user_email', '$phone', '$name', '$area', '$city', '$state', '$pincode', '$landmark', '$totalorder_price', '$order_status', '$payment_type', '$payment_status', current_timestamp());" ;
// mysqli_query($conn,$sql);
$abc = mysqli_query($conn,$sql);
if($abc){
$order_id = mysqli_insert_id($conn);
$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_email = '$user_email'");
if(mysqli_num_rows($select_cart) > 0){
   while($fetch_cart = mysqli_fetch_assoc($select_cart)){
        $product_id = $fetch_cart['product_id'] ;
        $product_quantity =$fetch_cart['product_quantity']  ;
        $product_price = $fetch_cart['product_price']  ;
        $product_title = $fetch_cart['product_title'] ;
        $product_details = $fetch_cart['product_details'] ;
        $product_image = $fetch_cart['product_image'] ;

        $sql8 = "INSERT INTO `orderdetails` (`orderdetails_id`, `order_id`, `product_id`, `product_quantity`, `product_price`, `product_title`, `product_details`, `product_image`) VALUES (NULL, '$order_id', '$product_id', '$product_quantity', '$product_price', '$product_title', '$product_details', '$product_image');";
        mysqli_query($conn,$sql8);
   }

}
$_SESSION['status_orderplaced'] = 'Order placed Successfully';
$_SESSION['alert_orderplaced'] = 'success';
header('location:index.php');

mysqli_query($conn,"DELETE FROM `cart` where user_email = '$user_email'");

}
else{
    $_SESSION['status_orderplaced1'] = 'Order placed Failed';
    $_SESSION['alert_orderplaced1'] = 'error';
}

}

?>



<div id="main-575">
    <h1 class="main-title-575">Confirm Order Details:</h1>

    <form action="" method="post" id="form1-575">
        <div class="addressfield-575">
            <h1 class="form-title-575">Address:</h1>

            <!-- <form action="" method="POST" enctype="multipart/form-data"> -->
                <div class="form-group-575">
                    <label class="form-label-575" for="">Full Name: </label>
                    <input class="form-input-575" type="text" placeholder="Full Name" name="name" id="fullname"><br>
                </div>

                <div class="form-group-575">
                    <label class="form-label-575" for="">Phone number: </label>
                    <input class="form-input-575" type="text" placeholder="enter valid phone number" name="phone"
                        id="phone"><br>
                </div>
                <label class="form-label-575" for="moredetails">Road name, area, colony:</label>
                <!-- <textarea class="form-input-textarea-575" name="area"></textarea> <br><br> -->
                <input class="form-input-575" type="text" placeholder="Area"  name="area"><br><br>

                <label class="form-label-575" for="city">City:</label>
                <input class="form-input-575" type="text" placeholder="city" name="city" id="city"><br>
                
                <label class="form-label-575" for="state">State: </label>
                <input class="form-input-575" type="text" placeholder="state" name="state" id="state">

                <label class="form-label-575" for="landmark">Landmark:</label>
                <input class="form-input-575" type="text" name="landmark" id="landmark" placeholder="Landmark">

                <label class="form-label-575" for="pincode">Pincode:</label>
                <input class="form-input-575" type="text" placeholder="pincode" id="pincode" name="pincode"><br><br>


            <!-- </form> -->

        </div>
        <div class="paymentmethod-575">
            <h1 class="form-title-575">Payment Method: </h1>
            <select class="dropdown-575" name ="payment_method">
                <option value="cash">Cash</option>
                <option value="card">Card</option>
            </select><br><br>
        </div>
        
        <button class="submit-button-575" type="submit" name = "placeorder">Place Order</button>

    </form>
</div>






<?php
require("footer.php");
include('alert/alert_placeorderfailed.php');
?>
<!-- </body>

</html> -->