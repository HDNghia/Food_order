<?php
    //Include constants Page
    include('../config/constants.php');

    //echo "Delete Food pahe";

    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'
    {
        //process to detele
        //echo "Process to Detele";

        //1.Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the Image if vailable
        //check whether the image is available or not and detele only if available
        if($image_name != "")
        {
            // IT has image and need to remove from folder
            //get the image path
            $path = "../images/food/".$image_name;

            //remove image file from folder
            $remove = unlink($path);

            //check whether the image is removed or not
            if($remove==false)
            {
            //failed to remove image
            $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
            //Redirect to Manage food
            header('location:'.SITEURL.'admin/manage-food.php');
            //Stop the process of deteling food
            die();
            }
        }

        //3. Detele food from database
        $sql = "DELETE FROM tbl_food WHERE id=$id";
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not and set the session message respectively
        //4. Redirect to manage food with session message
        if($res==true)
        {
            //food delete 
            $_SESSION['delete'] = "<div class='success'>Food Deteled Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            //failed to detele food
            $_SESSION['delete'] = "<div class='error'>Failed to Detele Food.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        

    }
    else
    {
        //Redirect to manage food page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>