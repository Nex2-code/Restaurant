<?php 
    include("parts/menu.php");
?>
    <div class="main-content">
        <div class="wrapper">
            <strong>UPDATE CATEGORY</strong>
            <?php
                        if(isset($_GET['id']))
                        {
                            $id=mysqli_real_escape_string($conn,$_GET['id']);
                            $sql="SELECT * FROM tbl_category WHERE id=$id";
                            $res=mysqli_query($conn,$sql);
                            {
                                $count=mysqli_num_rows($res);
                                if($count==1)
                                {
                                    $row=mysqli_fetch_assoc($res);
                                    $title=$row['title'];
                                    $current_image=$row['image_name'];
                                    $featured=$row['featured'];
                                    $active=$row['active'];

                                }
                                else
                                {
                                    header('location:'.SITEURL.'/main/manage-category.php');
                                }
                            }
                        } 
                    ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-add-admin">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title" value="<?php echo $title;?>"required></td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                        <?php
                        if($current_image!="")
                        {
                            ?>
                            <img src="<?php echo SITEURL;?>/images/category/<?php echo $current_image;?>" width="20%">
                        <?php
                        }
                        else
                        {
                            echo "image not added";
                        }
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>New Image:</td>
                        <td><input type="file" name="image"></td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                        <td><input class="btn-primary" type="submit" name="submit" value="Update"></td>
                        <td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
                        <td><input type="hidden" name="current_image" value="<?php echo $current_image;?>"></td>
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
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $current_image=$_POST['current_image'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];

        if(isset($_FILES['image']['name']))
        {
            $image_name=$_FILES['image']['name'];
            if($image_name!="")
            {
                $ext=explode('.',$image_name);
                $tmp=end($ext);
                $image_name="Food_catogory_".rand(000,900).'.'.$tmp;
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/category/".$image_name;
                $upload=move_uploaded_file($source_path,$destination_path);

                if($upload==false)
                {
                    $_SESSION['fail-img']="<div class='fail text-center'>Fail to upload image</div>";
                    header('location:'.SITEURL.'/main/manage-category.php');
                    die();
                }
                if($current_image!="")
                {
                    $path="../images/category/".$current_image;
                    $remove=unlink($path);
                    if($remove==false)
                    {
                        $_SESSION['f-img']="<div class='Fail text-center'>Fail to remove image</div>";
                        header('location:'.SITEURL.'/main/manage-category.php');
                    }
                }
            }
            else
            {
               $image_name=$current_image; 
           }
        }
        else
        {
        $image_name=$current_image;
        }
    

        $sql1="UPDATE tbl_category SET
                title='$title',
                featured='$featured',
                active='$active',
                image_name='$image_name' 
                WHERE id=$id";
        $res1=mysqli_query($conn,$sql1);
            if($res1==true)
            {
                $_SESSION['update']="<div class='success text-center'>Image Updated</div>";
                header('location:'.SITEURL.'/main/manage-category.php');
            }
            else
            {
                $_SESSION['fail-update']="<div class='fail text-center'>image Updated</div>";
                header('location:'.SITEURL.'/main/manage-category.php');   
            }

    }

?>