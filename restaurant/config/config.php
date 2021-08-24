<?php

    session_start();
    define('SITEURL','http://localhost/restaurant');
    define('LOCALHOST','localhost');
    define('USERNAME','root');
    define('PASSWORD','');
    define('DB','restaurant');

    $conn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD);
    $db=mysqli_select_db($conn,DB);

?>