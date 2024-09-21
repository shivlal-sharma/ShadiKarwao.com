<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $deletequery = "DELETE FROM `details2` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
           <script>
                alert('Details has deleted successfully!');
                location.replace('details_details2.php');
           </script>
       <?php }
        else{ ?>
            <script>
                alert('Something went wrong...');
                location.replace('details_details2.php');
            </script>
       <?php }
    }

?>