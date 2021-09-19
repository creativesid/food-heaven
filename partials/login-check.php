<?php
    if(!isset($_SESSION['email'])){
        $_SESSION['no-login-message']= "<div class='error text-center' style='margin-top:10%'>Please Login to Order Something</div>";
        header('location:'.HOMEURL.'login.php');
    }
?>