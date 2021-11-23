<?php 
    include("parts/menu.php");
?>
    <div class="main-content">
        <div class="wrapper">
            <strong>Update Food</strong>
            <?php
                        if(isset($_GET['id']))
                        {
                            $id=mysqli_real_escape_string($conn,$_GET['id']);
                            $sql="SELECT * FROM tbl_food WHERE id=$id";
                            $res=mysqli_query($conn,$sql);
                            {
                                $count=mysqli_num_rows($res);
                                if($count==1)
                                {
                                    $row=mysqli_fetch_assoc($res);
                                    $title=$row['title'];
                                    $current_image=$row['image_name'];
                                    $active=$row['active'];
                                    $description=$row['description'];
                                    $price=$row['price'];
                                    $current_category=$row['category_id'];

                                }
                                else
                                {
                                    header('location:'.SITEURL.'/admin/manage-food.php');
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
                        <td>Description:</td>
                        <td>
                            <textarea name="description"cols="13" rows="3"><?php echo $description;?>"</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price"value ="<?php echo $price;?>"required>
                        </td>
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
                    <td>Category:</td>
                        <td>
                        <select name="category">
                        <?php
                            $sql= "SELECT * FROM tbl_category WHERE active='Yes'";
                            $res=mysqli_query($conn,$sql);
                            if($res==true)
                            {
                                $count=mysqli_num_rows($res);
                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_id=$row['id'];
                                        $category_title=$row['title'];
                                        ?>
                                          <option <?php if($current_category==$category_id){echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="0">No active category</option>
                                    <?php
                                }
                            } 
                        ?>
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
        $active=$_POST['active'];
        $price=$_POST['price'];
        $description=$_POST['description'];


        if(isset($_FILES['image']['name']))
        {
            $image_name=$_FILES['image']['name'];
            if($image_name!="")
            {
                $ext=explode('.',$image_name);
                $tmp=end($ext);
                $image_name="Food_".rand(000,900).'.'.$tmp;
                $source_path=$_FILES['image']['tmp_name'];
                $destination_path="../images/category/".$image_name;
                $upload=move_uploaded_file($source_path,$destination_path);

                if($upload==false)
                {
                    $_SESSION['fail-img']="<div class='fail text-center'>Fail to upload image</div>";
                    header('location:'.SITEURL.'/admin/manage-food.php');
                    die();
                }
                if($current_image!="")
                {
                    $path="../images/category/".$current_image;
                    $remove=unlink($path);
                    if($remove==false)
                    {
                        $_SESSION['fail-img']="<div class='fail text-center'>Fail to remove image</div>";
                        header('location:'.SITEURL.'/admin/manage-food.php');
                        die();
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

        $sql1="UPDATE tbl_food SET
                title='$title',
                active='$active',
                image_name='$image_name',
                price=$price,
                description='$description'
                WHERE id=$id";
        $res1=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
        if($res1==true)
        {
            $_SESSION['update']="<div class='success text-center'>Food Updated</div>";
            header('location:'.SITEURL.'/admin/manage-food.php');
        }
        else
        {
            $_SESSION['fail-update']="<div class='fail text-center'>Food Fail to Update</div>";
            header('location:'.SITEURL.'/admin/manage-food.php');   
        }

    }

?>