<?php
require('header.php');
include('db.php');

?>
<div class="container5">

<section class="shopping-cart">
<h1 class="heading1">shopping cart</h1>

<table>

   <thead>
      <th>Image</th>
      <th>Title</th>
      <th>Details</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Total Price</th>
      <th>Action</th>
   </thead>

   <tbody>

      <?php 
      if(!empty($_SESSION['user_login'])){

        $user_email = $_SESSION['user_email']; 
        if(isset($_POST['update_update_btn'])){
         $update_value = $_POST['update_quantity'];
         $cart_id = $_POST['update_quantity_id'];
         $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET product_quantity = '$update_value' WHERE cart_id = '$cart_id'");
         if($update_quantity_query){
            header('location:cart.php');
         };
      };
      
      if(isset($_GET['remove'])){
         $remove_id = $_GET['remove'];
         mysqli_query($conn, "DELETE FROM `cart` WHERE cart_id = '$remove_id'");
         header('location:cart.php');
      };
      
      if(isset($_GET['delete_all'])){
         mysqli_query($conn, "DELETE FROM `cart` where user_email = '$user_email'");
         header('location:cart.php');
      }
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_email = '$user_email'");
      $grand_total = 0;
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
            <form action="" method="post">
               <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['cart_id']; ?>" >
               <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['product_quantity']; ?>" >
               <input type="submit" value="update" name="update_update_btn">
            </form>   
         </td>
         <!-- <td>$<?php echo $sub_total = number_format($fetch_cart['product_price'] * $fetch_cart['product_quantity']); ?>/-</td> -->
         <td>$<?php echo $sub_total =($fetch_cart['product_price'] * $fetch_cart['product_quantity']); ?>/-</td>
         <td><a href="cart.php?remove=<?php echo $fetch_cart['cart_id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> Remove</a></td>
      </tr>
      <?php
        $grand_total += $sub_total;  
         }
      }
    }
    else{
      header('location:login.php');
    }
      ?>
      <tr class="table-bottom">
         <td><a href="index.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
         <td colspan="3"></td>
         <td>grand total</td>
         <td>$<?php echo $grand_total; ?>/-</td>
         <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
      </tr>

   </tbody>

</table>
<div class="checkout-btn">
      <a href="placeorder.php?total=<?php echo $grand_total;?>" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>
</section>

</div>
<script src="Script\cart.js"></script>
</body>
</html>
