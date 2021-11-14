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
    if(isset($_SESSION['pas-update']))
    {
        echo $_SESSION['pas-update'];
        unset($_SESSION['pas-update']);
    }
    if(isset($_SESSION['no-user']))
    {
        echo $_SESSION['no-user'];
        unset($_SESSION['no-user']);
    }
    if(isset($_SESSION['fail-pas-update']))
    {
        echo $_SESSION['fail-pas-update'];
        unset($_SESSION['fail-pas-update']);
    }
?>              
    <div class="main-content">
        <div class="wrapper">
            <strong>MANAGE CATEGORY</strong>
            <br><br><br>
            <a class="btn" href="add-admin.php">Add Admin</a>&nbsp<a class="btn" href="../admin/add-user.php">Add User</a>
            <br><br><br>
            <table class="table-adm">
                <tr>
                    <th>S.No</td>
                    <th>Full Name</td>
                    <th>username</th>
                    <th>Actions</th>
                </tr>
            <?php
                $sql="SELECT * FROM tbl_user";
                $res=mysqli_query($conn,$sql);
                $sn=1;
                if($res==TRUE)
                {
                    $count=mysqli_num_rows($res);
                    
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $full_name=$row['full_name'];
                            $username=$row['username'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td><a onclick="return confirm('are you sure you want to Update Details?')"class="btn-primary" href="<?php echo SITEURL;?>/admin/update-user.php?id=<?php echo $id?>">Update</a>
                                <a onclick="return confirm('are you sure you want to delete?')" class="btn-secondary" href="<?php echo SITEURL;?>/admin/delete-user.php?id=<?php echo $id;?>">Delete</a>
                                <a onclick="return confirm('are you sure you want to Update Password?')" class="btn-thrd" href="<?php echo SITEURL;?>/admin/update-password.php?id=<?php echo $id?>">Change Password</a>
                            </td>
                        </tr>
                        <?php
                        }
                    }
                    else
                    {
                        echo "<div class='fail text-center'>No Admin Available</div>";
                    }
                }
            ?>
            </table>
            <table class="table-adm">
                <tr>
                    <th>S.No</td>
                    <th>Full Name</td>
                    <th>username</th>
                </tr>
            <?php
                $sql="SELECT * FROM tbl_admin";
                $res=mysqli_query($conn,$sql);
                $sn=1;
                if($res==TRUE)
                {
                    $count=mysqli_num_rows($res);
                    
                    if($count>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id=$row['id'];
                            $full_name=$row['full_name'];
                            $username=$row['username'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                        </tr>
                        <?php
                        }
                    }
                    else
                    {
                        echo "<div class='fail text-center'>No Admin Available</div>";
                    }
                }
            ?>
            </table>
        </div>
    </div>
<?php include("parts/footer.php")?>