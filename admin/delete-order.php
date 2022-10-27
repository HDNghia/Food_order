<?php
    //Include constants Page
    include('../config/constants.php');

    //echo "Delete order";

    if(isset($_GET['id'])) //Either use '&&' or 'AND'
    {
        //process to detele
        //echo "Process to Detele";

        //1.Get ID and Image Name
        $id = $_GET['id'];

        //2. Detele order from database
        $sql = "DELETE FROM tbl_order WHERE id=$id";
        //Execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executed or not and set the session message respectively
        //3. Redirect to manage food with session message
        if($res==true)
        {
            //food delete 
            $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        else
        {
            //failed to detele food
            $_SESSION['delete'] = "<div class='error'>Failed to Detele Order.</div>";
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        

    }
    else
    {
        //Redirect to manage food page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }

?>