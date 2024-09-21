<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['deleteid'])){
        $payment_id = $_GET['deleteid'];

        $deletesql = "DELETE FROM `payment300` WHERE `Payment_Id`=$payment_id";
        $result = mysqli_query($con, $deletesql);
        if($result){ ?>
            <script>
                alert('Booking deleted successfully...');
                location.replace('booking_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Something went wrong...');
                location.replace('booking_details.php');
            </script>
        <?php }
    }

?>