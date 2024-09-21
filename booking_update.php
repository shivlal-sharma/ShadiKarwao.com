<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $payment_id = $_POST['payment_id'];
        $user_id = $_POST['user_id'];
        $location_id = $_POST['location_id'];
        $wed_date = date('Y-m-d' , strtotime($_POST['wed_date']));
        $amount_paid = mysqli_real_escape_string($con , ($_POST['amount_paid']));
        $payment_method = $_POST['payment_method'];
        $transaction_id = $_POST['transaction_id'];

        $updatequery = "UPDATE `payment300` SET `User_Id`=$user_id, `Location_Id`=$location_id, `Wed_Date`='$wed_date', `Amount_Paid`=$amount_paid, `Payment_Method`='$payment_method', `Transaction_Id`='$transaction_id', `Date`= current_timestamp() WHERE `Payment_Id`=$payment_id";
        $query = mysqli_query($con, $updatequery);
        if($query){ ?>
            <script>
                alert("Booking updated successfully!");
                location.replace('booking_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert("Something went wrong...");
            </script>
        <?php }
        }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update Booking </title>
    <link rel="stylesheet" href="footer_menu_add.css">
</head>

<body>
    <?php
       $payment_id = $_GET['updateid'];
       $sql = "SELECT * FROM `payment300` WHERE `Payment_Id`=$payment_id";
       $result = mysqli_query($con, $sql);
       if($result){
            $rows = mysqli_fetch_assoc($result);
    ?>

                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <h2>Update Booking</h2>
                        <div class="input">
                            <label for="user_id">User Id</label>
                            <input type="number" id="user_id" name="user_id" min="1" value="<?php echo $rows['User_Id']; ?>"  autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="location_id">Location Id</label>
                            <input type="number" id="location_id" name="location_id" min="1" value="<?php echo $rows['Location_Id']; ?>"  autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="wed_date">Wedding Date</label>
                            <input type="date" id="wed_date" name="wed_date" value="<?php echo $rows['Wed_Date']; ?>" min="<?php echo date('Y-m-d'); ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="amount_paid">Amount Paid</label>
                            <input type="number" id="amount_paid" name="amount_paid" min="149999" value="<?php echo $rows['Amount_Paid']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="payment_method">Payment Method</label>
                            <select name="payment_method" id="payment_method" required>
                                <option value="<?php echo $rows['Payment_Method']; ?>" selected><?php echo $rows['Payment_Method']; ?></option>
                                <option value="Cash">Cash</option>
                                <option value="Bank Transfer">Bank Transfer</option>
                                <option value="UPI">UPI</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Paytm">Paytm</option>
                                <option value="Phone Pe">Phone Pe</option>
                                <option value="Google Pay">Google pay</option>
                            </select>
                        </div>
                        <div class="input">
                            <label for="transaction_id">Transaction Id</label>
                            <input type="text" id="transaction_id" name="transaction_id" value="<?php echo $rows['Transaction_Id']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <input type="hidden" name="payment_id" value="<?php echo $rows['Payment_Id']; ?>">
                        <div class="input">
                            <button type="submit" name="submit" id="btn">Update Booking</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="booking_details.php">Go Back</a></button>
                        </div>
                    </form>
                </section>
                <?php } ?>
          
</body>
</html>