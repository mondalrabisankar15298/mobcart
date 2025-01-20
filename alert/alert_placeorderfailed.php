
<?php
require('Script\script.php');
if(isset($_SESSION['status_orderplaced1'])&& $_SESSION['status_orderplaced1'] != '')
{
    ?>
    <script>
        swal(
            "<?php echo $_SESSION['status_orderplaced1']?>", 
            "Please click ok button", 
            "<?php echo $_SESSION['alert_orderplaced1']?>");
    </script>
    <?php
    unset($_SESSION['status_orderplaced1']);
    unset($_SESSION['alert_orderplaced1']);
    
}


?>