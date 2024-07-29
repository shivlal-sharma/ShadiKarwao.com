<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $deletequery = "DELETE FROM `details3` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
           <script>
                alert('Details has been Deleted Successfully...');
                location.replace('details_details3.php');
           </script>
       <?php }
        else{ ?>
            <script>
                alert('Details Not Deleted...');
                location.replace('details_details3.php');
            </script>
       <?php }
    }

?>