<?php
    if(!isset($_SESSION['user'])){
        $_SESSION['no-login-message']= "<div class='error text-center err' style='margin-top:10%'>Please Login to Access Admin Panel</div>";
        header('location:'.HOMEURL.'admin/login.php'); 
    }
?>