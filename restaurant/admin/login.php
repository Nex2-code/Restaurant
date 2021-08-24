<?php include('../config/config.php'); ?>
<html>
    <head>
        <title>LogIn Page</title>
        <link rel="stylesheet" href="../css/login.css">
    </head>
    <body>
        <a href="<?php echo SITEURL;?>">Back to Restaurant</a>
        <div class="login">
            <h2>Login</h2>
            <?php
                if(isset($_SESSION['fail-login']))
                {
                    echo $_SESSION['fail-login'];
                    unset($_SESSION['fail-login']);
                }
                if(isset($_SESSION['login-msg']))
                {
                    echo $_SESSION['login-msg'];
                    unset($_SESSION['login-msg']);
                }  
            ?><br>
            <br>
            <form class="lg-form" action="" method="POST">
            Username:
            <input type="text" name="username"required>
            <br><br>
            Password:
            <input type="password" name="password"required>
            <br><br>
            <input type="submit" name="submit" value="Login">
        </form>
        </div>        
    </body>
</html>

<?php
    if(isset($_POST['submit']))
    {
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $password=mysqli_real_escape_string($conn,md5($_POST['password']));

        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
        $res=mysqli_query($conn,$sql);
        if($res==TRUE)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                $_SESSION['login']="<div class='success text-center'>Logged in Successfully</div>";
                $_SESSION['user']= $username;
                header('location:'.SITEURL.'/admin/');
            }
            else
            {
                $_SESSION['fail-login']="<div class='fail text-center'>Log in Error,Enter correct Username and Password</div>";
                header('location:'.SITEURL.'/admin/login.php');
            }
        }
    }
?>