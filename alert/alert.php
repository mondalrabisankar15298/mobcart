
<?php

require('Script\script.php');
if(isset($_SESSION['status'])&& $_SESSION['status'] != '')
{
    ?>
    <script>
        swal(
            "<?php echo $_SESSION['status']?>", 
            "Please click ok button", 
            "<?php echo $_SESSION['alert']?>");
    </script>
    <?php
    unset($_SESSION['status']);
    unset($_SESSION['alert']);

}


?>