<?php

require('header.php');
include('db.php');

if(!empty($_SESSION['user_login'])){
}
else{
   header('location:login.php');
}
if(isset($_POST['details'])){
$_SESSION['order_id'] = $_POST['order_id'];
if($_SESSION['order_id'] !=""){
   header('location:myorder_details.php');
}

}


?>
<div class="container5">

<section class="shopping-cart">
<h1 class="heading1">My Orders</h1>

<table>

   <thead>
      <th>OrderId</th>
      <th>Name</th>
      <th>Phone No.</th>
      <th>Address</th>
      <th>Total Price</th>
      <th>Order Status</th>
      <th>Action</th>
      <th>Order Details</th>
   </thead>

   <tbody>

   <?php 
      if(!empty($_SESSION['user_login'])){

        $user_email = $_SESSION['user_email']; 
      
      if(isset($_GET['remove'])){
         $remove_id = $_GET['remove'];
         mysqli_query($conn, "DELETE FROM `order` WHERE `order_id` = '$remove_id'");
         mysqli_query($conn, "DELETE FROM `orderdetails` WHERE `order_id` = '$remove_id'");
         header('location:myorder.php');
      }
      
      


      $select_order = mysqli_query($conn, "SELECT * FROM `order` where user_email = '$user_email' ");
      if(mysqli_num_rows($select_order) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_order)){
   ?>

      <tr>
         
         <td><?php echo $fetch_cart['order_id']; ?></td>
         <td><?php echo $fetch_cart['name']; ?></td>
         <td><?php echo $fetch_cart['phone']; ?></td>
         <td><?php echo $fetch_cart['area'].", ".$fetch_cart['city'].", ".$fetch_cart['state'].", PIN - ".$fetch_cart['pincode']; ?></td>
         <td><?php echo $fetch_cart['totalorder_price']; ?></td>
         <td><?php echo $fetch_cart['order_status']; ?></</td>
   <?php 
         if($fetch_cart['order_status'] =='Pending'){
   ?>
         
         <td><a href="myorder.php?remove=<?php echo $fetch_cart['order_id']; ?>" onclick="return confirm('Are you sure, you want to cancel your order?')" class="delete-btn">Cancel</a></td> 
   <?php
         }
         else
         {
   ?>

            <td></td>
   <?php
         
         }
   ?>
         
         <td>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $fetch_cart['order_id']; ?>"> 
            <button class="delete-btn" name = "details">Details</button>

            </form> 
         </td>
         

         
         <!-- <td><a href="wishlist.php?remove=<?php echo $fetch_cart['wishlist_id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> Remove</a></td> -->

      </tr>
   <?php
       
         }
      }
    }
   ?>
      

   </tbody>

</table>
<div class="checkout-btn">
<a href="index.php" class="option-btn" style="margin-top: 0;">continue shopping</a>
   </div>
</section>

</div>
<script src="Script\cart.js"></script>
</body>
</html>
