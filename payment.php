<?php
    session_start();
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
    }

    if(!isset($_SESSION['location'])){
        header('location:services.php');
    }

    include 'connect.php';
    $icon = "";
    $selectquery = "SELECT * FROM `navbar4`";
    $query = mysqli_query($con, $selectquery);
    if($query){
        $fav_icon = mysqli_fetch_assoc($query); 
        $icon =  $fav_icon['Image'];
    } 

    $userdata = $_SESSION['userdata'];
    $locationData = $_SESSION['location'];

    $notAvail = false;
    $success = false;
    $error = false;
    $incorrectData = false;

    if(isset($_POST['submit'])){
        $location_id = $locationData['Location_Id'];
        $user_id = $userdata['Sr_No'];
        $fname = $userdata['First_Name'];
        $lname = $userdata['Last_Name'];
        $email = $userdata['Email'];
        $wed_date = date('Y-m-d', strtotime($_POST['wed_date']));
        $payment_method = $_POST['payment_method'];
        $amount_paid = $locationData['Price'];
        $transaction_id = bin2hex(random_bytes(12));
        $checkquery = "SELECT * FROM `payment300` WHERE `Wed_Date` = '$wed_date' AND `Location_Id`='$location_id'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $notAvail = true;
        }
        else{ 
            $insertquery = "INSERT INTO `payment300` (`User_Id`, `Location_Id`, `Wed_Date`, `Amount_Paid`, `Payment_Method`, `Transaction_Id`, `Date`) VALUES ($user_id, $location_id, '$wed_date', '$amount_paid', '$payment_method', '$transaction_id', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){
                $result = mysqli_query($con,"SELECT * FROM `payment300` WHERE `User_Id`=$user_id AND `Location_Id`=$location_id AND `Transaction_Id`='$transaction_id'");
                $paymentDetails = mysqli_fetch_assoc($result);
                $_SESSION['paymentDetails'] = $paymentDetails;

                $subject = "ShadiKarwao.com";
                $body = "Dear $fname $lname, \n\nGreetings from ShadiKarwao.com. \nCongratulations your Booking is Confirmed on $wed_date. \nYou have paid Rs.$amount_paid/- and your Transaction Id is $transaction_id. \nThank you for the payment. \n\nRevisit http://localhost/ShadiKarwao/home.php";
                $sender = "From: shivlalkumarsharma30062003@rjcollege.edu.in";

                if(mail($email, $subject, $body, $sender)){
                    $success = true;
                    header('location:payment_done.php');
                }
                else{
                    $error = true;
                    header('location:payment_done.php');
                }
            }
            else{
                $error = true;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <?php 
        include 'navbar.php';
    ?>
    
    <div class="container">
        <?php
            if($notAvail == true){ ?>
                <span class="alert" id="error">Date is unavailable...<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($success == true){ ?>
                <span class="alert" id="success">You have paid Successfully!<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($error == true){ ?>
                <span class="alert" id="error">Something went wrong...<b onclick="remove(this)">&times;</b></span>
           <?php } ?>

        <form action="<?php echo htmlentities ($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Payment</h2>
            <div class="input">
                <label for="wed_date">Wedding Date</label>
                <input type="date" id="wed_date" name="wed_date" min="<?php echo date('Y-m-d'); ?>" autofocus autocomplete="off" required>
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
            <button type="submit" name="submit" id="btn">Pay <span id="rupees">Rs.<?php echo $locationData['Price']; ?>/-</span></button>
            <div class="input">
                <button id="btn1"><a href="services.php">Go Back</a></button>
            </div>
        </form>
    </div>      

    <script src="sign_up.js"></script>
</body>
</html>