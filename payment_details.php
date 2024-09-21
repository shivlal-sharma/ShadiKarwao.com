<?php 
    session_start();
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
    }

    if(isset($_SESSION['location_id'])){
        include 'connect.php';
        $location_id  = $_SESSION['location_id'];
        $select_location = "SELECT * FROM `location001` WHERE `Location_Id`=$location_id";
        $query  = mysqli_query($con,$select_location);
        if(mysqli_num_rows($query) > 0){
            $locationdata = mysqli_fetch_assoc($query);
            $_SESSION['location'] = $locationdata;
        }
        mysqli_close($con);
    }

    $userdata = $_SESSION['userdata'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Location</title>
    <link rel="stylesheet" href="payment_details.css">
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    <div id="container">
        <div id="box">
            <h3>Selected Location</h3>
            <div class="div"><label>Name : <?php echo $userdata['First_Name'].' '.$userdata['Last_Name']; ?></label></div>
            <div class="div"><label>Location Name : <?php if(isset($_SESSION['location'])){ echo $locationdata['Location_Name'];}else{ echo 'Unknown';} ?></label></div>
            <div class="div"><label>Location : </br><img src="location_img/<?php if(isset($_SESSION['location'])){ echo $locationdata['Location_Image'];}else{ echo 'notSelected.jpg';} ?>" alt="Location View" width="100" height="100" style="margin-left:75px;margin-top:-15px;"></label></div>
            <div class="div"><label>Capacity : <?php if(isset($_SESSION['location'])){ echo $locationdata['Capacity'];}else{ echo '0';} ?> People</label></div>
            <div class="div"><label>Price : Rs.<?php if(isset($_SESSION['location'])){ echo number_format($locationdata['Price']);}else{ echo '0';} ?>/-</label></div>
            <div class="div" style="text-align:center"><a href="payment.php">Pay <small><?php if(isset($_SESSION['location'])){ echo 'Rs.'.number_format($locationdata['Price']).'/-';}else{ echo '';} ?></small></a></div>
        </div>
    </div>
</body>
</html>