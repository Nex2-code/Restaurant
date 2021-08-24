<?php
    include("parts-front/head.php");    
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>/food-search.php" method="POST" >
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql= "SELECT * FROM tbl_food";
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
                            $description=$row['description'];
                            $price=$row['price'];
                            ?>
                            <div class="food-box">      
                                <div class="food-img">
                                    <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name;?>" class="img-resp img-curve">
                                </div>
                                    <div class="food-desc">
                                        <h4><?php echo $title;?></h4>
                                        <p class="food-price">$<?php echo $price;?></p>
                                        <p class="food-det"><?php echo $description;?></p>
                                        <br>
                                        <a href="<?php echo SITEURL;?>/order.php?food_id=<?php echo $id;?>" class="btn text-black">Buy Now</a>
                                    </div>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        echo "<div class='fail text-center'>No Food Available</div>";
                    }
                }
                ?>
            <div class="clear"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include("parts-front/footer.php"); ?>