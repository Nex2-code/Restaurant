<?php
    include('../config/config.php');
    session_destroy();
    header('location:'.SITE.'/admin/login.php');
?>