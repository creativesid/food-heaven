<?php

    include('../config/constant.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        // echo "Get value";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name!== ""){
            $path = "../images/category/".$image_name;
            $remove = unlink($path);
            if($remove==false){
                $_SESSION['remove'] = '<div class="error">Failed to remove</div>';
                header('location:'.HOMEURL.'admin/manage-category.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_category WHERE id=$id";
        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['delete']= '<div class="success">Category Deleted Successfully.</div>';
            header('location:'.HOMEURL.'admin/manage-category.php');
        }else{
            $_SESSION['delete']= '<div class="error">Failed to Deleted Category.</div>';
            header('location:'.HOMEURL.'admin/manage-category.php');
        }
    }else{
        header('location:'.HOMEURL.'admin/manage-category.php');
    }

?>