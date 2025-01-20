<?php
require('header.php');
include('db.php');
if(empty($_SESSION['product_id'])){
    header('location:login.php');
}
if(isset($_POST['addtocart'])){
    if(!empty($_SESSION['user_login'])){

        $user_email = $_SESSION['user_email'];  
    
        
    
    $product_id = $_POST['product_id'];
    $product_type = $_POST['product_type'];
    $product_title = $_POST['product_title'];
    $product_details = $_POST['product_details'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['quantity'];
    $product_image = $_POST['product_image'];
    // $current_user_email = $_SESSION['user_email'];

    $select_cart = mysqli_query($conn,"SELECT * FROM cart where product_id = '$product_id' and user_email = '$user_email' ");
    $sql = "INSERT INTO `cart` (`cart_id`, `product_id`, `user_email`, `product_title`, `product_price`, `product_details`, `product_image`, `product_quantity`) VALUES (NULL, '$product_id', '$user_email', '$product_title', '$product_price', '$product_details', '$product_image', '$product_quantity')";
    if(mysqli_num_rows($select_cart)>0){
        $message3[] = "Product already added to cart";
        header("refresh:2");
    }
    else{
        $insert_product = mysqli_query($conn,$sql);
        $message3[]= "Product added to cart successfully";
        header("refresh:2");
        
    }
    }

    

    else{
      
        header('location:login.php');
    }
}
if(isset($_POST['addtowishlist'])){
    if(!empty($_SESSION['user_login'])){

        $user_email = $_SESSION['user_email'];     
    $product_id = $_POST['product_id'];
    $select_wishlist = mysqli_query($conn,"SELECT * FROM wishlist where product_id = '$product_id' and user_email = '$user_email' ");
    $sql = "INSERT INTO `wishlist` (`wishlist_id`, `user_email`, `product_id` ) VALUES (NULL,'$user_email', '$product_id')";
    // $insert_wishlist = mysqli_query($conn,$sql);
    // if($insert_wishlist){
    //     $message3[] = 
    // }
    if(mysqli_num_rows($select_wishlist)>0){
        $message3[] = "Product already added to wishlist";
        header("refresh:2");
    }
    else{
        $insert_product = mysqli_query($conn,$sql);
        $message3[]= "Product added to wishlist successfully";
        header("refresh:2");
        
    }


}
else{
      
    header('location:login.php');
}

}

?>
<?php

if(isset($message3)){
    // header("refresh:0");
    foreach($message3 as $message3){
       echo '<div class="message"><span>'.$message3.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    }
    
 }
?>
<section>
        <div class="small-container single-product">
            <?php
            
                $newproduct_id = $_SESSION['product_id'] ;
                // unset($_SESSION['product_id']);
            
                $data = mysqli_query($conn,"SELECT * from `product` where product_id = $newproduct_id ");
                while($row = mysqli_fetch_array($data)){

                
            ?>
            <div class="row">
                <div class="col-2">
                <?php  echo '<img src = "./image/'.$row['product_image'].' " alt="" width="100%" max-height= "550px">';?>
                </div>
                <div class="col-2">
                <?php echo '<h2>'.$row['product_title'].'</h2><br><br>'?>
                
                <?php echo '<h2>'.$row['product_details'].'</h2><br><br>'?>
                   
                    <?php echo '<small> Price: '.$row['product_price'].'</small>'?>
                   
                       <?php echo '<p>'.$row['product_more_details'].'</p>'?>
                    <div class="order">
                        <!-- <select>
                            <option>Select Quantity</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select> -->
                        <form action = "" method="POST" >
                        <div class="input-field">
                        <!-- <input type="number" placeholder="Quantity" name="user_email" min="1" > -->
                        <!-- <label for="type">Product Category:</label> -->
                        <div class="order">
                        <small>Quantity:    </small>
                        <select id = "quantity" name="quantity" >
                                <option value="1">1</option>
                               <option value="2">2</option>
                               <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                        </select>
                    
                    </div>
                        <i class="uil uil-envelope icon"></i>
                        
                        </div>
                        <div class="button_product">
                            
                        <button class="button-27" role="button" name = "addtocart">Add To Cart</button>
                        <button class="button-28" role="button" name = "addtowishlist">Add to Wishlist</button>
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"> 
                        <input type="hidden" name="product_type" value="<?php echo $row['product_type']; ?>"> 
                        <input type="hidden" name="product_title" value="<?php echo $row['product_title']; ?>"> 
                        <input type="hidden" name="product_details" value="<?php echo $row['product_details']; ?>"> 
                        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"> 
                        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"> 
                        

                        </div>

                            <!-- <input type="submit" class="btn1" value="Add To Cart" name = "add_to_cart">
                            <input type="submit" class="btn1" value="Add To Wishlist" name = "wishlist"> -->
                            
                        </form>




                        <!-- <a href="#" class="btn">Add To Cart</a> -->
                    </div>
                    
                    <div class="other-details">
                        <h4>Product Code: <span>4112</span></h4>
                        
                        
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        </div>

        <!-- RELATED PRODUCTS -->
        <div class="medium-container">
            <div class="row row-2">
                <h2>Related Products</h2>
                <a href="../shop.html" class="view-more">View More</a>
            </div>
            <div class="row">
                <div class="col-4">
                    <a href="tea-kettle.html">
                        <img src="../images/shop-2.jpg">
                        <h4>Tea Kettle</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>$15</p>
                    </a>
                </div>
                <div class="col-4">
                    <a href="desk-decor.html">
                        <img src="../images/shop-3.jpg">
                        <h4>Desk Decor</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half"></i>
                        </div>
                        <p>$15</p>
                    </a>
                </div>
                <div class="col-4">
                    <a href="wall-paint.html">
                        <img src="../images/shop-4.jpg">
                        <h4>Wall Paint</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>$15</p>
                    </a>
                </div>
                <div class="col-4">
                    <a href="comfy-chair.html">
                        <img src="../images/shop-5.jpg">
                        <h4>Comfy Chair</h4>
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>$15</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php
    require('footer.php');

   
   
    ?>