<?php
    include('../config/config.php');
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
      $id=mysqli_real_escape_string($conn,$_GET['id']);
      $image_name=$_GET['image_name'];
      if($image_name!="")
      {
        $path="../images/category/".$image_name;
        $remove=unlink($path);
        if($remove==false)
        {
            $_SESSION['fail-img']="<div class='fail text-center'>Fail to remove image</div>";
            header('location:'.SITEURL.'/admin/manage-food.php');
        }
      }
      $sql="DELETE FROM tbl_food WHERE id=$id";
      $res=mysqli_query($conn,$sql);
      if($res==true)
      {
        $_SESSION['delete']="<div class='success text-center'>Successfully removed Food</div>";
        header('location:'.SITEURL.'/admin/manage-food.php'); 
      }
      else
      {
        $_SESSION['fail-delete']="<div class='fail text-center'>Fail to remove Food</div>";
        header('location:'.SITEURL.'/admin/manage-food.php'); 
      }
    }
    else
    {
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>