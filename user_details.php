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
            <a href="contact_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="add_user.php" id="submit1">Add User</a>
            <a href="admin_details.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>
    <?php
        include 'connect.php';
        $sql = "SELECT * FROM `registration1` WHERE `Status`='active'";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0){
            echo "<table>
                    <thead>
                        <tr>
                            <th>User Id</th>
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
                $id = $row['Sr_No'];
                $fname = $row['First_Name'];
                $lname = $row['Last_Name'];
                $email = $row['Email'];
                $status = $row['status'];
                $time = $row['Time'];

                echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$fname.'</td>
                        <td>'.$lname.'</td>
                        <td>'.$email.'</td>
                        <td>'.$status.'</td>
                        <td>'.$time.'</td>
                        <td><button type="submit" id="update"><a href="user_update.php?updateid='.$id.'">Update</a></button>
                        <button type="submit" id="delete"><a href="user_delete.php?deleteid='.$id.'">Delete</a></button></td>
                    </tr>';
            }
            echo "</tbody>
            </table>";
        }else{
            echo "<h2 style='text-align:center;margin-top:100px;'>There is no User<h2>";
        }
    ?>
</body>
</html>