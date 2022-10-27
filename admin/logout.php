<?php 

    //Include constants.php for SITEURI
    include('../config/constants.php');
    //1. Destory the Session
        session_destroy(); //unset $_SESSION['user']
    //2. REdirect to Login Page
        header ('location:'.SITEURL.'admin/login.php');
?>