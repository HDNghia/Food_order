<?php
    session_start();

    define('SITEURL', 'http://localhost:8888/food-order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD); //Database connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($s)); //Selecting Database



// $jsonArr = array();
// $sql = "SELECT* FROM tbl_couponcode  where coupon_value = '$coupon_str' and $status = '1' ";
// //Execute the Query
// $res = mysqli_query($conn, $sql);
// $count = mysqli_num_rows($res);
// $ToTal = 0;
// if($count>0)
// {
//     echo "nghia";
//     $coupon_detail= mysqli_fetch_assoc($res);
//     $coupon_code =$coupon_detail['coupon_code'];
//     $coupon_value = $coupon_detail['coupon_value'];
//     $coupon_type = $coupon_detail['coupon_type'];
//     $cart_min_value = $coupon_detail['cart_min_value'];

//     // 
//     if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
//         if (sizeof($_SESSION['giohang']) > 0) {
//             $tong = 0;
//             for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
//                 $tt = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][3];
//                 $tong += $tt;
//                 //$hinh, $tensp, $gia, $soluong
               
//             }
            
//     }

//     // 
//     if($cart_min_value > sizeof($_SESSION['giohang']) )
//     {
//         $jsonArr=array('is_error'=>'yes', 'result'=>'Khong the dung coupon');
//     }
//     else{
//         if($coupon_type == "VND")
//         {
//             $ToTal = $tong - $coupon_value;
//         }
//         else{
//             $ToTal = $tong - (($tong*$coupon_value)/100);
//         }
//         $jsonArr=array('is_error'=>'no', 'result'=>'$ToTal');
//     }
// }
// else{
//     $jsonArr=array('is_error'=>'yes', 'result'=>'Khong co voucher nay');

// }
// echo json_encode($jsonArr);
// }

// $coupon_str=$_POST['coupon_str'];
$coupon_str = $_POST['coupon_str'];

$sql = "SELECT * FROM tbl_couponcode  ";
//Execute the Query
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
$ToTal = 0;
echo $count;
echo $coupon_str;
if($count > 0) 
{
   
    $coupon_detail= mysqli_fetch_assoc($res);
    $coupon_code =$coupon_detail['coupon_code'];
    $coupon_value = $coupon_detail['coupon_value'];
    $coupon_type = $coupon_detail['coupon_type'];
    $cart_min_value = $coupon_detail['cart_min_value'];
    echo json_encode(array(
        "statusCode"=>200,
    
        "value"=>$coupon_detail['coupon_value']
    ));
}
// $query=mysqli_query($conn,"select * from tbl_couponcode where coupon_code='$coupon_str' and status='1' ");
// $row=mysqli_fetch_assoc($query);


// // $jsonArr=array('is_error'=>'no', 'result'=>'$ToTal');
// if (mysqli_num_rows($query)>0){
// 	echo json_encode(array(
// 				"statusCode"=>200,
            
// 				"value"=>$row['coupon_value']
// 			));
// }
else{
	echo json_encode(array("statusCode"=>201));
}

?>