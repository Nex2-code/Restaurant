
<?php
    include('../config/config.php');

    $id=mysqli_real_escape_string($conn,$_GET['id']);
    $sql="DELETE FROM tbl_admin WHERE id=$id";
    $res=mysqli_query($conn,$sql);

    if($res==TRUE)
    {
        $_SESSION['delete']="<div class='success text-center'>Successfully Deleted</div>";
        header("location:".SITEURL.'/admin/manage-admin.php');
    }
    else
    {
        $_SESSION['fail-delete']="<div class='fail text-center'>fail to Deleted</div>";
        header("location:".SITEURL.'/admin/manage-admin.php');
    }

?>