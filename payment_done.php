<?php 
    session_start();
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
    }

    if(!isset($_SESSION['paymentDetails'])){
        header('location:payment_details.php');
    }

    $paymentDetails = $_SESSION['paymentDetails'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link rel="stylesheet" href="payment_details.css?v=0">
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    <div id="container">
        <div id="box">
            <h2>Payment Details</h2>
            <div class="div"><label>Name : <?php echo $paymentDetails['FirstName'].' '.$paymentDetails['LastName']; ?></label></div>
            <div class="div"><label>Email : <?php echo $paymentDetails['Email']; ?></label></div>
            <div class="div"><label>Location Name : <?php echo $paymentDetails['Location_Name'];?></label></div>
            <div class="div"><label>Location : </br><img src="location_img/<?php echo $paymentDetails['Location_Image'];?>" alt="Location View" width="100" height="100"></label></div>
            <div class="div"><label>Capacity : <?php echo $paymentDetails['Capacity'];?> People</label></div>
            <div class="div"><label>Price : Rs.<?php echo number_format($paymentDetails['Price']);?>/-</label></div>
            <div class="div"><a href="invoice.php">Print Invoice</a></div>
        </div>
    </div>
</body>
</html>