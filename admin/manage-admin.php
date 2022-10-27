<?php include('partials/menu.php'); ?>

<!-- main content section starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage admin</h1>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //Displaying Session Message
            unset($_SESSION['add']); //REmoving Session Message
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete']; //Displaying Session Message
            unset($_SESSION['delete']); //REmoving Session Message
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];   //Displaying Session Message
            unset($_SESSION['update']); //REmoving Session Message
        }
        if (isset($_SESSION['user-not-found'])) {
            echo $_SESSION['user-not-found']; //Displaying Session Message
            unset($_SESSION['user-not-found']); //REmoving Session Message
        }
        if(isset($_SESSION['pwd-not-match'])){
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if(isset($_SESSION['change-pwd'])){
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>
        <br /> <br />
        <!-- Button to add admin -->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br /> <br /> <br />

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php
            //Query to Get all Admin
            $sql = "SELECT* FROM tbl_admin";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //CHeck whether the Query is Executed of Not
            if ($res == TRUE) {
                // Count Rows to CHeck whether we have data in database or not
                $count = mysqli_num_rows($res); // Function to get all the rows in database

                $sn = 1; //Create a Variable and Assign the value

                //CHeck the num of rows
                if ($count > 0) {
                    //WE HAVE data in database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //using while loop to get all the data from database.
                        //And while loop will run as long as we have data in database

                        //Get individual DAta
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];
                        //Display the Values in our Table

            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo $username; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                            </td>
                        </tr>

            <?php
                    }
                } else {
                }
            }
            ?>
        </table>
    </div>
</div>
<!-- main content setction ends -->

<!-- footer section starts -->
<?php include('partials/footer.php'); ?>