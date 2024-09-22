<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    $icon = "";
    $selectquery = "SELECT * FROM `navbar4`";
    $query = mysqli_query($con, $selectquery);
    if($query){
        $fav_icon = mysqli_fetch_assoc($query); 
        $icon =  $fav_icon['Image'];
    } 

    if(isset($_POST['submit'])){
        $user_id = $_POST['user_id'];
        $location_id = $_POST['location_id'];
        $wed_date = date('Y-m-d' , strtotime($_POST['wed_date']));
        $amount_paid = mysqli_real_escape_string($con , ($_POST['amount_paid']));
        $payment_method = $_POST['payment_method'];
        $transaction_id = bin2hex(random_bytes(12));

        $checkquery = "SELECT * FROM `payment300` where `User_Id`=$user_id AND `Location_Id`=$location_id AND `Wed_Date`='$wed_date'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){ ?>
                <script>
                    alert("Date is unavailable...");
                </script>
        <?php }
        else{
            $insertquery = "INSERT INTO `payment300` (`User_id`,`Location_Id`, `Wed_Date`, `Amount_Paid`, `Payment_Method`, `Transaction_Id`, `Date`) VALUES ($user_id, $location_id, '$wed_date', $amount_paid, '$payment_method', '$transaction_id', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){ ?>
                <script>
                    alert("Booking added successfully...");
                    location.replace('booking_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Something went wrong...");
                </script>
            <?php }
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Booking</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Add Booking</h2>
            <div class="input">
                <label for="user_id">User Id</label>
                <input type="number" id="user_id" name="user_id" min="1"  autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="location_id">Location Id</label>
                <input type="number" id="location_id" name="location_id" min="1"  autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="wed_date">Wedding Date</label>
                <input type="date" id="wed_date" name="wed_date" min="<?php echo date('Y-m-d'); ?>" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="amount_paid">Amount Paid</label>
                <input type="number" id="amount_paid" name="amount_paid" min="149999" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" required>
                    <option value="" selected disabled>Select Payment Mode</option>
                    <option value="Cash">Cash</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                    <option value="UPI">UPI</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Paytm">Paytm</option>
                    <option value="Phone Pe">Phone Pe</option>
                    <option value="Google Pay">Google pay</option>
                </select>
            </div>
            <div class="input" id="field-submit">
                <button type="submit" name="submit" id="btn">Add Booking</button>
            </div>
            <div class="input">
                <button type="submit" id="btn1"><a href="booking_details.php">Go Back</a></button>
            </div>
        </form>
    </section>

</body>
</html>