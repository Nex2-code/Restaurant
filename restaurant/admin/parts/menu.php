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
        <title>Admin Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <!---Menu starts here--->
        <div class="menu">
            <div class="wrapper text-center">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a onclick="return confirm('You will be logout')" href="login.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!---Menu ends here--->