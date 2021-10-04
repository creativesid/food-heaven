<?php 

    session_start();
    define('HOMEURL', 'https://food-heaven.herokuapp.com/');
    define('LOCALHOST', 'remotemysql.com');
    define('DBUSER', 'QSnXffpEec');
    define('DBPASS', '1bUgQvBVFb');
    define('DBNAME', 'QSnXffpEec');
    
    $conn = mysqli_connect(LOCALHOST,DBUSER,DBPASS) or die('failed');
    $db_select = mysqli_select_db($conn,DBNAME) or die('failed');
    
?>
