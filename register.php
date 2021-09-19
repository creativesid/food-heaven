<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<?php include('config/constant.php'); ?>

<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $confirmPassword = md5($_POST['confirmPassword']);
        $token =bin2hex(random_bytes(15));

        $checkEmail = "SELECT * FROM tbl_usr_reg WHERE email='$email'";
        $res = mysqli_query($conn,$checkEmail);
        $emailCount = mysqli_num_rows($res);
        if($emailCount>0){
            echo '<p class="text-center <p class="text-center">email already exists</p>';
        }else{
            if($password===$confirmPassword){
                $insertQuery = "INSERT into 
                    tbl_usr_reg(username , email , password , cpassword , token , status)
                    values('$username','$email','$password','$confirmPassword','$token','inactive')";

                $res1 = mysqli_query($conn,$insertQuery);
                if($res1){
                    require_once "PHPMailer/PHPMailer.php";
                    require_once "PHPMailer/SMTP.php";
                    require_once "PHPMailer/Exception.php";

                    $mail = new PHPMailer();

                    //SMTP Settings
                    $mail->isSMTP();
                    $mail->Host = "smtp.gmail.com";
                    $mail->SMTPAuth = true;
                    $mail->Username = "demoemailforproject@gmail.com"; //enter you email address
                    $mail->Password = 'Demo@0012'; //enter you email password
                    $mail->Port = 465;
                    $mail->SMTPSecure = "ssl";

                    //Email Settings
                    $mail->isHTML(true);
                    $mail->setFrom("demoemailforproject@gmail.com");
                    $mail->addAddress($email); //enter you email address
                    $mail->Subject = ("Email Activation -Wow Food");
                    $mail->Body = "hi, $username. Click here activate your accout
                    http://localhost/order-food/activate.php?token=$token";

                    if ($mail->send()) {
                        // echo "send";
                        $_SESSION['msg'] = "Activation link has been sent to your mail $email <br/>Please Activate to Login";
                        header("location:".HOMEURL.'/login.php');
                    } else {
                        echo "failed";
                    }
                }else{
                    ?>
                    <script>
                        alert("Failed to Register");
                    </script>
                    <?php
                }
            }else{
                echo '<p class="text-center error" style="margin-top:10%">password not matched</p>';
            }
        }
    }

?>

<form action="" class="login" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="email address" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirmPassword" placeholder="Re enter your password" required>
    <input type="submit" value="Register" name="submit" class="button">
    <p style="color: #ffffff;">Have a Account <a href="login.php" style="color: #000;">Login Here</a> </p>
</form>