<?php
    include("parts-front/head.php");
    $food_id=mysqli_real_escape_string($conn,$_GET['food_id']);
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res=mysqli_query($conn,$sql);
    if($res==true)
    {
        $count=mysqli_num_rows($res);
        if($count==1)
        {
            $row=mysqli_fetch_assoc($res);
            $food_title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
        }
        else
        {
            header('location:'.SITEURL.'/index.php');
        }
    } 
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="order">
            
            <h2 class="text-center text-black">Fill this form to confirm your order.</h2>

            <form action="" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-img">
                    <img src="<?php echo SITEURL;?>/images/category/<?php echo $image_name;?>" class="img-resp img-curve">
                    </div>
    
                    <div class="food-desc1">
                        <h3><?php echo $food_title;?></h3>
                        <input type="hidden" name="food" value="<?php echo $food_title;?>">
                        <p class="food-price1">$<?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div>Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter your name" required>

                    <div>Phone Number</div>
                    <input type="tel" name="contact" placeholder="Phone number" required>

                    <div>Email</div>
                    <input type="email" name="email" placeholder="Email adress" required>

                    <div>Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" required></textarea>
                    <br><br>
                    <input onclick="return confirm('Press ok to confirm your order')" type="submit" name="submit" value="Confirm Order" class="btn">
                    <br><br>
                </fieldset>

            </form>

        </div>
    </section>

    <?php
     if(isset($_POST['submit']))
     {
         $food=mysqli_real_escape_string($conn,$_POST['food']);
         $price=mysqli_real_escape_string($conn,$_POST['price']);
         $qty=mysqli_real_escape_string($conn,$_POST['qty']);
         $total=$qty*$price;
         $status="Pending";
         $customer_name=mysqli_real_escape_string($conn,$_POST['full-name']);
         $customer_contact=mysqli_real_escape_string($conn,$_POST['contact']);
         $customer_email=mysqli_real_escape_string($conn,$_POST['email']);
         $customer_address=mysqli_real_escape_string($conn,$_POST['address']);
 
         $sql2= "INSERT INTO tbl_order SET
                 food='$food',
                 price=$price,
                 qty=$qty,
                 total=$total,
                 status='$status',
                 customer_name='$customer_name',
                 customer_contact='$customer_contact',
                 customer_email='$customer_email',
                 customer_address='$customer_address'
                 ";
         $res2=mysqli_query($conn,$sql2) or die(mysqli_error($conn));
         if($res2==true)
         {
             $_SESSION['order']="<div class='success text-center'><b>Order Successfully placed</b></div>";
             header("location:".SITEURL.'/index.php');
         }
         else
         {
             $_SESSION['fail-order']= "<div class='fail text-center'><b>OrderFail try again</b></div>";
             header("location:".SITEURL.'/index.php');
         }
     }
     ?>
    <!-- fOOD sEARCH Section Ends Here -->
<?php
     include("parts-front/footer.php");
?>