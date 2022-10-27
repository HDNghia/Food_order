<?php include('partials-front/menu.php'); ?>
<div class="food-menu">
    <form action="order.php" method="POST">
        <?php
        if (!isset($_SESSION['giohang'])) $_SESSION['giohang'] = [];
        //làm rỗng giỏ hàng
        if (isset($_GET['delcart']) && ($_GET['delcart'] == 1)) unset($_SESSION['giohang']);
        //xóa sp trong giỏ hàng
        if (isset($_GET['delid']) && ($_GET['delid'] >= 0)) {
            array_splice($_SESSION['giohang'], $_GET['delid'], 1);
        }
        //lấy dữ liệu từ form
        if (isset($_POST['tensp'])) {
            $hinh = $_POST['hinh'];
            $tensp = $_POST['tensp'];
            $gia = $_POST['gia'];
            $soluong = $_POST['soluong'];
            //kiem tra sp co trong gio hang hay khong?

            $fl = 0; //kiem tra sp co trung trong gio hang khong?

            for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {

                if ($_SESSION['giohang'][$i][1] == $tensp) {
                    $fl = 1;
                    $soluongnew = $soluong + $_SESSION['giohang'][$i][3];
                    $_SESSION['giohang'][$i][3] = $soluongnew;
                    break;
                }
            }
            //neu khong trung sp trong gio hang thi them moi
            if ($fl == 0) {
                //them moi sp vao gio hang
                $sp = [$hinh, $tensp, $gia, $soluong];
                $_SESSION['giohang'][] = $sp;
            }

            // var_dump($_SESSION['giohang']);
            header('location:' . SITEURL . 'index.php');
        }

        function showgiohang()
        {
            if (isset($_SESSION['giohang']) && (is_array($_SESSION['giohang']))) {
                if (sizeof($_SESSION['giohang']) > 0) {
                    $tong = 0;
                    for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                        $tt = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][3];
                        $tong += $tt;
                        //$hinh, $tensp, $gia, $soluong
                        echo '<tr>
                            <td>' . ($i + 1) . '</td>
                            <td><img src="images/food/' . $_SESSION['giohang'][$i][0] . '" alt=""></td>
                            <td>' . $_SESSION['giohang'][$i][1] . ' </td>
                            <td>' . $_SESSION['giohang'][$i][2] . ' VND</td>
                            <td>' . $_SESSION['giohang'][$i][3] . ' </td>
                            <td>
                                <div>' . $tt . ' VND</div>
                            </td>
                            <td>
                                <a href="cart.php?delid=' . $i . '">Xóa</a>
                            </td>
                        </tr>';
                    }
                    echo '<tr>
                        <th colspan="5">Tổng đơn hàng</th>
                        <th>
                            <div>' . $tong . ' VND</div>
                        </th>
    
                    </tr>';
                } else {
                    echo "Giỏ hàng rỗng!";
                }
            }
        }
        ?>
        <div class="container">
            <div class="row mb ">
                <div class="boxtrai mr" id="bill">
                    <div class="row">
                        <h1>THÔNG TIN NHẬN HÀNG</h1>
                        <table class="thongtinnhanhang">
                            <tr>
                                <td width="20%">Họ tên</td>
                                <td><input type="text" name="full-name" required></td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td><input type="text" name="address" required></td>
                            </tr>
                            <tr>
                                <td>Điện thoại</td>
                                <td><input type="text" name="contact" required></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="text" name="email" required></td>
                            </tr>
                        </table>
                    </div>
                    <div class="row mb">
                        <h1>GIỎ HÀNG</h1>
                        <table>
                            <tr>
                                <th>STT</th>
                                <th>Hình</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền ($)</th>
                                <th>Xóa</th>
                            </tr>
                            <?php showgiohang(); ?>
                        </table>
                    </div>
                    <!-- Lấy tên thức ăn trong card -->
                    <div id="op">

                    </div>
                    <script>
                        var op = document.getElementById('op');
                        var p = document.createElement("p");
                        p.innerHTML = "<input type='hidden' name='food' id='tensp' value='<?php
                                                                                            for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                                                                                                echo $_SESSION['giohang'][$i][1];
                                                                                                echo "(";
                                                                                                echo $_SESSION['giohang'][$i][3];
                                                                                                echo ") ";
                                                                                            }
                                                                                            ?>'>";
                        op.appendChild(p);
                    </script>

                    <!-- Lấy giá tiền -->
                    <?php
                    $tong = 0;
                    for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                        $tt = $_SESSION['giohang'][$i][2] * $_SESSION['giohang'][$i][3];
                        $tong += $tt;
                    } ?>
                    <input type="hidden" name="priced" id="gia" value='<?php echo $tong; ?>'>
                    <!-- Lấy số lượng -->
                    <?php
                    $soluong = 0;
                    for ($i = 0; $i < sizeof($_SESSION['giohang']); $i++) {
                        $soluong = $soluong + $_SESSION['giohang'][$i][3];
                    }
                    ?>
                    <input type="hidden" name="qty" id="soluong" value="<?php echo $soluong ?>">
                    <div class="row mb">
                        <input type="submit" name="submit" value="ĐỒNG Ý ĐẶT HÀNG" name="dongydathang">
                        <a href="cart.php?delcart=1"><input class="btn-delete-cart" type="button" value="XÓA GIỎ HÀNG"></a>
                        <a href="index.php"><input class="btn-cart" type="button" value="TIẾP TỤC ĐẶT HÀNG"></a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="clearfix"></div>
</div>
<?php include('partials-front/footer.php'); ?>