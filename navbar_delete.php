<?php
    session_start();
    include 'connect.php';
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $deletesql = "DELETE FROM `navbar363` WHERE Sr_No=$id";
        $result = mysqli_query($con, $deletesql);
        if($result){ ?>
            <script>
                alert('Link has deleted successfully!');
                location.replace('navbar_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Something went wrong...');
                location.replace('navbar_details.php');
            </script>
        <?php }
    }
?>