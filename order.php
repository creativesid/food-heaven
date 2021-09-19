<?php include('partials/menu.php'); ?>
<?php
    $username = $_SESSION['username']; 
?>
<?php

if(isset($_GET['food_id'])){
    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($res);

    if($count==1){
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }else{
        header('location:'.HOMEURL);
    }

}else{
    header('location:'.HOMEURL);
}

?>

    <!-- orderPage Starts Here -->
    <section class="orderPage">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="manageorder.php" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name==""){
                                echo '<div class="error">Image not available</div>';
                            }else{
                                ?>
                                <img src="<?php echo HOMEURL;?>images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="hidden" name="username" value="<?php echo $username;?>">
                        <p class="food-price"><?php echo $price ." Rs";?></p>
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" min="1" max="10" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Siddharth pandey" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. email@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            

        </div>
    </section>
    <!-- orderPage Ends Here -->

<?php include('partials/footer.php'); ?>