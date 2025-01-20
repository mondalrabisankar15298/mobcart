<?php
// session_start();
require('header.php');
if(isset($_POST['details'])){
    $_SESSION['product_id'] = $_POST['product_id'];
    if($_SESSION['product_id'] != ""){
        header('location:product_details.php');
    }
}

?>
    <div class="hero">
            <div class="row">
                <div class="hero-info">
                    <h5 class="smartPhone">SmartPhone</p>
                        <h1>New Phone <br>Launch 2023</h1>
                        <p>Experience the world at your fingertips! Work, socialise, book a ride, play games, listen to music,
                           your favourite shows,take a photo, or simply make a call! Buy a Mobile Phone from MobCart</p>
                        <a href="phone.php" class="btn">Explore Now</a>
                </div>
                <div class="hero-image">
                    <img src="images/hero-image.png">
                </div>
            </div>
        </div>
    <!-- FEATURED CATEGORIES -->

    <!-- <section class="categories">
        <div class="small-container">
            <div class="row">
                <div class="col-3"></div>
                    <img src="images/category-1.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-2.jpg">
                </div>
                <div class="col-3">
                    <img src="images/category-3.jpg">
                </div>
            </div>
        </div>
    </section> -->
        <!-- FEATURED PRODUCTS -->

        <section class="featured">
        <h2 class="title">Featured Products</h2>
        <div class="medium-container">
            
            <div class="row">
            <?php
                
                $data = mysqli_query($conn,"SELECT * FROM `product` WHERE product_id in (SELECT min(product_id) FROM product GROUP by product_type );");
                while($row = mysqli_fetch_array($data)){
                    $cart = $row['product_id'];
                    
                
                    ?>
                <div class="col-4">
                    <a href="#">
                <?php  echo '<img src = "./image/'.$row['product_image'].' " alt = " "  /> '; ?>

                <?php echo '<h4>'.$row['product_title'].'</h4>'?>
                

                
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php echo '<h4>RS '.$row['product_price'].'</h4>'?>
                    </a>
                </div>
                <?php
                }
                ?>
                
            
                
            </div>
        </div>
    </section>

    <!-- LASTEST PRODUCTS -->

    <!-- <section class="latest-products">
        <small>Latest Collection</small>
        <h2 class="title">TRENDING PRODUCTS</h2>
        <div class="medium-container">
        <?php
                $r = 0;
                $data = mysqli_query($conn,"SELECT * FROM `product`");
                while($row = mysqli_fetch_array($data)){
                    if($r%4 == 0){
         ?>
                    <div class="row">
        <?php
                    }
                    
                
        ?>

            <div class="col-4">
                    <a href="#">
                <?php  echo '<img src = "./image/'.$row['product_image'].' " alt = " "  /> '; ?>

                <?php echo '<h4>'.$row['product_title'].'</h4>'?>
                
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <?php echo '<h4>RS '.$row['product_price'].'</h4>'?>
                    </a>
                </div>
        <?php
               if($r%4==3){
        ?>
            </div>
        <?php
               }
            $r++;
        }


        ?>
           
        </div>
        </div>
    </section> -->
    
    <section id="product1" class="section-p1">
        <small>Latest Collection</small>
        <h2 class="title">TRENDING PRODUCTS</h2>
        <!-- <h2>Featured Products</h2>
        <p>Latest Collection New Modern Design</p> -->
        <div class="pro-container">

        <?php
        $data = mysqli_query($conn,"SELECT * FROM `product`");
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
    <!-- OFFER SECTION -->

    

    <section class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="images/single.png" class="offer-image">
                </div>
                <div class="col-2">
                    <h3>Lenevo Tab P12 Pro</h3>
                    <small>₹ 65,999.00</small>
                    <p>
                        The Lenovo Tab P12 Pro is a productivity powerhouse that's built for use outdoors and indoors, 
                        with an all-day battery and bright 12.6" 2K AMOLED display. 
                    </p>
                    <a href="tablet.php" class="btn">Explore</a>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL -->

    <section class="testimonials">
        <div class="small-container">
            <div class="row">
                <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p>Everything went smoothly.Mobcart service was quick to respond to my query, 
                       the cell phone arrived in about 6 days, in the condition as advertised. I recommend 
                       this shop</p>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </div>
                    <img src="images/user-1.png">
                    <h3>Tom Harry</h3>
                </div>
                <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p>I got what I ordered. Phone new, packed, without flaws. Fast shipment.
                       This was my third order and again I have nothing to complain about..</p>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </div>
                    <img src="images/user-2.png">
                    <h3>John Doe</h3>
                </div>
                <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p>Excellent price of the device, after the purchase they contacted me by phone 
                       and informed me that the device will arrive in 4 to 6 working days. Of course 
                       it came on time. .</p>
                    <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half"></i>
                    </div>
                    <img src="images/user-3.png">
                    <h3>Jane Doe</h3>
                </div>
            </div>
        </div>
    </section>







    <?php
    require('footer.php');
 
    include('alert\alert.php');
    include('alert/alertplaceorder.php'); 
   
    ?>