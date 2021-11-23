<?php 
    include("parts/menu.php");
?>
    <div class="main-content">
        <div class="wrapper">
            <strong>Update Order</strong>
            <?php
                        if(isset($_GET['id']))
                        {
                            $id=mysqli_real_escape_string($conn,$_GET['id']);
                            $sql="SELECT * FROM tbl_order WHERE id=$id";
                            $res=mysqli_query($conn,$sql);
                            {
                                $count=mysqli_num_rows($res);
                                if($count==1)
                                {
                                    $row=mysqli_fetch_assoc($res);
                                    $status=$row['status'];

                                }
                                else
                                {
                                    header('location:'.SITEURL.'/admin/manage-order.php');
                                }
                            }
                        } 
                    ?>
            <form action="" method="POST">
                <table class="tbl-add-admin">
                    <tr>
                        <td>Stauts:</td>
                        <td><input <?php if($status=="Pending"){echo "checked";} ?> type="radio" name="status" value="Pending">&nbsp Pending</td>
                        <td><input <?php if($status=="Out For Delivery"){echo "checked";} ?> type="radio" name="status" value="Out For Delivery">&nbsp Out For Delivery</td>
                        <td><input <?php if($status=="Delivered"){echo "checked";} ?> type="radio" name="status" value="Delivered">Delivered</td>
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
        $status=$_POST['status'];
        $sql1="UPDATE tbl_order SET status='$status' WHERE id=$id";
        $res1=mysqli_query($conn,$sql1) or die(mysqli_error($conn));
        if($res1==true)
        {
            $_SESSION['update']="<div class='success text-center'>Status Updated</div>";
            header('location:'.SITEURL.'/admin/manage-order.php');
        }
        else
        {
            $_SESSION['fail-update']="<div class='fail text-center'>Fail to Update</div>";
            header('location:'.SITEURL.'/admin/manage-order.php');   
        }

    }

?>