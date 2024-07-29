<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deletequery = "DELETE FROM `teammngr03` WHERE `Sr_No`='$id'";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
            <script>
                alert('Manager has been Deleted Successfully!...');
                location.replace('team_details.php');
            </script>
       <?php }
       else{ ?>
            <script>
                alert('Manager not Deleted...');
                location.replace('team_details.php');
            </script>
      <?php }
    }

?>