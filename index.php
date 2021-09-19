<?php include('partials/menu.php');?>
<?php
    $username = $_SESSION['username'];
?>

    <!-- Header Section Starts Here -->
    <section class="header">
        <div class="container">
            
            <div class="tagline">
                <h1 style="text-transform: uppercase; color:#ffa600"><span style="color: #ffffff;">HEY</span> <?php echo $username;?></h1>
                <h1>ARE YOU FEELING HUNGRY 🤔</h1>
                <?php
                    if(isset($_SESSION['order'])){
                        echo $_SESSION["order"] ;
                        unset($_SESSION['order']);
                    }
                ?>
                <div class="order-btn">
                        <a href="#category" class="btn-secondary">Order Something🍔</a>
                </div>
            </div>
            <div class="header-image">
                <img src="images/header-img.png" class="img-responsive">
            </div>

        </div>
        <div class="clearfix"></div>
    </section>
    <!-- Header Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories" id="category">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                if($count>0){
                    while($row= mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo HOMEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name==""){
                                        echo '<div class="error">Image not available</div>';
                                    }else{
                                        ?>
                                        <img src="<?php echo HOMEURL;?>/images/category/<?php echo $image_name;?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }else{
                    echo '<div class="error">Category not available</div>';
                }
            ?>

            <div class="clearfix"></div>

            <p class="text-center">
                <a href="<?php echo HOMEURL;?>categories.php">See All Food Categories</a>
            </p>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                $res2 = mysqli_query($conn,$sql2);
                $count2 = mysqli_num_rows($res2);
                if($count2>0){
                    while($row2=mysqli_fetch_assoc($res2)){
                        $id= $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        <form action="managecart.php" method="POST">
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                    if($image_name==""){
                                        echo '<div class="error">Image not available</div>';
                                    }else{
                                        ?>
                                        <img src="<?php echo HOMEURL;?>/images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price"><?php echo $price;?> rs</p>
                                    <p class="food-detail">
                                        <?php echo $description;?>
                                    </p>
                                    <br>

                                    <a href="<?php echo HOMEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                    <!-- <button type="submit" name="add-to-cart"  class="btn btn-add-to-cart">Add to Cart</button> -->
                                    <input type="hidden" name="item_name" value="<?php echo $title;?>">
                                    <input type="hidden" name="item_price" value="<?php echo $price;?>">
                                </div>
                            </div>
                        </form>
                        <?php
                    }
                }else{
                    echo '<div class="error">Foods are not available.</div>';
                }

            ?>

            <div class="clearfix"></div>
        </div>

        <p class="text-center">
            <a href="<?php echo HOMEURL;?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- footer Section Starts Here -->
    <?php include('partials/footer.php'); ?>
    <!-- footer Section Ends Here -->

</body>
</html>