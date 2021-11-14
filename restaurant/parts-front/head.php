<?php include("config/config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!---Important to make website responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
        <!--Navigate section bar starts here-->
    <section class="navbar">
    <div class="container">
            <div class="logo">
            <img src="images/logo.jpeg" alt="logo" class="img-resp">
            </div>
            <div class="menu text-right">
            <ul>
                <li>
                    <a href="<?php echo SITEURL;?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL;?>/categories.php">Categories</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL;?>/foods.php">Foods</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL;?>/main/login.php">Login</a>
                </li>
            </ul>
            </div>
            <div class="clear"></div>
    </div>
</section>
    <!--Navigate section bar Ends here-->