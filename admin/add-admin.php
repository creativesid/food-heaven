<?php include('partials/menu.php') ; ?>

<div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1> <br> <br>
            <?php 
                if(isset($_SESSION['add'])){
                    echo "Admin added";
                    unset($_SESSION['add']);
                }
            ?>

            <form action="" method="POST">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" 
                                    placeholder="enter your name"></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" 
                                    placeholder="enter your username"></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" 
                                    placeholder="enter your password"></td>
                    </tr>
                    <tr colspan="2">
                        <td> <input type="submit" name="submit" value="Add Admin" class="btn-secondary"> </td>
                    </tr>
                </table>
            </form>
        </div>
</div>

<?php include('partials/footer.php') ; ?>

<?php 
    //Check the submit is clicked or not
    if(isset($_POST['submit'])){
        // echo "clicked";

        //get data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //sql query to save data to db
        $sql = "INSERT INTO tbl_admin SET
            full_name= '$full_name',
            username= '$username',
            password= '$password'
        ";
        // echo $sql;

        //execute query
        $res = mysqli_query($conn , $sql) or die('failed');

        //check query executed or not
        if($res==TRUE){
            $_SESSION['add'] ="Admin added successful";
            header("location:".HOMEURL.'admin/manage-admin.php');
        }else{
            $_SESSION['add'] ="Failed to add";
            header("location:".HOMEURL.'admin/manage-admin.php');
        }
    }
?>