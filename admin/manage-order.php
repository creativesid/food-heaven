<?php include('partials/menu.php') ; ?>

<!-- Main Section Starts -->
    <div class="main-content">
        <div class="wrapper" style="width: 90%;">
            <h1>Manage Order</h1>
            <br> <br>
            <?php
                if(isset($_SESSION['update'])){
                    echo $_SESSION["update"] ;
                    unset($_SESSION['update']);
                }
            ?> <br> <br>
            <table class="tbl-full" >
                <tr>
                    <th>SN.</th>
                    <th>Food</th>
                    <th>Price</th>
                    <th>Qty.</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>user</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>

                <?php
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                $sn = 1;
                if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];
                        ?>

                        <tr>
                            <td><?php echo $sn++;?>.</td>
                            <td><?php echo $food;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $total;?></td>
                            <td><?php echo $order_date;?></td>
                            <td><?php echo $status;?></td>
                            <td><?php echo $customer_name;?></td>
                            <td><?php echo $customer_contact;?></td>
                            <td><?php echo $customer_email;?></td>
                            <td><?php echo $customer_address;?></td>
                            <td>
                                <a href="<?php echo HOMEURL?>admin/update-order.php?id=<?php echo $id;?>" class="btn-secondary">UpdateOrder</a>
                            </td>
                        </tr>

                        <?php
                    }
                }else{
                    echo '<tr><td colspan="12" class="error">Orders are available</td></tr>';
                }
                ?>

            </table>
            
        </div> 
    </div>
    <!-- Main Section Ends -->

<?php include('partials/footer.php') ; ?>