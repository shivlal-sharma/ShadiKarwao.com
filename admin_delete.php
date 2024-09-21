<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $deletesql = "DELETE FROM `admin003` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletesql);
        if($result){ ?>
            <script>
                alert('Admin deleted successfully!');
                location.replace('admin_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Something went wrong...');
                location.replace('admin_details.php');
            </script>
        <?php }
    }
?>