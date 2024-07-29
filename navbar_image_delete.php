<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $deletesql = "DELETE FROM `navbar4` WHERE Sr_No=$id";
        $result = mysqli_query($con, $deletesql);
        if($result){ ?>
            <script>
                alert('Image has been Deleted Successfully...');
                location.replace('navbar_image_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Image Not Deleted...');
                location.replace('navbar_image_details.php');
            </script>
        <?php }
    }

?>