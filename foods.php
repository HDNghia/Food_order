<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php 
                $sql = "SELECT * FROM tbl_food where active='Yes'";
                //excute the Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);
                //Check whether food available or not
                if ($count > 0) {
                    //Food Avallable
                    while ($row = mysqli_fetch_assoc($res)) 
                    {
                        //Get all the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
        
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
                        <p><?php echo $description ?></p>
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