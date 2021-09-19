<?php

    session_start();
    include 'config/constant.php';

    if(isset($_GET['token'])){
        $token = $_GET['token'];
        $updateQuery = "UPDATE tbl_usr_reg SET status='active' WHERE token='$token'";

        $res = mysqli_query($conn,$updateQuery);
        if($res){
            if(isset($_SESSION['msg'])){
                $_SESSION['msg'] = "Acccount activated successfully <br/> Login to place order.";
                header("location:".HOMEURL.'/login.php');
            }else{
                $_SESSION['msg'] = "You are logged out.";
                header("location:".HOMEURL.'/login.php');
            }
        }else{
            $_SESSION['msg'] = "Acccount not veryfied";
            header("location:".HOMEURL.'/register.php');
        }
    }

?>