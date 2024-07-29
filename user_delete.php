<?php

    session_start();

    include 'connect.php';

    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $deletesql = "DELETE FROM `registration1` WHERE Sr_No='$id'";
        $result = mysqli_query($con, $deletesql);
        if($result){ ?>
            <script>
                alert('Record Deleted Successfully...');
                location.replace('user_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Record Not Deleted...');
                location.replace('user_details.php');
            </script>
        <?php }
    }

?>