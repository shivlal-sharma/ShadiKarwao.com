<?php

    session_start();

    include 'connect.php';

    if(isset($_GET['token'])){
        $token = $_GET['token'];

        $updatequery = "UPDATE `admin003` SET `status`='active', `tokenExpire`='$time' where `token`='$token'";
        $query = mysqli_query($con, $updatequery);
        
        if($query){ ?>
               <script>
                alert('You have verified successfully...');
                location.replace('login_admin.php');
               </script>
       <?php }
        else{ ?>
            <script>
                alert('You are no longer verified...');
                location.replace('signup_admin.php');
            </script>
       <?php }
    }
?>