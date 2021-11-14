<?php include("parts/menu.php");?>
    <?php            
    if(isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    ?>
        <!---Category starts here--->
        <div class="main-content">
            <div class="wrapper">
                <strong>DASHBOARD</strong>
                <br>
                <div class="col text-center">
                    <?php
                        $sql="SELECT * FROM tbl_category";
                        $res=mysqli_query($conn,$sql);
                        $count=mysqli_num_rows($res);
                    ?>
                    <h2><?php echo $count;?></h2>
                    <br>
                    Category
                </div>

                <div class="col text-center">
                <?php
                        $sql1="SELECT * FROM tbl_food";
                        $res1=mysqli_query($conn,$sql1);
                        $count1=mysqli_num_rows($res1);
                    ?>
                    <h2><?php echo $count1;?></h2>
                    <br>
                    Foods
                </div>

                <div class="col text-center">
                <?php
                        $sql2="SELECT * FROM tbl_order";
                        $res2=mysqli_query($conn,$sql2);
                        $count2=mysqli_num_rows($res2);
                    ?>
                    <h2><?php echo $count2;?></h2>
                    <br>
                    Total Order
                </div>

                <div class="col text-center">
                <?php
                        $sql3="SELECT SUM(total) AS Total FROM tbl_order";
                        $res3=mysqli_query($conn,$sql3);
                        $row=mysqli_fetch_assoc($res3);
                        $total_revenue=$row['Total'];
                    ?>
                    <h2><?php echo $total_revenue;?></h2>
                    <br>
                    Revenue Generated
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!---Category Ends here--->
<?php include("parts/footer.php")?>