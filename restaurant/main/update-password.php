<?php include("parts/menu.php");?>
<?php
    if(isset($_SESSION['no-match']))
    {
        echo $_SESSION['no-match'];
        unset($_SESSION['no-match']);
    }
?>
    <div class="main-content">
        <div class="wrapper">
            <strong>UPDATE PASSWORD</strong>
            <?php
                if(isset($_GET['id']))
                {
                    $id=mysqli_real_escape_string($conn,$_GET['id']);
                }
            ?>
            <form action="" method="POST">
                <table class="tbl-add-admin">
                    <tr>
                        <td>Current password:</td>
                        <td><input type="password" name="current_password"placeholder="type current password"required></td>
                    </tr>
                    <tr>
                        <td>New password:</td>
                        <td><input type="password" name="new_password" placeholder="type new password"required></td>
                    </tr>
                    <tr>
                        <td>Confirm password:</td>
                        <td><input type="password" name="confirm_password" placeholder="retype new password"required></td>
                    </tr>
                    <tr>
                    <td><input class="btn-primary" type="submit" name="submit" value="Change password"></td>
                    <td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php include("parts/footer.php")?>

<?php
    if(isset($_POST['submit']))
    {
        $id=$_POST['id'];
        $current_password=mysqli_real_escape_string($conn,md5($_POST['current_password']));
        $new_password=mysqli_real_escape_string($conn,md5($_POST['new_password']));
        $confirm_password=mysqli_real_escape_string($conn,md5($_POST['confirm_password']));

        $sql= "SELECT * FROM tbl_user WHERE id=$id AND password='$current_password'";
        $res= mysqli_query($conn,$sql);
        if($res==TRUE)
        {
            $count=mysqli_num_rows($res);
            if($count==1)
            {
                if($new_password==$confirm_password)
                {
                    $sql1="UPDATE tbl_user SET
                        password='$new_password'
                        WHERE id=$id
                    ";
                    $res1=mysqli_query($conn,$sql1);
                    if($res1==TRUE)
                    {
                        $_SESSION['pas-update']="<div class='success text-center'>Password updated Successfully</div>";
                        header('location:'.SITEURL.'/main/manage-admin.php');
                    }
                    else
                    {
                        $_SESSION['fail-pas-update']="<div class='fail text-center'>Fail to Update</div>";
                        header('location:'.SITEURL.'/main/manage-admin.php');
                    }
                }
                else
                {
                    $_SESSION['no-match']="<div class='fail text-center'>Password Not match re-try</div>";
                    header('location:'.SITEURL.'/main/update-password.php');
                }
            }
            else
            {
                $_SESSION['no-user']="<div class='fail text-center'>No user Found with match</div>";
                header('location:'.SITEURL.'/main/manage-admin.php');   
            }
        }
    } 

?>