<?php include('partials/menu.php') ; ?>

<!-- Main Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Manage Food</h1>
            <br> <br>
            <a href="<?php echo HOMEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
            <br> <br>
            <?php
                if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
                if(isset($_SESSION['uploaded'])){
                    echo $_SESSION['uploaded'];
                    unset($_SESSION['uploaded']);
                }
                if(isset($_SESSION['failed-remove'])){
                    echo $_SESSION['failed-remove'];
                    unset($_SESSION['failed-remove']);
                }
                if(isset($_SESSION['update'])){
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php
                    $sql="SELECT * FROM tbl_food";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);

                    $sn=1;
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $title = $row['title'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            ?>
                            <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $title;?></td>
                                <td><?php echo $price . "rs.";?></td>

                                <td>
                                    <?php 
                                        if($image_name!==""){
                                            ?>
                                                <img src="<?php echo HOMEURL;?>images/food/<?php echo $image_name;?>" width="100px">
                                            <?php
                                        }else{
                                            echo "<div class='error'>No image</div>";
                                        }
                                    ?>
                                </td>
                                
                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a href="<?php echo HOMEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a> 
                                    <a href="<?php echo HOMEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a> 
                                </td>
                            </tr>
                            <?php
                        }
                    }else{
                        ?>
                            <tr>
                                <td colspan="7"><div class="error">Food not Added yet.</div></td>
                            </tr>
                        <?php
                    }

                ?>
                
            </table>
            
        </div> 
    </div>
    <!-- Main Section Ends -->

<?php include('partials/footer.php') ; ?>