<?php

    session_start();

    include 'connect.php';

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deletequery = "DELETE FROM `mycontact36` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
           <script>
                alert('MyContact has been Deleted Successfully...');
                location.replace('footer_contact_details.php');
           </script>
       <?php }
        else{ ?>
            <script>
                alert('MyContact Not Deleted...');
                location.replace('footer_contact_details.php');
            </script>
       <?php }
    }

?>