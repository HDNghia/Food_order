<?php include('partials-front/menu.php'); ?>

<?php
//Check whether food id is set or not
if (isset($_GET['category_id'])) {
    //Get the Food id and details of the selected food
    $category_id = $_GET['category_id'];

    //Get the details of the selected food
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    //get the value from Database
    $row = mysqli_fetch_assoc($res);
    //get the title
    $category_title = $row['title'];
    //Check whether the data is available or not
} else {
    //Redirect to homepage
    header('location:' . SITEURL);
}
?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white"><?php echo $category_title ?></a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php 
                $sql2 = "SELECT * FROM tbl_food where category_id = $category_id";
                //excute the Query
                $res2 = mysqli_query($conn, $sql2);
                //Count Rows
                $count2 = mysqli_num_rows($res2);
                //Check whether food available or not
                if ($count2 > 0) {
                    //Food Avallable
                    while ($row2 = mysqli_fetch_assoc($res2)) 
                    {
                        //Get all the values
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
        
                ?>
        
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                    //check whether image available or not
                                    if($image_name=="")
                                    {
                                        //image not available
                                        echo "<div class='error'>Image not available.</div>";
                                    }
                                    else
                                    {
                                        //image available
                                        ?>
                                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                    
                            </div>
                            <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?> VND</p>
                        
                        <form action="cart.php" method="post">
                        <input type="number" name="soluong" id="soluong" min="1" max="10" value="1" ><br><br>
                            <input type="submit" name="addcart" value="Add cart" class=" btn-cart" style="float: left; margin-top: -4px">
                            <input type="hidden" name="tensp" id="tensp" value="<?php echo $title; ?>">
                            <input type="hidden" name="gia" id="gia" value="<?php echo $price; ?>">
                            <input type="hidden" name="hinh" id="hinh" value="<?php echo $image_name; ?> ">
                        </form>
                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary" style="margin-left: 4px">Order now</a>
                        
                    </div>
                        </div>
        
                <?php
                    }
                } else {
                    //food Not Available
                    echo "<div class='error'>Food not available</div>";
                }
                ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>