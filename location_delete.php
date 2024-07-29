<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deletequery = "DELETE FROM `location001` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
           <script>
                alert('Location Deleted Successfully...');
                location.replace('location_details.php');
           </script>
       <?php }
        else{ ?>
            <script>
                alert('Location Not Deleted...');
                location.replace('location_details.php');
            </script>
       <?php }
    }

?>