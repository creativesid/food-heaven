<?php include('partials/menu.php') ; ?>

    <!-- Main Section Starts -->
    <div class="main-content">
        <div class="wrapper">
            <h1>Users List</h1>
            <br>
            <br> 
            
            <table class="tbl-full">
                <tr>
                    <th>SN</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>

                <?php 
                    //getting admin values from db
                    $sql = "select * FROM tbl_usr_reg";
                    $res = mysqli_query($conn , $sql);

                    //check query executed or not
                    if($res==TRUE){
                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $full_name = $row['username'];
                                $email = $row['email'];
                                $status = $row['status']
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $status; ?></td>
                                    </tr>
                                <?php
                                
                            }
                        }else{

                        }
                    }

                ?>

            </table>
        </div> 
    </div>
    <!-- Main Section Ends -->
    
    <?php include('partials/footer.php') ; ?>