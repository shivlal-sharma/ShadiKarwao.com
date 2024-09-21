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
    <title>Booking Details</title>
    <link rel="stylesheet" href="admin_navbar_details.css">
    <link rel="stylesheet" href="user_details.css">
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
            <a href="navbar_image_details.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>
    <?php
        include 'connect.php';
        $sql = "SELECT * FROM `admin003`";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0){
            echo "<table>
                    <thead>
                        <tr>
                            <th>Admin Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th>Action<th>
                        </tr>
                    </thead>
                    <tbody>";
            while($row = mysqli_fetch_assoc($result)){
                $admin_id = $row['Sr_No'];
                $fname = $row['FirstName'];
                $lname = $row['LastName'];
                $email = $row['Email'];
                $status = $row['status'];
                $time = $row['Time'];

                echo '<tr>
                        <td>'.$admin_id.'</td>
                        <td>'.$fname.'</td>
                        <td>'.$lname.'</td>
                        <td>'.$email.'</td>
                        <td>'.$status.'</td>
                        <td>'.$time.'</td>
                        <td><button type="submit" id="update"><a href="admin_update.php?updateid='.$admin_id.'">Update</a></button>
                        <button type="submit" id="delete"><a href="admin_delete.php?deleteid='.$admin_id.'">Delete</a></button></td>
                    </tr>';
            }
            echo "</tbody>
                </table>";
        }else{
            echo "<h2 style='text-align:center;margin-top:100px;'>There is no Admin<h2>";
        }
    ?>
</body>
</html>