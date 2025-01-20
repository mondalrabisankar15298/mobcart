<?php
session_start();
include('db.php');
if(!empty($_SESSION['admin_login'])){

}
else{
    header('location:login.php');
}
if(isset($_POST['upload'])) {
    $filename= $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/".$filename;
    $title = $_POST['title'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $details = $_POST['details'];
    $more_details = $_POST['more_details'];

    //$sql = "INSERT INTO `product` (`product_type`, `product_title`, `product_details`, `product_more_details`, `product_price`, `product_image`,) VALUES ('hello', '$title', '$details', '$more_details', '$price', '$filename');";
    $query = "INSERT INTO `product` (`product_id`, `product_type`, `product_title`, `product_details`, `product_more_details`, `product_price`, `product_image`, `product_date`) VALUES (NULL, '$type', '$title', '$details', '$more_details', '$price', '$filename', current_timestamp());";
    $ABC = mysqli_query($conn,$query);
    if($ABC == true){
        if(move_uploaded_file($tempname,$folder)){
            $_SESSION['statusaddproduct'] = 'Product Add Successfully';
            $_SESSION['alertaddproduct'] = 'success';
            echo 'success';
        }
        else {
            $_SESSION['statusaddproduct'] = 'Product Add Failed';
            $_SESSION['alertaddproduct'] = 'error';
            echo 'failed';
        }
    }
    else{
        echo "fail";
    }
} 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div id="mySidenav" class="sidenav">
        <p class="logo"><span>M</span>SOFTtECH</p>
        <a href="home.html" class="icon-a"><i class="fa fa-dashboard icons"></i>
            &nbsp;&nbsp;Home</a>
        <a href="addproduct.html" class="icon-a"><i class="fa fa-users icons"></i>
            &nbsp;&nbsp;Add Product</a>
        <a href="allproduct.html" class="icon-a"><i class="fa fa-list icons"></i>
            &nbsp;&nbsp;All Product</a>
        <a href="allorder.html" class="icon-a"><i class="fa fa-shopping-bag icons"></i>
            &nbsp;&nbsp;All Order</a>

    </div>
    <div id="main">
        <div class="addprod_form">
    <form action="admin_dashboard.php" method="POST" enctype="multipart/form-data">
        <h3>Add Product details</h3>

        <label for="title">Title:</label>
        <input type="text" placeholder="Title" id="title" name="title"><br><br>
  
        <label for="price">Price:</label>
        <input type="text" placeholder="Price" id="price" name="price"><br><br>

        <label for="type">Product Category:</label>
        <select name="type">
            <option value="Phone">Phone</option>
            <option value="Tablet">Tablet</option>
            <option value="Accessories">Accessories</option>
            <option value="Others">Others</option>
        </select><br><br>

        <label for="details">Details:</label>
        <input type="text" placeholder="Details" id="details" name="details"><br><br>
  
        <label for="moredetails">More details:</label>
        <textarea name="more_details"></textarea> <br><br>
        <!-- <input type="text" id="field3" name="field3"><br><br> -->
  
        <label for="file">Upload Picture:</label>
        <input type="file" id="file" name="uploadfile"><br><br>
  
        <button type="submit" name = "upload">Submit</button>
      </form>




    </div>
    
    </div>
</body>
</html>
<?php
include('alert\alert.php');  
include('alert\alertaddproduct.php');
?>