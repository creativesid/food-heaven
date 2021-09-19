<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php include('config/constant.php'); ?>

<?php
        if(isset($_SESSION['email'])){
            header('location:'.HOMEURL);
        }
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if($_SESSION['no-login-message']){
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
?>

    <div style="width:500px;color:blue;margin: 10% auto;padding: 1%;" class="text-center">
        <?php echo $_SESSION['msg'] ;?>
    </div>
    <form action="" class="login" method="post">
        <input type="email" name="email" placeholder="email address">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Login" name="submit" class="button">
        <p style="color: #ffffff;">Don't have a Account <a href="register.php" style="color: #000;">Sign Up Here</a> </p>
    </form>


<?php 
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM tbl_usr_reg WHERE email='$email' AND password='$password' AND status='active'";
        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);
        if($count==1){
            $details = mysqli_fetch_assoc($res) ;
            $_SESSION['login'] = '<div class="success text-center">Login successful</div>';
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $details['username'];
            header("location:".HOMEURL);

        }else{
            $_SESSION['login'] = '<div class="error text-center">Email or Password does not match</div>';
            header("location:".HOMEURL);
        }
    }
?>