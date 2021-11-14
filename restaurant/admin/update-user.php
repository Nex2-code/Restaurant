<?php include("parts/menu.php");?>
    <div class="main-content">
        <div class="wrapper">
            <strong>UPDATE ADMIN</strong>
            <?php
                $id=mysqli_real_escape_string($conn,$_GET['id']);
                $sql= "SELECT * FROM tbl_user WHERE id=$id";
                $res=mysqli_query($conn,$sql);
                if($res==TRUE)
                {
                    $count=mysqli_num_rows($res);
                    if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $full_name=$row['full_name'];
                        $username=$row['username'];
                    }
                    else
                    {
                        header("location:".SITEURL.'/admin/manage-admin.php');
                    }
                }
            ?>
            <form action="" method="POST">
                <table class="tbl-add-admin">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name;?>"required></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><input type="text" name="username" value="<?php echo $username;?>"required></td>
                    </tr>
                    <tr>
                        <td><input class="btn-primary" type="submit" name="submit" value="Update"></td>
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
        $id=mysqli_real_escape_string($conn,$_POST['id']);
        $full_name=mysqli_real_escape_string($conn,$_POST['full_name']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);

        $sql1= "UPDATE tbl_user SET
                full_name='$full_name',
                username='$username'
                WHERE id=$id
                ";
        $res1=mysqli_query($conn,$sql1);
        if($res1==TRUE)
        {
            $_SESSION['update']="<div class='success text-center'>Admin Updated</div>";
            header('location:'.SITEURL.'/admin/manage-admin.php');
        }
        else
        {
            $_SESSION['fail-update']="<div class='fail text-center'>Fail to update</div>";
            header('location:'.SITEURL.'/admin/manage-admin.php');
        }
    }
?>