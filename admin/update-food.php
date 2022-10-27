<?php include('partials/menu.php'); ?>

<?php
//CHECK whether id is set or not
if(isset($_GET['id']))
{
    //Get all the details
    $id = $_GET['id'];

    //SQL query to get the selected food
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    //execute the query
    $res2 = mysqli_query($conn, $sql2);

    //Get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    //Get the individual values of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
}
else
{
    //Redirect to Manage Food
    header('location:'.SITEURL.'admin/manage-food.php');
}


?>



<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image == "")
                            {
                                //Image not available
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes") {echo"checked";} ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No">No

                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes") {echo"checked";} ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No">No

                    </td>
                </tr>            
               

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

        </table>


        </form>

        <?php
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $active = $_POST['active'];
                $featured = $_POST['featured'];
                
                
                //2. Upload the image if selected

                //check whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload button clicked
                    $image_name = $_FILES['image']['name']; //New Image Name

                    //Check whether the file is available or not
                    if($image_name!="")
                    {
                        //Image is Available
                        //a. upload the new image

                        //Rename the image
                        $ext = end(explode('.', $image_name)); //Gets the extention of the image

                        $image_name = "Food-Name-".rand(0000,9999).'.'.$ext; //This will be renamed image

                        //Get the source path and destination path
                        $src_path = $_FILES['image']['tmp_name']; //Source path
                        $dest_path = "../images/food/".$image_name; //Destination path

                        //upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        //check whether the image is uploaded or not
                        if($upload==false)
                        {
                            //Failed to upload
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                            //redirect to manage food
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //stop the process
                            die();
                        }
                        
                        //3. remove the image if new image is uploaded and current image exists
                        //b. remove current image if available
                        if($current_image!="")
                        {
                            //current image is available
                            //remove the image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //check whether the image is removed or not
                            if($remove==false)
                            {
                                //faile to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>Faile to remove current image.</div>";
                                //redirect to manage food
                                header('location:'.SITEURL.'admin/manage-food.php');
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Default image when image is not selected
                    }
                }
                else
                {
                    $image_name = $current_image; //Default image when button is not clicked
                }

                

                //4. Update the Food in database
                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //Execute the sql query
                $res3 = mysqli_query($conn, $sql3);

                //Check whether the query is executed or not
                if($res3==true)
                {
                    //Query executed and food update
                    $_SESSION['update'] = "<div class='success'>Food Update Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else
                {
                    //Faile to update food 
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
