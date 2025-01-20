<?php
require("admin_header.php");

?>
<?php
session_start();
include('db.php');
if (!empty($_SESSION['admin_login'])) {

} else {
    header('location:login.php');
}

if(isset($_POST['submit'])){
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $sql = "UPDATE `order` SET order_status = '$order_status' WHERE order_id = '$order_id'";
    $update = mysqli_query($conn,$sql);
    if($update){
        header('location:admin_orderstatus.php');
    }

}


?>
<div class="content-box">
    <p>Order Status Details : </p>
    <br />
    <table class="table1">
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Payment Status</th>
            <th>Price</th>
            <th>Order Status</th>
            <th>Update</th>
        </tr>

        <?php
        $sql_order = "SELECT o.order_id,o.name,o.order_status,o.payment_status,od.product_title,od.product_price,od.product_quantity from `order` o join orderdetails od on o.order_id = od.order_id where o.order_status <> 'Delivered' ;" ;
        $data = mysqli_query($conn, $sql_order);
        while ($row = mysqli_fetch_array($data)) {

            ?>


        <tr>
            <td><?php echo $row['order_id']?></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['product_title']?></td>
            <td><?php echo $row['product_quantity']?></td>
            <td><?php echo $row['payment_status']?></td>
            <td><?php echo $row['product_price']?></td>
            
            
            <form action="" method="POST" >
                <input type="hidden" name = "order_id" value="<?php echo $row['order_id'];?>" >
                <td>
                    <select name="order_status">
                        <option value="<?php echo $row['order_status'] ; ?>"><?php echo $row['order_status'] ; ?></option>
                        <option value="Pending">Pending</option>
                        <option value="Confirmed">Confirmed</option>
                        <option value="Shipped">Shipped</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </td>
                <td>
                    <button class="custom-button" name = "submit">Submit</button>
                </td>
            </form>
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