<?php
    include("parts-front/head.php");
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
    if(isset($_SESSION['fail-order']))
    {
        echo $_SESSION['fail-order'];
        unset($_SESSION['fail-order']);
    }   
?>
    <!--Food Search section starts here-->
    <section class="food-search text-center">
        <div class="container">
            <form action="<?php echo SITEURL;?>/food-search.php" method="POST" >
                <input type="search" name="search" placeholder="Search for food">
                <input type="submit" name="submit" value="Search" class="btn">
            </form>
        </div>
    </section>
    <!--Food Search section Ends here-->
    <!--Categories section starts here-->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Categories</h2>
             <?php
                $sql= "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
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
                                    <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name;?>" class="img-resp img-curve">
                                    <h3 class="img-text text-white"><?php echo $title;?></h3>
                                </div>
                            </a>
                            <?php
                        }
                    }
                    else{
                        echo "<div class='fail text-center'>No Category Available</div>";
                    }
                }           
             ?> 
            <div class="clear"></div>
        </div>
    </section>
    <!--Categories section Ends here-->


    <!--Food Menu section starts here-->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2><br>
            <?php
                $sql= "SELECT * FROM tbl_food WHERE active='Yes' LIMIT 6";
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
                                        <h4 class="food-head"><?php echo $title;?></h4>
                                        <p class="food-price">$<?php echo $price;?></p>
                                        <p class="food-det"><?php echo $description;?></p><br>
                                        <a class="btn text-black" href="<?php echo SITEURL;?>/order.php?food_id=<?php echo $id;?>">Buy Now</a> 
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
<?php include("parts-front/footer.php"); ?>