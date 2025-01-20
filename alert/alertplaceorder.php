
<?php
require('Script\script.php');
if(isset($_SESSION['status_orderplaced'])&& $_SESSION['status_orderplaced'] != '')
{
    ?>
    <script>
        swal(
            "<?php echo $_SESSION['status_orderplaced']?>", 
            "Please click ok button", 
            "<?php echo $_SESSION['alert_orderplaced']?>");
    </script>
    <?php
    unset($_SESSION['status_orderplaced']);
    unset($_SESSION['alert_orderplaced']);
    
}


?>