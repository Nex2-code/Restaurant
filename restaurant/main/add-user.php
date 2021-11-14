<?php include("parts/create-acc.php") ?>
<div class="main-content">
    <div class="wrapper">
        <strong>Create User</strong>
        <br><br>
            <form action="" method="POST">
                <table class="tbl-add-admin">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" required></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username"required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" reduired></td>
                    </tr>
                    <tr>
                    <td><br><input class="btn-primary" type="submit" name="submit" value="Submit"></td>
                    </tr>
                </table>
            </form>
    </div>
</div>

<?php include("parts/footer.php")?>

<?php
    if(isset($_POST['submit']))
    {
        $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,md5($_POST['password']));

        $sql = "INSERT INTO tbl_user SET
                full_name='$full_name',
                username='$username',
                password='$password'
        ";
        $res= mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            $_SESSION['add']="<div class='success text-center'>User created Successfully</div>";
            header("location:".SITEURL.'/main/login.php');
        }
        else
        {
            $_SESSION['fail-add']= "<div class='fail text-center'>Fail to create user</div>";
            header("location:".SITEURL.'/main/login.php');
        }
    }
?>