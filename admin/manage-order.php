<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage order</h1>
            
            <br /><br /><br />

            <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
            ?>
            <br><br>
            
            
            <!-- Button to add admin -->
            <a href="#" class="btn-primary">Add Order</a>
                <br/>   <br/>
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //Get all the orders from database
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";  //Display the Latest Order at First 
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the rows
                        $count = mysqli_num_rows($res);

                        $sn = 1;  //Create a Serial Number and set its initail value as 1

                        if($count > 0)
                        {
                            //Order Available
                            while($row = mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>

                                        <td>
                                            <?php

                                                //Ordered, On Delivery, Delivered, Cancelled

                                                if($status == "Ordered")
                                                {
                                                    echo "<label>$status</lable>";
    
                                                }
                                                else if($status == "On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</lable>";
                                                   
                                                }
                                                else if($status == "Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</lable>";
                                               
                                                }
                                                else if($status == "Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</lable>";
            
                                                }
                                            ?>
                                        </td>

                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Delete</a>
                                        </td>
                                    </tr>

                                <?php
                            }
                        }
                        else
                        {

                        }
                    ?>

                    
<!--
                    <tr>
                        <td>2.</td>
                        <td>Dua hau</td>
                        <td>Dua hau</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Dua hau</td>
                        <td>Dua hau</td>
                        <td>
                            <a href="#" class="btn-secondary">Update Admin</a>
                            <a href="#" class="btn-danger">Delete Admin</a>
                        </td>
                </tr>
-->
        </table>
    </div>
</div>

<?php include('partials/footer.php');?>
