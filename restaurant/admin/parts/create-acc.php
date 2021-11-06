<?php 
    include('../config/config.php');
    if(!isset($_SESSION['user']))
    {
        $_SESSION['login-msg']="Please Log in";
        header('location:'.SITEURL.'/admin/login.php');
    }
?>
<html>
    <head>
        <title>Create Account</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>