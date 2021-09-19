<?php include('partials/menu.php') ; ?>


        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                
                $sql = "SELECT * FROM tbl_food WHERE id=$id";
                $res = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_category = $row['category_id'];
                $featured = $row['featured'];
                $active = $row['active'];

            }else{
                header('location:'.HOMEURL.'admin/manage-food.php');
            }
        ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1> <br> <br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title"  value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>description:</td>
                    <td><textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price"  value="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                            if($current_image!=""){
                                ?>
                                <img src="<?php echo HOMEURL;?>images/food/<?php echo $current_image;?>" width="100px">
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
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Update food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php   
            if(isset($_POST['submit'])){
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
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
                        
                        $image_name = "FOOD".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/food/".$image_name;
                        $upload = move_uploaded_file($source_path,$destination_path);
                        if($upload==FALSE){
                            $_SESSION['uploaded'] = "<div class='error'>failed to upload image.</div>";
                            header("location:".HOMEURL.'admin/manage-food.php');
                            die();
                        }

                        //Remove previous image if available
                        if($current_image!=""){
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);

                            //check image is removed or not
                            if($remove==false){
                                $_SESSION['failed-remove'] = '<div class="error">Fialed to remove current image.</div>';
                                header("location:".HOMEURL.'admin/manage-food.php');
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
                $sql2 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = '$current_category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";
                $res2 = mysqli_query($conn,$sql2);

                if($res2==true){
                    $_SESSION['update'] = '<div class="success">Successfully Updated.</div>';
                    header('location:'.HOMEURL.'admin/manage-food.php');
                }else{
                    $_SESSION['update'] = '<div class="error">Failed to Update.</div>';
                    header('location:'.HOMEURL.'admin/manage-food.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ; ?>