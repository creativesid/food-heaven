<?php 

    include('../config/constant.php');

    $id = $_GET['id'];
    //sql query to delete
    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn,$sql);
    if($res==TRUE){
        $_SESSION['delete'] = "<div class='success'>Admin deleted</div>";
        header("location:".HOMEURL.'admin/manage-admin.php');
    }else{
        $_SESSION['delete'] = "<div class='success'>Failed to delete</div>";
        header("location:".HOMEURL.'admin/manage-admin.php');
    }

?>