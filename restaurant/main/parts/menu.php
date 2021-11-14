<?php 
    include('../config/config.php');
    if(!isset($_SESSION['user']))
    {
        $_SESSION['login-msg']="Please Log in";
        header('location:'.SITEURL.'/main/login.php');
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
                    <li><a href="manage-user.php">User</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a class="cursor" onclick="document.getElementById('out').style.display='block'">Logout</a></li>
                    <div id="out" class="modal">
                    <span onclick="document.getElementById('out').style.display='none'" class="close">×</span>
                    <form class="modal-content" action="login.php">
                        <div class="container">
                            <p>Are you sure you want to Logout?</p><br>
                            <div class="clearfix">
                                <button type="button" onclick="document.getElementById('out').style.display='none'" class="cancelbtn">Cancel</button>
                                <button type="submit" class="deletebtn">Logout</button>
                            </div>
                        </div>
                    </form>
                </ul>
            </div>
        </div>
        <!---Menu ends here--->