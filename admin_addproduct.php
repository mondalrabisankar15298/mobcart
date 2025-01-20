<?php
session_start();
include('db.php');
include('functions.php');
if (!empty($_SESSION['admin_login'])) {

} else {
    header('location:login.php');
}
$empmsg_price = $empmsg_details = $empmsg_title = $empmsg_more_details = $empmsg_file = "";
if (isset($_POST['upload'])) {
    $file = $_FILES['uploadfile'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;
    $title = $_POST['title'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $details = $_POST['details'];
    $more_details = $_POST['more_details'];

    if(!validatePrice($price)){
        $empmsg_price = "Please enter a valid price.";
    }
    if(!(product_title_validation($title) == "accepted")){
        $empmsg_title = product_title_validation($title);
    }
    if(!(product_detail_validation($details)=="accepted")){
        $empmsg_details = product_detail_validation($details);
    }
    if(!(product_more_detail_validation($more_details)=="accepted")){
        $empmsg_more_details = product_more_detail_validation($more_details);
    }
    if(!(file_validation($file) == "accepted")){
        $empmsg_file = file_validation($file);
    }


if(validatePrice($price)&&(product_title_validation($title)=="accepted") && (product_detail_validation($details)=="accepted") && (product_more_detail_validation($more_details)=="accepted") && (file_validation($file)=="accepted")){

    //$sql = "INSERT INTO `product` (`product_type`, `product_title`, `product_details`, `product_more_details`, `product_price`, `product_image`,) VALUES ('hello', '$title', '$details', '$more_details', '$price', '$filename');";
    $query = "INSERT INTO `product` (`product_id`, `product_type`, `product_title`, `product_details`, `product_more_details`, `product_price`, `product_image`, `product_date`) VALUES (NULL, '$type', '$title', '$details', '$more_details', '$price', '$filename', current_timestamp());";
    $ABC = mysqli_query($conn, $query);
    if ($ABC == true) {
        if (move_uploaded_file($tempname, $folder)) {
            // $_SESSION['statusaddproduct'] = 'Product Add Successfully';
            // $_SESSION['alertaddproduct'] = 'success';
            $message[] = "Product Added Successfully";
            header("refresh:3");
        } else {
            // $_SESSION['statusaddproduct'] = 'Product Add Failed';
            // $_SESSION['alertaddproduct'] = 'error';
            $message[] = "Product Added Failed";
            header("refresh:3");
        }
    }
}

}



?>



<?php
require("admin_header.php");

?>

<div id="main">
    <?php

    if (isset($message)) {
        // header("refresh:0");
        foreach ($message as $message) {
            echo '<div class="message2"><span>' . $message . '</span> <i class= "fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        }

    }
    ?>
    <div class="addprod_form">
        <form action="admin_addproduct.php" method="POST" enctype="multipart/form-data">
            <h3>Add Product details</h3>
            
            <label for="title">Title:</label>
            <input type="text" placeholder="Title" id="title" name="title" value ="<?php if(isset($_POST['upload'])) { echo $title;} ?>  " required>
            
            <div id= "error"><?php if(isset($_POST['upload'])) { echo $empmsg_title ;}    ?> </div>
            
            <label for="price">Price:</label>
            <input type="text" placeholder="Price" id="price" name="price" value ="<?php if(isset($_POST['upload'])) { echo $price;} ?>  " required>
           
           <div id="error"> <?php if(isset($_POST['upload'])) { echo $empmsg_price;}    ?> </div>

            <label for="type">Product Category:</label>
            <select name="type">
                <option value="Phone">Phone</option>
                <option value="Tablet">Tablet</option>
                <option value="Accessories">Accessories</option>

            </select><br>

            <label for="details">Details:</label>
            <input type="text" placeholder="Details" id="details" name="details" value ="<?php if(isset($_POST['upload'])) { echo $details;}    ?>  " required>
            <div id="error"> <?php if(isset($_POST['upload'])) { echo $empmsg_details ;}    ?></div>

            <label for="moredetails">More details:</label>
            <textarea name="more_details" id="more_details" required><?php if(isset($_POST['upload'])) { echo $more_details;}    ?> </textarea> 
            <div id="error"> <?php if(isset($_POST['upload'])) { echo $empmsg_more_details ;}    ?></div>

            <label for="file">Upload Picture:</label>
            <input type="file" id="file" name="uploadfile" required>
            <div id="error">  <?php if(isset($_POST['upload'])) { echo $empmsg_file ;}    ?>    </div><br>

            <button type="submit" name="upload">Submit</button>
        </form>




    </div>

</div>

<?php
require("admin_footer.php");
?>


</body>

</html>

<?php

// include('alert\alertaddproduct.php');
?>