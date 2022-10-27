<?php 
    if (isset($_POST['submit'])) {
        $tensp = $_POST['food'];
        echo "$tensp";
        $soluong = $_POST['qty'];
        echo "$soluong";
        $hoten = $_POST['full-name'];
        echo "$hoten";
        $diachi = $_POST['contact'];
        echo "$diachi";
        $dienthoai=$_POST['address'];
        echo "$dienthoai";
        $email = $_POST['email'];
        echo "$email";
    }
?>