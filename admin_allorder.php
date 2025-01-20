<?php
session_start();
require("admin_header.php");
include('db.php');
if (!empty($_SESSION['admin_login'])) {

} else {
    header('location:login.php');
}
?>
<div class="content-box">
    <p>All order Details: </p>
    <br />
    <table class="table3">
        <tr>
            <th class="productID">ID</th>
            <th>Customer Name</th>
            <th>Mail ID</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Product_Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Payment Status</th>
            <th>Order Status</th>
            <th>Order Date</th>
        </tr>
    <?php
        $sql_allorder = "SELECT o.order_id,o.name,o.user_email,o.phone,o.order_status,o.payment_status,o.area,o.city,o.state,o.pincode,o.landmark,o.order_date,od.product_title,od.product_price,od.product_quantity from `order` o join orderdetails od on o.order_id = od.order_id ;" ;
        $data1= mysqli_query($conn, $sql_allorder);
        while ($row = mysqli_fetch_array($data1)) {

    ?>



        <tr>
            <td><?php echo $row['order_id'];  ?></td>
            <td><?php echo $row['name'];  ?></td>
            <td><?php echo $row['user_email'];  ?></td>
            <td><?php echo $row['area'].", ".$row['city'].", ".$row['state'].", PIN - ".$row['pincode'].", Landmark - ".$row['landmark'];  ?></td>
            <td><?php echo $row['phone'];  ?></td>
            <td><?php echo $row['product_title'];  ?></td>
            <td><?php echo $row['product_price'];  ?></td>
            <td><?php echo $row['product_quantity'];  ?></td>
            <td><?php echo $row['payment_status'];  ?></td>
            <td><?php echo $row['order_status'];  ?></td>
            <td><?php echo $row['order_date'];  ?></td>
            

        
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