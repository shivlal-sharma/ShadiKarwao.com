<?php
    session_start();
    include 'connect.php';

    if (isset($_GET['deleteid'])) {
        $id = intval($_GET['deleteid']); // Ensure $id is sanitized

        // Check if the logged-in admin is deleting their own account
        if (isset($_SESSION['admin_id']) && $_SESSION['admin_id'] == $id) {
            // Delete the admin's account
            $deletesql = "DELETE FROM `admin003` WHERE `Sr_No`=$id";
            $result = mysqli_query($con, $deletesql);

            if ($result) {
                // Destroy session and log out the admin
                session_destroy();
                ?>
                <script>
                    alert('Your account has been deleted. Logging out...');
                    location.replace('login_admin.php'); // Redirect to login page
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert('Something went wrong...');
                    location.replace('admin_details.php');
                </script>
                <?php
            }
        } else {
            // Delete another admin's account
            $deletesql = "DELETE FROM `admin003` WHERE `Sr_No`=$id";
            $result = mysqli_query($con, $deletesql);

            if ($result) {
                ?>
                <script>
                    alert('Admin deleted successfully!');
                    location.replace('admin_details.php');
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert('Something went wrong...');
                    location.replace('admin_details.php');
                </script>
                <?php
            }
        }
    }
?>