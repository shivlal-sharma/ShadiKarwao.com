<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $deletesql = "DELETE FROM `payment300` WHERE `Id`=$id";
        $result = mysqli_query($con, $deletesql);
        if($result){ ?>
            <script>
                alert('Booking Deleted Successfully...');
                location.replace('booking_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Booking Not Deleted...');
                location.replace('booking_details.php');
            </script>
        <?php }
    }

?>