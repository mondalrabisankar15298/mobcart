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
<h1 class="heading1">Wishlist</h1>

<table>

   <thead>
      <th>Image</th>
      <th>Title</th>
      <th>Details</th>
      <th>Price</th>
      <th>Product Details</th>
      <th>Action</th>
   </thead>

   <tbody>

      <?php 
      if(!empty($_SESSION['user_login'])){

        $user_email = $_SESSION['user_email']; 
      //   if(isset($_POST['update_update_btn'])){
      //    $update_value = $_POST['update_quantity'];
      //    $cart_id = $_POST['update_quantity_id'];
      //    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET product_quantity = '$update_value' WHERE cart_id = '$cart_id'");
      //    if($update_quantity_query){
      //       header('location:cart.php');
      //    };
      // };
      
      if(isset($_GET['remove'])){
         $remove_id = $_GET['remove'];
         mysqli_query($conn, "DELETE FROM `wishlist` WHERE `wishlist_id` = '$remove_id'");
         header('location:wishlist.php');
      }
      
      if(isset($_GET['delete_all'])){
         mysqli_query($conn, "DELETE FROM `wishlist` where user_email = '$user_email'");
         header('location:wishlist.php');
      }


      $select_cart = mysqli_query($conn, "SELECT * FROM `wishlist` left JOIN `product` ON wishlist.product_id = product.product_id WHERE user_email = '$user_email';");
     
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
      ?>

      <tr>
         <!-- <td><img src="./image/<?php echo $fetch_cart['image']; ?></td> -->
         <td><img src='./image/<?php echo $fetch_cart['product_image']; ?>' height='100' ></td>
         <td><?php echo $fetch_cart['product_title']; ?></td>
         <td><?php echo $fetch_cart['product_details']; ?></td>
         <td>$<?php echo number_format($fetch_cart['product_price']); ?>/-</td>
         
         <td>
         <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $fetch_cart['product_id']; ?>"> 
            <button class="delete-btn" name = "details">Details</button>

         </form>

         </td>
         <td><a href="wishlist.php?remove=<?php echo $fetch_cart['wishlist_id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> Remove</a></td>

      </tr>
      <?php
       
         }
      }
    }
      ?>
      <tr class="table-bottom">
         <td><a href="index.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
         <td colspan="4"></td>
         
         <td><a href="wishlist.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
      </tr>

   </tbody>

</table>

</section>

</div>
<script src="Script\cart.js"></script>
</body>
</html>
