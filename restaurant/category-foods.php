<?php
    include("parts-front/head.php");  
    $category_id=mysqli_real_escape_string($conn,$_GET['id']);
    $sql= "SELECT title FROM tbl_category WHERE id='$category_id'";
    $res = mysqli_query($conn,$sql);
    if($res==true)
    {
        $row=mysqli_fetch_assoc($res);
        $category_title=$row['title'];
    } 
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2 class="text-white">Foods on <a href="#" class="text-search">"<?php echo "$category_title";?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                $sql1= "SELECT * FROM tbl_food WHERE category_id=$category_id";
                $res1=mysqli_query($conn,$sql1);
                if($res1==true)
                {
                    $count=mysqli_num_rows($res1);
                    if($count>0)
                    {
                        while($row1=mysqli_fetch_assoc($res1))
                        {
                            $title=$row1['title'];
                            $image_name=$row1['image_name'];
                            $description=$row1['description'];
                            $price=$row1['price'];
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
                    else{
                        echo "<div class='fail text-center'>No Food Available</div>";
                    }
                }
            ?>

            <div class="clear"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include("parts-front/footer.php"); ?>