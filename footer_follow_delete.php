<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deletequery = "DELETE FROM `follow2` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
           <script>
                alert('footer Link has deleted successfully!');
                location.replace('footer_follow_details.php');
           </script>
       <?php }
        else{ ?>
            <script>
                alert('Something went wrong...');
                location.replace('footer_follow_details.php');
            </script>
       <?php }
    }

?>