<?php 
    //include contants file
    include('../config/constants.php');

    // echo "Delete Page";
    //check
    if(isset($_GET['id']) AND  isset($_GET['image_name']))
    {
        //get the value and delete
        $id =$_GET['id'];
        $image_name = $_GET['image_name'];


        //remove the physical image file 
        if($image_name != "")
        {
            //image is available so remove it
            $path = "../images/category/".$image_name;
            //remove the image
            $remove = unlink($path);

            if($remove == false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>False to remove category Image. </div>";

                header("location: " .SITEURL. "admin/manage-category.php");
                die();
                
            }
        }
        //delete data from database
        
        //SQL delete data 
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        //check whether the data is delete from database
        if($res == true)
        {
            $_SESSION['delete'] = "<div class='success'>Category Deletes Successfully.</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    
    }
    else
    {   
        //redirect to the manage category paqge
        header('location: '.SITEURL. 'admin/manage-category.php');
    }
?>