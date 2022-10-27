<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br/>  <br/>
            <!-- Button to add admin -->
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary" >Add Category</a>
                <br/>   <br/>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        //create a sql query to get all the food
                        $sql = "SELECT * FROM tbl_category";

                        //Execute the query
                        $res = mysqli_query($conn, $sql);

                        //count rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //create serial number variable and set default value as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have food in database
                            //get the foods from database and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        
                                        <td>
                                            <?php 
                                                //check whether we have image or not
                                                if($image_name=="")
                                                {
                                                    //we do not have image, display error message
                                                    echo "<div class='error'>Image not Added.</div>";
                                                }
                                                else
                                                {
                                                    //we have image, display image
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                        </td>
                                     </tr>
                                <?php
                            }
                        }
                        else
                        {
                            //category not added in database
                            echo "<tr> <td colspan='7' class='error'> category not Added Yet.</td> </tr>";
                        }
                    ?>
        </table>
    </div>
</div>

<?php include('partials/footer.php');?>