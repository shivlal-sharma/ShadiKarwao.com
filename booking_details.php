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
            <a href="footer_contact_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="booking_add.php" id="submit1">Add Booking</a>
            <a href="dashboard.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>
    <div id="table">
        <table border="1">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Location Name</th>
                    <th>Location Image</th>
                    <th>Capacity</th>
                    <th>Price</th>
                    <th>Wedding Date</th>
                    <th>Transaction Id</th>
                    <th>Booking Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            
            <?php

                include 'connect.php';

                $sql = "SELECT * FROM `payment300`";
                $result = mysqli_query($con, $sql);
                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row['Id'];
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $email = $row['Email'];
                        $location_name = $row['Location_Name'];
                        $location_image = $row['Location_Image'];
                        $capacity = $row['Capacity'];
                        $price = $row['Price'];
                        $wed_date = $row['Wed_Date'];
                        $transaction = $row['Transaction_Id'];
                        $date = $row['Date'];

                        echo '
                        <tbody>
                        <tr>
                        <td>'.$id.'</td>
                        <td>'.$fname." ".$lname.'</td>
                        <td>'.$email.'</td>
                        <td>'.$location_name.'</td>
                        <td><img src=location_img/'.$location_image.' height=100 width=100></td>
                        <td>'.number_format($capacity).' People</td>
                        <td>Rs.'.number_format($price).'/-</td>
                        <td>'.$wed_date.'</td>
                        <td>'.$transaction.'</td>
                        <td>'.$date.'</td>
                        <td><button type="submit" id="update"><a href="booking_update.php?updateid='.$id.'">Update</a></button>
                        <button type="submit" id="delete"><a href="booking_delete.php?deleteid='.$id.'">Delete</a></button></td>
                    </tr>
                    <tbody>';
                    }
                }
            ?>

        </table>
    </div>
</body>
</html>