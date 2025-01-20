

<?php
require('header.php');

if(isset($_POST['details'])){
    $_SESSION['product_id'] = $_POST['product_id'];
    if($_SESSION['product_id'] != ""){
        header('location:product_details.php');
    }
}

?>
 <section id="product1" class="section-p1">
        <!-- <small>Latest Collection</small> -->
        <h2 class="title">PHONES COLLECTION</h2>
        <!-- <h2>Featured Products</h2>
        <p>Latest Collection New Modern Design</p> -->
        <div class="pro-container">

        <?php
        $data = mysqli_query($conn,"SELECT * FROM `product` where product_type = 'phone'");
        while($row = mysqli_fetch_array($data)){

            ?>
             
            <div class="pro">
            
              
            <?php  echo '<img src = "./image/'.$row['product_image'].' " alt = " "  /> '; ?>
                
                <div class="des">
               
                    <?php echo '<h5>'.$row['product_title'].'</h5>' ?>
                    <?php echo '<h4>'.$row['product_details'].'</h4>' ?>
                    <!-- <span>Silk Saree</span> -->
                    <!-- <h5>Red Maroon Silk Saree</h5> -->
                    <!-- <div class="star">
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                       <i class="fas fa-star"></i>
                    </div> -->
                    <?php echo '<h4>Rs - '.$row['product_price'].' /-</h4>' 
                    
                    ?>
                    <!-- <h4>Rs 1200</h4> -->
                </div>
                <!-- <i method = "POST" name = "addtocart" class="fal fa-shopping-cart cart"></i> -->
                <!-- <form action="" method="POST" > -->
                <!-- <button  name = "<?php echo $cart;?>" class="btn"><i class="fal fa-shopping-cart cart"></i></button> -->
                <!-- <input type="hidden" name="product_title" value="<?php echo $row['title']; ?>">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <input type="hidden" name="product_details" value="<?php echo $row['details']; ?>">
                <input type="hidden" name="product_price"value="<?php echo $row['price']; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                <input type="submit" class="btn" value="add to cart" name="add_to_cart">
    
                </form> -->
                <form action="" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                     <input type="submit" class="btn" value="Details" name="details">
                </form>
            </div>  
            
        <?php
           
           
            
        }


        ?>
        </div>
    </section>





<?php
require('footer.php');

?>