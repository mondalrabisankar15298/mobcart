<!-- <script src = "https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
<?php

require('Script\script.php');
if(isset($_SESSION['status1'])&& $_SESSION['status1'] != '')
{   echo "hehe";
    ?>
    <script>
        swal(
            "<?php echo $_SESSION['status1']?>", 
            "Please click ok button", 
            "<?php echo $_SESSION['alert1']?>");
    </script>
    <?php
    unset($_SESSION['status1']);
    unset($_SESSION['alert1']);

}


?>