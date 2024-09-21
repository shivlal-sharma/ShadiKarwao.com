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
    <title>Contact Details</title>
    <style>
        #table{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
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
            <a href="booking_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="add_contact.php" id="submit1">Add Contact</a>
            <a href="user_details.php" id="submit2">Forward &nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>
    <?php
        include 'connect.php';
        $sql = "SELECT * FROM `contact363`";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0){
            echo "<table>
                    <thead>
                        <tr>
                            <th>Sr. No.</th>
                            <th>Full Name</th>
                            <th>Phone No.</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Message</th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time&nbsp;&nbsp;&nbsp;&nbsp;</th>
                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>";
            while($row = mysqli_fetch_assoc($result)){
                $id = $row['Sr_No'];
                $fname = $row['FullName'];
                $phone = $row['Phone_No'];
                $email = $row['Email'];
                $addr = $row['Address'];
                $msg = $row['Message'];
                $time = $row['Time'];

                echo '<tr>
                        <td>'.$id.'</td>
                        <td>'.$fname.'</td>
                        <td>'.$phone.'</td>
                        <td>'.$email.'</td>
                        <td>'.$addr.'</td>
                        <td>'.$msg.'</td>
                        <td>'.$time.'</td>
                        <td><button type="submit" id="update"><a href="contact_update.php?update='.$id.'">Update</a></button>
                        <button type="submit" id="delete"><a href="contact_delete.php?delete='.$id.'">Delete</a></button></td>
                    </tr>';
            }
          echo  "<tbody>
            </table>";
        }else{
        echo "<h2 style='text-align:center;margin-top:100px;'>There is no Message<h2>";
        } 
    ?>
</body>
</html>