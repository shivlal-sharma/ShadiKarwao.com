<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $deletequery = "DELETE FROM `content33` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
           <script>
                alert('Content has been Deleted Successfully...');
                location.replace('content_details.php');
           </script>
       <?php }
        else{ ?>
            <script>
                alert('Location Not Deleted...');
                location.replace('content_details.php');
            </script>
       <?php }
    }

?>