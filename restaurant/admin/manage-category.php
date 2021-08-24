<?php 
    include("parts/menu.php");
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if(isset($_SESSION['fail-add']))
    {
        echo $_SESSION['fail-add'];
        unset($_SESSION['fail-add']);
    }
    if(isset($_SESSION['fail-img']))
    {
        echo $_SESSION['fail-img'];
        unset($_SESSION['fail-img']);
    }
    if(isset($_SESSION['delete']))
    {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    if(isset($_SESSION['fail-delete']))
    {
        echo $_SESSION['fail-delete'];
        unset($_SESSION['fail-delete']);
    }
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }  
    if(isset($_SESSION['fail-update']))
    {
        echo $_SESSION['fail-update'];
        unset($_SESSION['fail-update']);
    }                
?>
    <div class="main-content">
        <div class="wrapper">
            <strong>MANAGE CATEGORY</strong>
            <br><br><br>
            <a class="btn" href="<?php echo SITEURL;?>/admin/add-category.php">Add Category</a>
            <br><br><br>
            <table class="table-adm">
                <tr>
                    <th>S.No</td>
                    <th>Title</td>
                    <th>Image Name</th>
                    <th>Featured</td>
                    <th>Active</td>
                    <th>Actions</th>
                </tr>
                <?php
                    $sql= " SELECT * FROM tbl_category";
                    $res= mysqli_query($conn,$sql);
                    $sn=1;
                    if($res==TRUE)
                    {
                        $count=mysqli_num_rows($res);
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $title=$row['title'];
                                $image_name=$row['image_name'];
                                $featured=$row['featured'];
                                $active=$row['active'];
                                ?>
                               <tr>
                                <td><?php echo $sn++;?></td>
                                <td><?php echo $title;?></td>

                                <td>
                                    <?php 
                                        if($image_name!="")
                                        {
                                            ?>
                                            <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name;?>" width="5%">
                                            <?php
                                        }
                                        else
                                        {
                                            echo "No image";
                                        }
                                    ?>
                                </td>
                                <td><?php echo $featured;?></td>
                                <td><?php echo $active;?></td>
                                <td>
                                    <a class="btn-primary" href="<?php echo SITEURL;?>/admin/update-category.php?id=<?php echo $id?>">Update</a>
                                    <a class="btn-secondary" href="<?php echo SITEURL;?>/admin/delete-category.php?id=<?php echo $id?>&image_name=<?php echo $image_name;?>">Delete</a>
                                </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            echo "<div class='fail text-center'>No Category Available</div>";
                        }
                    }
                ?>
            </table>
        </div>
    </div>

<?php include("parts/footer.php");?>