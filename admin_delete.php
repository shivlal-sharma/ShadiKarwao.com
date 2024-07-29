<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $deletesql = "DELETE FROM `admin003` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletesql);
        if($result){ ?>
            <script>
                alert('Admin Deleted Successfully...');
                location.replace('admin_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Admin Not Deleted...');
                location.replace('admin_details.php');
            </script>
        <?php }
    }

?>