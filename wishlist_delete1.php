<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['delete'])){
        $location_id = $_GET['delete'];

        $deletequery = "DELETE FROM `wishlist30` WHERE `Location_Id`=$location_id";
        $result = mysqli_query($con, $deletequery);
        if($result){ ?>
            <script>
                alert('Lacation has been removed from the Wishlist!...');
                location.replace('wishlist_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Location not been removed from the Wishlist...');
                location.replace('wishlist_details.php'); 
            </script>
        <?php }
    } ?>
            