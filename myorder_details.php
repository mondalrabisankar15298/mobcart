<?php

require('header.php');
include('db.php');

if(!empty($_SESSION['user_login'])){
}
else{
   header('location:login.php');
}

if(isset($_POST['details'])){
   $_SESSION['product_id'] = $_POST['product_id'];
   if($_SESSION['product_id'] != ""){
       header('location:product_details.php');
   }


}



?>
<div class="container5">

<section class="shopping-cart">
<h1 class="heading1">Order Details</h1></h1>

<table>

   <thead>
    <th>Order Id</th>
      <th>Image</th>
      <th>Title</th>
      <th>Details</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Total Price</th>

      <th>Action</th>
   </thead>

   <tbody>

      <?php 
      if(!empty($_SESSION['user_login'])){
        if(empty($_SESSION['order_id'])){
            header('location:myorder.php');
        }
        else{

        $user_email = $_SESSION['user_email'];
        $order_id = $_SESSION['order_id'];
        $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `orderdetails` WHERE order_id = '$order_id';");
     
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
      ?>

      <tr>
        <td><?php echo $fetch_cart['order_id']; ?></td>
         <td><img src='./image/<?php echo $fetch_cart['product_image']; ?>' height='100' ></td>
         <td><?php echo $fetch_cart['product_title']; ?></td>
         <td><?php echo $fetch_cart['product_details']; ?></td>
         <td><?php echo $fetch_cart['product_quantity']; ?></td>
         <td>$<?php echo number_format($fetch_cart['product_price']); ?>/-</td>
         <td>$<?php echo $sub_total =($fetch_cart['product_price'] * $fetch_cart['product_quantity']); ?>/-</td>
         
         <td>
         <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $fetch_cart['product_id']; ?>"> 
            <button class="delete-btn" name = "details">Details</button>

         </form>

         </td>
         
      </tr>
      <?php
        $grand_total += $sub_total; 
         }
      }
    }
    }
      ?>
      <tr class="table-bottom">
         <td colspan="5"></td>
         <td>grand total</td>
         <td>$<?php echo $grand_total; ?>/-</td>
         <td></td>
         <!-- <td><a href="wishlist.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td> -->
      </tr>

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
