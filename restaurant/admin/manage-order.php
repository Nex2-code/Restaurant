<?php 
    include("parts/menu.php");
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
?>              
    <div class="main-content">
        <div class="wrapper">
            <strong>Manage Order</strong>
            <table class="table-adm">
                <br><br><br>
                    <tr>
                        <th>S.No</td>
                        <th>Food</td>
                        <th>qty</th>
                        <th>Order Date</td>
                        <th>Customer Name</td>
                        <th>Customer Contact</th>
                        <th>Customer Email</th>
                        <th>Customer Address</th>
                        <th>Action</th>
                    </tr>
                    
                <?php
                    $sql="SELECT * FROM tbl_order ORDER BY id DESC";
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
                                $food=$row['food'];
                                $qty=$row['qty'];
                                $order_date=$row['order_date'];
                                $customer_name=$row['customer_name'];
                                $customer_contact=$row['customer_contact'];
                                $customer_email=$row['customer_email'];
                                $customer_address=$row['customer_address'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $qty; ?></td>
                                <td><?php echo $order_date; ?></td>
                                <td><?php echo $customer_name; ?></td>
                                <td><?php echo $customer_contact; ?></td>
                                <td><?php echo $customer_email; ?></td>
                                <td><?php echo $customer_address; ?></td>
                                <td>
                                    <a onclick="return confirm('are you sure you want to delete?')" class="btn-secondary" href="<?php echo SITEURL;?>/admin/delete-order.php?id=<?php echo $id;?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                            }
                        }
                    }
                ?>
                </table>
            </div>
        </div>
<?php include("parts/footer.php")?>