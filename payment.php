<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
    }

    if(!isset($_SESSION['location'])){
        header('location:services.php');
    }

    $userdata = $_SESSION['userdata'];
    $locationData = $_SESSION['location'];

    $notAvail = false;
    $success = false;
    $error = false;
    $incorrectData = false;

    if(isset($_POST['submit'])){
        $capacity = $_POST['capacity'];
        $location_name = $_POST['location_name'];
        $location_image = $_POST['location_image'];
        $location_id = $_POST['location_id'];
        $price = $_POST['price'];
        $user_id = $_POST['user_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $wed_date = date('Y-m-d', strtotime($_POST['wed_date']));
        $status = $_POST['status'];
        $card_number = $_POST['card_number'];
        $expiry_month = $_POST['expiry_month'];
        $expiry_year = $_POST['expiry_year'];
        $cvv = $_POST['cvv'];
        
        $transaction_id = bin2hex(random_bytes(12));

        $card_hash = password_hash($card_number, PASSWORD_BCRYPT);
        $month_hash = password_hash($expiry_month, PASSWORD_BCRYPT);
        $year_hash = password_hash($expiry_year, PASSWORD_BCRYPT);
        $cvv_hash = password_hash($cvv, PASSWORD_BCRYPT);

        $checkquery = "SELECT * FROM `payment300` WHERE `Wed_Date` = '$wed_date' && `Location_Name`='$location_name' && `Location_Id`='$location_id' && `Location_Image`='$location_image' && `Status`='$status'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){
            $notAvail = true;
        }
        else{ 
            $insertquery = "INSERT INTO `payment300` (`User_Id`, `FirstName`, `LastName`, `Email`,  `Location_Name`, `Location_Image`, `Location_Id`, `Capacity`, `Price`, `Wed_Date`, `Status`, `Card_Number`, `Month`, `Year`, `CVV`, `Transaction_Id`, `Date`) VALUES ($user_id, '$fname', '$lname', '$email', '$location_name', '$location_image', $location_id, '$capacity', '$price', '$wed_date', '$status', '$card_hash', '$month_hash', '$year_hash', '$cvv_hash', '$transaction_id', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){
                $result = mysqli_query($con,"SELECT * FROM `payment300` WHERE `User_Id`=$user_id && `Location_Id`=$location_id && `Transaction_Id`='$transaction_id'");
                $paymentDetails = mysqli_fetch_assoc($result);
                $_SESSION['paymentDetails'] = $paymentDetails;

                $subject = "ShadiKarwao.com";
                $body = "Dear $fname $lname, \n\nGreetings from ShadiKarwao.com. \nCongratulations your Booking is Confirmed on $wed_date. \nYou have paid Rs.$price/- and your Transaction Id is $transaction_id. \nThank you for the payment. \n\nRevisit http://localhost/ShadiKarwao/home.php";
                $sender = "From: shivlalkumarsharma30062003@rjcollege.edu.in";

                if(mail($email, $subject, $body, $sender)){
                    $success = true;
                    header('location:payment_done.php');
                }
                else{
                    $error = true;
                }
            }
            else{
                $incorrectData = true;
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
    <link rel="stylesheet" href="payment.css?v=1">
    <style>
        @media screen and (max-width: 430px) {
            .alert{
                width: 300px;
                text-align:center;
                font-size:1rem;
            }

            b{
                font-size:1.5rem;
            }
        }
    </style>
</head>
<body>
    <?php 
        include 'navbar.php';
    ?>
    
    <div class="container">
        <?php
            if($notAvail == true){ ?>
                <span class="alert" id="error">Date is not available...<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($success == true){ ?>
                <span class="alert" id="success">Payment has been done Successfully!<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($error == true){ ?>
                <span class="alert" id="error">Something went wrong, try again...<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($incorrectData == true){ ?>
                <span class="alert" id="error">Fill the correct data...<b onclick="remove(this)">&times;</b></span>
           <?php } ?>

        <form action="<?php echo htmlentities ($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return validate()" enctype="multipart/form-data">
            <h2>Payment</h2>
            <div class="input">
                <label for="wed_date">Wedding Date</label>
                <input type="date" id="wed_date" name="wed_date" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="card_number">Credit Card Number</label>
                <input type="number" id="card_number" name="card_number" onkeyup="check(this.value)" minlength="16" maxlength="16" placeholder="1234 5678 9012 3456" autofocus
                    autocomplete="off" required>
                    <p class="error"></p>
            </div>
            <div class="input">
                <label for="expiry_month">Expiry Month</label>
                <input type="number" id="expiry_month" name="expiry_month" onkeyup="check1(this.value)" minlength="2" maxlength="2" placeholder="MM" autofocus
                    autocomplete="off" required>
                    <p class="error"></p>
            </div>
            <div class="input">
                <label for="expiry_year">Expiry Year</label>
                <input type="number" id="expiry_year" name="expiry_year" onkeyup="check2(this.value)" minlength="4" maxlength="4" placeholder="YYYY" autofocus
                    autocomplete="off" required>
                    <p class="error"></p>
            </div>
            <div class="input">
                <label for="cvv">CVV</label>
                <input type="number" id="cvv" name="cvv" onkeyup="check3(this.value)" minlength="3" maxlength="3"  placeholder="123" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $userdata['Sr_No']; ?>">
            <input type="hidden" name="fname" value="<?php echo $userdata['First_Name']; ?>">
            <input type="hidden" name="lname" value="<?php echo $userdata['Last_Name']; ?>">
            <input type="hidden" name="email" value="<?php echo $userdata['Email']; ?>">
            <input type="hidden" name="status" value="<?php echo $userdata['status']; ?>">
            <input type="hidden" name="location_name" value="<?php echo $locationData['Location_Name']; ?>">
            <input type="hidden" name="location_image" value="<?php echo $locationData['Location_Image']; ?>">
            <input type="hidden" name="location_id" value="<?php echo $locationData['Location_Id']; ?>">
            <input type="hidden" name="capacity" value="<?php echo $locationData['Capacity']; ?>">
            <input type="hidden" name="price" value="<?php echo $locationData['Price']; ?>">
            <button type="submit" name="submit" id="btn">Pay <span id="rupees">Rs.<?php echo $locationData['Price']; ?>/-</span></button>
            <div class="input">
                <button type="submit" id="btn1"><a href="services.php">Go Back</a></button>
            </div>
        </form>
    </div>      

    <script src="payment.js?v=2"></script>
</body>
</html>