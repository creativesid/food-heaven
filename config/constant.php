<?php 

    session_start();
    define('HOMEURL', 'https://food-heaven.herokuapp.com/');
    define('LOCALHOST', 'sql6.freemysqlhosting.net');
    define('DBUSER', 'sql6441289');
    define('DBPASS', 'MlWneeCZuI');
    define('DBNAME', 'sql6441289');
    
    $conn = mysqli_connect(LOCALHOST,DBUSER,DBPASS) or die('failed');
    $db_select = mysqli_select_db($conn,DBNAME) or die('failed');
    
?>
