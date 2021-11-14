<?php 
    include("parts/menu.php");
?>
<div class="main-content">
    <div class="wrapper">
        <strong>Add Food</strong>
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-add-admin">
                    <tr>
                        <td>Title:</td>
                        <td><input type="text" name="title"placeholder="Enter title"required></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><textarea name="description"cols="13" rows="3" placeholder="Food description"></textarea></td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td><input type="number" name="price"required></td>
                    </tr>
                    <tr>
                        <td>Image</td>
                        <td><input type="file"name="image"></td>
                    </tr>
                    <tr>
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
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        ?>
                                          <option value="<?php echo $id;?>"><?php echo $title;?></option>
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
                        </select>
                        </td>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>
                    <tr>
                    <td><input class="btn-primary" type="submit" name="submit" value="Add Food"></td>
                    </tr>
                </table>
            </form>
    </div>
</div>

<?php include("parts/footer.php")?>

<?php
    if(isset($_POST['submit']))
    {
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        $description = mysqli_real_escape_string($conn,$_POST['description']);
        $price = mysqli_real_escape_string($conn,$_POST['price']);
        $category=mysqli_real_escape_string($conn,$_POST['category']);

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
            $image_name="Food_".rand(000,900).'.'.$tmp;
            $source_path=$_FILES['image']['tmp_name'];
            $destination_path="../images/category/".$image_name;
            $upload=move_uploaded_file($source_path,$destination_path);

            if($upload==false)
            {
                $_SESSION['fail-img']="<div class='fail text-center'>Fail to upload image Add Image</div>";
                header('location:'.SITEURL.'/admin/manage-food.php');
                die();
            }
            
        }
        else
        {
            $image_name="";
        }

        $sql1 = "INSERT INTO tbl_food SET
                title='$title',
                description='$description',
                price=$price,
                image_name='$image_name',
                active='$active',
                category_id='$category'
        ";
        $res1= mysqli_query($conn,$sql1);

        if($res1==TRUE)
        {
            $_SESSION['add']="<div class='success text-center'>food Added Successfully</div>";
            header("location:".SITEURL.'/admin/manage-food.php');
        }
        else
        {
            $_SESSION['fail-add']= "<div class='fail text-center'>food Fail to Add</div>";
            header("location:".SITEURL.'/admin/manage-food.php');
        }
    }
?>