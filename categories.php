<?php include('partials-front/menu.php'); ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories food-menu">
        <div class="container">
            <h2 class="text-center">Mon ngon</h2>

            <?php
        //create SQL query to display categories from database
        $sql = "SELECT * FROM tbl_category WHERE active='yes'";
        //excute the Query
        $res =  mysqli_query($conn, $sql);
        //Count rows to check whether the category is available or not
        $count = mysqli_num_rows($res);
        //Check whether food available or not
        if ($count > 0) {
            //category Avallable
            while ($row = mysqli_fetch_assoc($res)) {
                //Get all the values
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
        ?>
                <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                    <div class="box-3 float-container">
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
                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                        ?>

                        <h3 class="float-text text-white"> <?php echo $title; ?></h3>
                    </div>
                </a>

        <?php
            }
        }
        ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
<?php include('partials-front/footer.php'); ?>