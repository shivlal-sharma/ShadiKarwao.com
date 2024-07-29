<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="admin_navbar_details.css?v=0">
    <link rel="stylesheet" href="user_details.css?v=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        include 'dash_navbar.php';
    ?>
    <nav>
        <div id="add">
            <a href="user_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="add_admin.php" id="submit1">Add Admin</a>
            <a href="contact_details.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>
    <div id="table">
        <table border="1">
            <thead>
                <tr>
                    <th>Sr. No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Token</th>
                    <th>Status</th>
                    <th>Time</th>
                    <th>Action<th>
                </tr>
            </thead>

            <?php

                include 'connect.php';

                $sql = "SELECT * FROM `admin003`";
                $result = mysqli_query($con, $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['Sr_No'];
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $email = $row['Email'];
                        $pass = $row['Password'];
                        $token = $row['token'];
                        $status = $row['status'];
                        $time = $row['Time'];

                        echo '
                        <tbody>
                        <tr>
                        <th>'.$id.'</th>
                        <td>'.$fname.'</td>
                        <td>'.$lname.'</td>
                        <td>'.$email.'</td>
                        <td>'.$pass.'</td>
                        <td>'.$token.'</td>
                        <td>'.$status.'</td>
                        <td>'.$time.'</td>
                        <td><button type="submit" id="update"><a href="admin_update.php?updateid='.$id.'">Update</a></button>
                        <button type="submit" id="delete"><a href="admin_delete.php?deleteid='.$id.'">Delete</a></button></td>
                    </tr>
                    <tbody>';
                    }
                }
            ?>

        </table>
    </div>
</body>
</html>