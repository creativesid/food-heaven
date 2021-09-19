<?php include('partials/menu.php') ; ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1> <br> <br>
        <?php 
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="old password">
                    </td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="new password">
                    </td>
                </tr>
                <tr>
                    <td>confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="confirm password">
                    </td>
                </tr>
                <tr colspan="2">
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                         <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        //get data
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        //check user with current id and password
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        $res = mysqli_query($conn,$sql);
        if($res==TRUE){
            $count = mysqli_num_rows($res);
            if($count==1){
                //check new password and confirm password matches or not
                if($new_password==$confirm_password){
                    $sql2="UPDATE tbl_admin SET
                        password = '$new_password'
                        WHERE id=$id
                    ";
                    $res2 = mysqli_query($conn,$sql2);
                    if($res2==TRUE){
                        $_SESSION['change-pwd'] = '<div class="success">password changed successful</div>';
                        header("location:".HOMEURL.'admin/manage-admin.php');
                    }else{
                        $_SESSION['change-pwd'] = '<div class="error">Failed to save password</div>';
                        header("location:".HOMEURL.'admin/manage-admin.php');
                    }
                }else{
                    $_SESSION['pwd-not-found'] = '<div class="error">password did not match</div>';
                    header("location:".HOMEURL.'admin/manage-admin.php');
                }

            }else{
                $_SESSION['user-not-found'] = '<div class="error">User not Found</div>';
                header("location:".HOMEURL.'admin/manage-admin.php');
            }
        }

        //check new password and confirm password matches or not

        //change password if all above is true
    }
?>

<?php include('partials/footer.php') ; ?>