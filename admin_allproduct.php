<?php
session_start();
require("admin_header.php");
?>

<?php

include('db.php');
if (!empty($_SESSION['admin_login'])) {

} else {
    header('location:login.php');
}
if (isset($_GET['remove'])) {
    $delete_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `product` WHERE product_id = '$delete_id'");
    header('location:admin_allproduct.php');
}

if (isset($_POST['Edit'])) {
    $_SESSION['edit_productid'] = $_POST['product_id'];
    header('location:admin_productedit.php');


}


?>




div>
<div class="content-box">
    <p>All Products : </p>
    <br />
    <table class="table2">
        <tr>
            <th class="productID">ID</th>
            <th>Type</th>
            <th>Title</th>
            <th>Details</th>
            <th>More Details</th>
            <th>Price</th>
            <th>Image</th>
            <th>Update</th>
            <th>Action</th>
        </tr>
        <?php
        $data = mysqli_query($conn, "SELECT * FROM `product`");
        while ($row = mysqli_fetch_array($data)) {

            ?>


            <tr>

                <td>
                    <?php echo $row['product_id']; ?>
                </td>
                <td>
                    <?php echo $row['product_type']; ?>
                </td>
                <td>
                    <?php echo $row['product_title']; ?>
                </td>
                <td>
                    <?php echo $row['product_details']; ?>
                </td>
                <td>
                    <?php echo $row['product_more_details']; ?>
                </td>
                <td>
                    <?php echo $row['product_price']; ?>
                </td>
                <td>
                    <?php echo '<img src = "./image/' . $row['product_image'] . ' " alt = " " height = "100px" width = "100px"  /> '; ?>
                </td>

                <td>
                    <form action="" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                        <button class="custom-button" name="Edit">Edit</button>

                    </form>
                </td>
                <td>
                    <a href="admin_allproduct.php?remove=<?php echo $row['product_id']; ?>"
                        onclick="return confirm('remove item from cart?')" class="custom-button">Delete</a>
                    <!-- <button class="custom-button">Delete</button> -->

                </td>

            </tr>

            <?php
        }

        ?>



    </table>
</div>


<?php
require("admin_footer.php");
?>



</body>

</html>