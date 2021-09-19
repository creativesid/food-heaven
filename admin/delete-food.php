<?php

    include('../config/constant.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])){
        // echo "Get value";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name!== ""){
            $path = "../images/food/".$image_name;
            $remove = unlink($path);
            if($remove==false){
                $_SESSION['remove'] = '<div class="error">Failed to remove</div>';
                header('location:'.HOMEURL.'admin/manage-food.php');
                die();
            }
        }

        $sql = "DELETE FROM tbl_food WHERE id=$id";
        $res = mysqli_query($conn,$sql);

        if($res==true){
            $_SESSION['delete']= '<div class="success">food Deleted Successfully.</div>';
            header('location:'.HOMEURL.'admin/manage-food.php');
        }else{
            $_SESSION['delete']= '<div class="error">Failed to Deleted food.</div>';
            header('location:'.HOMEURL.'admin/manage-food.php');
        }
    }else{
        header('location:'.HOMEURL.'admin/manage-food.php');
    }

?>