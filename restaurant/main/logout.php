<?php
    include('../config/config.php');
    session_destroy();
    header('location:'.SITE.'/main/login.php');
?>