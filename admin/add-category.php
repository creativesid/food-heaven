<?php include('partials/menu.php') ; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1> <br> <br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['uploaded'])){
                echo $_SESSION['uploaded'];
                unset($_SESSION['uploaded']);
            }
        ?> <br> <br>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" paceholder="category title"></td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td><input type="file" name="image" ></td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="add category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                // echo "clicked";
                $title = $_POST['title'];
                //for radio button we have to check button is selected or not
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No";
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No";
                }
                // print_r($_FILES['image']);
                // die();
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];

                    //upload image only if image is selected
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
                            header("location:".HOMEURL.'admin/add-category.php');
                            die();
                        }
                    }
                }else{
                    $image_name = "";
                }

                $sql = "INSERT INTO tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                ";

                $res = mysqli_query($conn,$sql);

                if($res==TRUE){
                    $_SESSION['add'] = "<div class='success'>category added successfully.</div>";
                    header("location:".HOMEURL.'admin/manage-category.php');
                }else{
                    $_SESSION['add'] = "<div class='error'>failed to add category.</div>";
                    header("location:".HOMEURL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ; ?>