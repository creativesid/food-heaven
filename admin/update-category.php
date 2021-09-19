<?php include('partials/menu.php') ; ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1> <br> <br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                
                $sql = "SELECT * FROM tbl_category WHERE id=$id";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count==1){
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }else{
                    $_SESSION['no-category']= '<div class="success">Category Not Found.</div>';
                    header('location:'.HOMEURL.'admin/manage-category.php');
                }

            }else{
                header('location:'.HOMEURL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title"  value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image!=""){
                                ?>
                                <img src="<?php echo HOMEURL;?>images/category/<?php echo $current_image;?>" width="100px">
                                <?php
                            }else{
                                echo '<div class="error">Image not Available</div>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php   
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //updating new image if selected
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];
                    if($image_name!=""){
                        //Auto rename
                        //get extension of image
                        $ext = end(explode('.',$image_name));
                        
                        $image_name = "FoodCategory".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
                        $upload = move_uploaded_file($source_path,$destination_path);
                        if($upload==FALSE){
                            $_SESSION['uploaded'] = "<div class='error'>failed to upload image.</div>";
                            header("location:".HOMEURL.'admin/manage-category.php');
                            die();
                        }

                        //Remove previous image if available
                        if($current_image!=""){
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);

                            //check image is removed or not
                            if($remove==false){
                                $_SESSION['failed-remove'] = '<div class="error">Fialed to remove current image.</div>';
                                header("location:".HOMEURL.'admin/manage-category.php');
                                die();
                            }
                        }
                        
                    }else{
                        $image_name = $current_image;
                    }
                }else{
                    $image_name = $current_image;
                }

                //update db
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";
                $res2 = mysqli_query($conn,$sql2);

                if($res2==true){
                    $_SESSION['update'] = '<div class="success">Successfully Updated.</div>';
                    header('location:'.HOMEURL.'admin/manage-category.php');
                }else{
                    $_SESSION['update'] = '<div class="error">Failed to Update.</div>';
                    header('location:'.HOMEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ; ?>