<?php include('../config/constant.php'); ?>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login : Admin Panel</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <?php
        
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if($_SESSION['no-login-message']){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
    ?>
    <form action="" class="login" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login" name="submit" class="button">
    </form>
</body>
</html>

<?php 
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);
        if($count==1){
            $_SESSION['login'] = '<div class="success text-center">Login successful</div>';
            $_SESSION['user'] = $username;
            header("location:".HOMEURL.'admin');

        }else{
            $_SESSION['login'] = '<div class="error text-center" style="margin-top:10%">Username or Password does not match</div>';
            header("location:".HOMEURL.'admin/login.php');
        }
    }
?>