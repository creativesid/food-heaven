<?php include('config/constant.php'); ?>
<?php
date_default_timezone_set("Asia/Kolkata");

            if(isset($_POST['submit'])){ 
                $username = $_POST['username'];
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price*$qty;
                $order_date = date("Y-m-d h:i:s");
                $status = "ordered";
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                $sql = "INSERT INTO tbl_order SET
                    username = '$username',
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";

                $res = mysqli_query($conn,$sql);

                if($res==true){
                    $_SESSION['order'] = '<div>Order Placed Successfully.</div>';
                    header('location:'.HOMEURL);
                }else{
                    $_SESSION['order'] = '<div class="error">Failed to Place Order.</div>';
                    header('location:'.HOMEURL);
                }
            }

            ?>