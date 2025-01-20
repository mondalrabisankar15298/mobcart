<?php
session_start();
include('db.php');
$totalUsers = $total_order = $total_revenue = $due_order = $due_revenue= $successful_order=0;
if (!empty($_SESSION['admin_login'])) {

} else {
    header('location:login.php');
}

$query = "SELECT COUNT(*) as total_users FROM users";
$result = $conn->query($query);
$row = $result->fetch_assoc();
$totalUsers = $row['total_users'];

$query1 = "SELECT SUM(totalorder_price) as total_revenue, count(order_id) as total_orders from `order` where order_status<>'Pending'";
$result1 = $conn->query($query1);


$row1 = $result1->fetch_assoc();
$total_revenue = $row1['total_revenue'];
$total_order = $row1['total_orders'];
if($total_revenue == null){
    $total_revenue = 0;
}

$query2 = "SELECT SUM(totalorder_price) as due_revenue, count(order_id) as due_orders from `order` where order_status ='Pending'";
$result2 = $conn->query($query2);
$row2 = $result2->fetch_assoc();
$due_revenue = $row2['due_revenue'];
$due_order = $row2['due_orders'];

if($due_revenue == null){
    $due_revenue = 0;
}

$query3 = "SELECT count(order_id) as successful_orders from `order` where order_status ='Delivered'";
$result3 = $conn->query($query3);
$row3 = $result3->fetch_assoc();
$successful_order = $row3['successful_orders'];



?>





<?php
require("admin_header.php");
?>

<div id="main">
    <div class="head">
        <h1>Dashboard :</h1>

    </div><br />
    <div class="valueboxes">
        <div class="col-div-4">
            <div class="box-customer">
                <p><?php  echo $totalUsers;?> <br /><span>Customers</span></p>
                <i class="fa fa-users box-icon"></i>
            </div>
        </div>
        <div class="col-div-4">
            <div class="box-revenue">
                <p><?php  echo $total_revenue;?> <br /><span>Total Revenue</span></p>
                <i class="fa fa-money box-icon"></i>
            </div>
        </div>
        <div class="col-div-4">
            <div class="box-orders">
                <p><?php  echo $total_order;?> <br /><span class="orders-icon">Orders Accepted</span></p>
                <i class="fa fa-shopping-bag box-icon"></i>
            </div>
        </div>
        <div class="col-div-4">
            <div class="box-pending">
                <p><?php  echo $due_order;?> <br /><span>Orders Pending</span></p>
                <i class="fa fa-shopping-bag box-icon"></i>
            </div>
        </div>
        <div class="col-div-4">
            <div class="box-due">
                <p><?php  echo $due_revenue;   ?>  <br /><span>Due Sales</span></p>
                <i class="fa fa-money box-icon"></i>
            </div>
        </div>
        <div class="col-div-4">
            <div class="box-due">
                <p><?php  echo $successful_order;   ?>  <br /><span>Successful Orders</span></p>
                <i class="fa fa-shopping-bag box-icon"></i>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <br /><br />
</div>
<div class="clearfix"></div>
</div>




<?php
    require("admin_footer.php");
?>


</body>

</html>
<?php
include('alert\alert.php');

?>