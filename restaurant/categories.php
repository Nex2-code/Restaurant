<?php
    include("parts-front/head.php");    
?>
    <!-- CAtegories Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <h2 class="text-center text-white">Explore Foods</h2>
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
                            $image_name=$row['image_name'];
                            ?>
                            <a href="<?php echo SITEURL;?>/category-foods.php?id=<?php echo $id;?>">
                            <div class="box-3 img-container">
                                <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name;?>" class="img-resp img-curve border-white">
                                <h3 class="img-text text-white"><?php echo $title;?></h3>
                            </div>
                            </a>
                            <?php
                        }
                    }
                    else
                    {
                        echo "<div class='fail text-center'>No Category Available</div>";
                    }
                }
                ?>       
            <div class="clear"></div>
        </div>
    </section><br><br>
    <!-- Categories Section Ends Here -->
<?php include("parts-front/footer.php"); ?>