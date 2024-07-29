<?php

    session_start();

    include 'connect.php';

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deletesql = "DELETE FROM `contact363` WHERE Sr_No='$id'";
        $result = mysqli_query($con, $deletesql);
        if($result){ ?>
            <script>
                alert('Message Deleted Successfully...');
                location.replace('contact_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Message Not Deleted...');
                location.replace('contact_details.php');
            </script>
        <?php }
    }

?>