<?php

    session_start();

    include 'connect.php';

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deletequery = "DELETE FROM `follow2` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
           <script>
                alert('Link has been Deleted Successfully...');
                location.replace('footer_follow_details.php');
           </script>
       <?php }
        else{ ?>
            <script>
                alert('Link Not Deleted...');
                location.replace('footer_follow_details.php');
            </script>
       <?php }
    }

?>