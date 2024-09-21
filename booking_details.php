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
            <a href="wishlist_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="booking_add.php" id="submit1">Add Booking</a>
            <a href="contact_details.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav> 
    <?php
        include 'connect.php';
        $sql = "SELECT * FROM `payment300`";
        $result = mysqli_query($con, $sql);
        if(mysqli_num_rows($result) > 0){
            echo "<table>
                    <thead>
                        <tr>
                            <th>Payment Id</th>
                            <th>User Id</th>
                            <th>Location Id</th>
                            <th>Wedding Date</th>
                            <th>Amount Paid</th>
                            <th>Payment Method</th>
                            <th>Transaction Id</th>
                            <th>Booking Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    </tbody>";
            while($row = mysqli_fetch_assoc($result)){
                $payment_id = $row['Payment_Id'];
                $user_id = $row['User_Id'];
                $location_id = $row['Location_Id'];
                $amount_paid = $row['Amount_Paid'];
                $payment_method = $row['Payment_Method'];
                $wedding_date = $row['Wed_Date'];
                $transaction_id = $row['Transaction_Id'];
                $booking_date = $row['Date'];

                echo '<tr>
                        <td>'.$payment_id.'</td>
                        <td>'.$user_id.'</td>
                        <td>'.$location_id.'</td>
                        <td>'.$wedding_date.'</td>
                        <td>Rs.'.number_format($amount_paid,2,'.',',').'/-</td>
                        <td>'.$payment_method.'</td>
                        <td>'.$transaction_id.'</td>
                        <td>'.$booking_date.'</td>
                        <td><button type="submit" id="update"><a href="booking_update.php?updateid='.$payment_id.'">Update</a></button>
                        <button type="submit" id="delete"><a href="booking_delete.php?deleteid='.$payment_id.'">Delete</a></button></td>
                    </tr>';
            }
            echo "</tbody>
                </thead>";
        }else{
            echo "<h2 style='text-align:center;margin-top:100px;'>There is no Booking<h2>";
        }
    ?>
</body>
</html>