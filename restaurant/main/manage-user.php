<?php 
    include("parts/menu.php");
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
            <strong>MANAGE USER</strong>
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
                            <td><a onclick="return confirm('are you sure you want to Update Details?')"class="btn-primary" href="<?php echo SITEURL;?>/main/update-user.php?id=<?php echo $id?>">Update</a>
                                <a onclick="return confirm('are you sure you want to Update Password?')" class="btn-thrd" href="<?php echo SITEURL;?>/main/update-password.php?id=<?php echo $id?>">Change Password</a>
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
            <br>
            <p><b>In case any problems or To Delete User contact Admin. Thanks.</b></p>
        </div>
    </div>
<?php include("parts/footer.php")?>