<?php 
    session_start();
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
    }

    if(isset($_SESSION['location'])){
        $locationdata = $_SESSION['location'];
    }

    $userdata = $_SESSION['userdata'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Location Details</title>
    <link rel="stylesheet" href="payment_details.css?v=0">
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    <div id="container">
        <div id="box">
            <h2>Selected Location Details</h2>
            <div class="div"><label>Name : <?php echo $userdata['First_Name'].' '.$userdata['Last_Name']; ?></label></div>
            <div class="div"><label>Email : <?php echo $userdata['Email']; ?></label></div>
            <div class="div"><label>Location Name : <?php if(isset($_SESSION['location'])){ echo $locationdata['Location_Name'];}else{ echo 'Unknown';} ?></label></div>
            <div class="div"><label>Location : </br><img src="location_img/<?php if(isset($_SESSION['location'])){ echo $locationdata['Location_Image'];}else{ echo 'notSelected.jpg';} ?>" alt="Location View" width="100" height="100"></label></div>
            <div class="div"><label>Capacity : <?php if(isset($_SESSION['location'])){ echo $locationdata['Capacity'];}else{ echo '0';} ?> People</label></div>
            <div class="div"><label>Price : Rs.<?php if(isset($_SESSION['location'])){ echo number_format($locationdata['Price']);}else{ echo '0';} ?>/-</label></div>
            <div class="div" style="text-align:center"><a href="payment.php">Make Payment <?php if(isset($_SESSION['location'])){ echo 'Rs.'.number_format($locationdata['Price']).'/-';}else{ echo '';} ?></a></div>
        </div>
    </div>
</body>
</html>