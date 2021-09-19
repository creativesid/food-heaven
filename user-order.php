<?php include('partials/menu.php');?>

<?php
   $username = $_SESSION['username'];
?>

<head>
    <link rel="stylesheet" href="<?php echo HOMEURL;?>css/bootstrap.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY ORDER</title>
</head>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border rounded bg-light my-5">
                <h1>My ORDERS</h1>
            </div>
            <div class="col-lg-12">

                <table class="table">
                <thead>
                    <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Price</th>
                    <th scope="col">Item Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>

                <?php
                    $sql = "SELECT * FROM tbl_order WHERE username='$username' ORDER BY id DESC";
                    $res = mysqli_query($conn,$sql);
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if($count>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $food = $row['food'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            ?>
                            <tr>
                            <td><?php echo $sn++;?>.</td>
                            <td><?php echo $food;?></td>
                            <td><?php echo $price;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $total;?></td>
                            <td><?php echo $order_date;?></td>
                            <td><?php echo $status;?></td>
                            </tr>
                            <?php
                        }
                    }else{
                        echo '<tr><td colspan="12" class="error">No Orders are available</td></tr>';
                    }
                ?>

                <tbody>
                    
                </tbody>
                </table>

            </div>
        </div>
    </div>

<?php include('partials/footer.php');?>