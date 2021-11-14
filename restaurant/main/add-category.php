<?php include("parts/menu.php");?>
    <div class="main-content">
        <div class="wrapper">
            <strong>ADD CATEGORY</strong>
                <form action="" method="POST" enctype="multipart/form-data">
                    <table class="tbl-add-admin">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" required></td>
                        </tr>
                        <tr>
                            <td>Image:</td>
                            <td><input type="file" name="image"></td>
                        </tr>
                        <tr>
                            <td>Active:</td>
                            <td>
                                <input type="radio" name="active" value="Yes">Yes
                                <input type="radio" name="active" value="No">No
                            </td>
                        </tr>
                        <tr>
                            <td><input class="btn-primary" type="submit" name="submit" value="Add Category"></td>
                        </tr>
                    </table>
                </form>           
        </div>
    </div>
<?php include("parts/footer.php")?>

<?php
    if(isset($_POST['submit']))
    {
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        if(isset($_POST['active']))
        {
            $active=mysqli_real_escape_string($conn,$_POST['active']);
        }
        else
        {
            $active="No";
        }

        if(isset($_FILES['image']['name']))
        {             
            $image_name=$_FILES['image']['name'];
            $ext=explode('.',$image_name);
            $tmp=end($ext);
            $image_name="Food_catogory_".rand(000,900).'.'.$tmp;
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;
            $upload=move_uploaded_file($source_path,$destination_path);

            if($upload==false)
            {
                $_SESSION['fail-img']="<div class='success text-center'>Fail to upload image Add Image</div>";
                header('location:'.SITEURL.'/main/manage-category.php');
                die();
            }
            
        }
        else
        {
            $image_name="";
        }
        
        $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                active='$active'
                ";
        $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
        if($res==TRUE)
        {
            $_SESSION['add']="<div class='success text-center'>Successfully Added Category</div>";
            header('location:'.SITEURL.'/main/manage-category.php');
        }
        else
        {
            $_SESSION['fail-add']="<div class='fail text-center'>Fail to add Category</div>";
            header('location:'.SITEURL.'/main/manage-category.php');
        }
    }
?>
