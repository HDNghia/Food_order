<?php
    //Authorization - Access control
    //CHeck whether the user is logged in or not
    if(!isset($_SESSION['user'])) //IF user session is not set
     {
        //user is not logged in
        //REdirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error text-center' >Please login to access Admin Panel.</div>";
        //REdirect to Login Page
       header('location:'.SITEURL. 'admin/login.php');
     } 
?>