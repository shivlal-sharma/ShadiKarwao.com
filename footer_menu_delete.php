<?php

    session_start();

    include 'connect.php';

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deletequery = "DELETE FROM `menu1` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
           <script>
                alert('Menu has been Deleted Successfully...');
                location.replace('footer_menu_details.php');
           </script>
       <?php }
        else{ ?>
            <script>
                alert('Menu Not Deleted...');
                location.replace('footer_menu_details.php');
            </script>
       <?php }
    }

?>