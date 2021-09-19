<?php include('partials/menu.php') ; ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>ADD FOOD</h1>
            <br> <br>

            <?php
                if(isset($_SESSION['uploaded'])){
                    echo $_SESSION['uploaded'];
                    unset($_SESSION['uploaded']);
                }
            ?> <br> <br>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" placeholder="title of food"></td>
                    </tr>
                    <tr>
                        <td>Decription:</td>
                        <td><textarea name="description" cols="30" rows="10"></textarea></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="number" name="price" placeholder="Price of food"></td>
                    </tr>
                    <tr>
                        <td>Select Image:</td>
                        <td><input type="file" name="image" ></td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                
                                <?php
                                    //get category data from DB
                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                    $res = mysqli_query($conn,$sql);
                                    $count = mysqli_num_rows($res);
                                    if($count>0){
                                        while($row=mysqli_fetch_assoc($res)){
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                            <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <option value="0">No Category</option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td><input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td><input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" name="submit" value="Submit Food" class="btn-secondary"></td>
                    </tr>
                </table>
            </form>
            
            <?php
                //check submit button clicked or not
                if(isset($_POST['submit'])){

                    //Get data from form
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];

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

                    //Upload image
                    if(isset($_FILES['image']['name'])){
                        $image_name = $_FILES['image']['name'];
    
                        //upload image only if image is selected
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
                                header("location:".HOMEURL.'admin/add-food.php');
                                die();
                            }
                        }
                    }else{
                        $image_name = "";
                    }
                    $sql2 = "INSERT INTO tbl_food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                    ";

                    $res2 = mysqli_query($conn,$sql2);

                    if($res2==true){
                        $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                        header("location:".HOMEURL.'admin/manage-food.php');
                    }else{
                        $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                        header("location:".HOMEURL.'admin/add-food.php');
                    }
                }
            ?>
            
        </div> 
    </div>

<?php include('partials/footer.php') ; ?>