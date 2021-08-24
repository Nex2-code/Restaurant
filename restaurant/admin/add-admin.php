<?php include("parts/menu.php");?>
<div class="main-content">
    <div class="wrapper">
        <strong>Add Admin</strong>
            <form action="" method="POST">
                <table class="tbl-add-admin">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name"placeholder="Enter your full name" required></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" placeholder="Type username" required></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="type your password"reduired></td>
                    </tr>
                    <tr>
                    <td><input class="btn-primary" type="submit" name="submit" value="ADD"></td>
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

        $sql = "INSERT INTO tbl_admin SET
                full_name='$full_name',
                username='$username',
                password='$password'
        ";
        $res= mysqli_query($conn,$sql);

        if($res==TRUE)
        {
            $_SESSION['add']="<div class='success text-center'>Admin Added Successfully</div>";
            header("location:".SITEURL.'/admin/manage-admin.php');
        }
        else
        {
            $_SESSION['fail-add']= "<div class='fail text-center'>Fail to Add Admin</div>";
            header("location:".SITEURL.'/admin/manage-admin.php');
        }
    }
?>