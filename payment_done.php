<?php 
    session_start();
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
    }

    if(!isset($_SESSION['paymentDetails'])){
        header('location:payment_details.php');
    }

    include 'connect.php';
    $icon = "";
    $selectquery = "SELECT * FROM `navbar4`";
    $query = mysqli_query($con, $selectquery);
    if($query){
        $fav_icon = mysqli_fetch_assoc($query); 
        $icon =  $fav_icon['Image'];
    } 

    $paymentDetails = $_SESSION['paymentDetails'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="payment_details.css">
    <style>
        #box{
            width:370px;
            padding:15px;
        }
        h3{
            border-bottom:1px solid #000;
            font-size:19px;
        }
        @media (max-width:410px) {
            #box{
                width: 290px;
            }
            h3{
                font-size:17px;
            }
            .div{
                font-size:15px;
            }
        }
    </style>
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    <div id="container">
        <?php 
            include 'connect.php';
            $user_id = $paymentDetails['User_Id'];
            $select_userdata = "SELECT * FROM `registration1` WHERE `Sr_No`=$user_id";
            $query = mysqli_query($con,$select_userdata);
            if(mysqli_num_rows($query) > 0){
                $userdata = mysqli_fetch_assoc($query);
                $_SESSION['userInfo'] = $userdata;
            }

            $location_id = $paymentDetails['Location_Id'];
            $select_locationdata = "SELECT * FROM `location001` WHERE `Location_Id`=$location_id";
            $result = mysqli_query($con,$select_locationdata);
            if(mysqli_num_rows($result) > 0){
                $locationData = mysqli_fetch_assoc($result);
                $_SESSION['locationData'] = $locationData;
            }
        ?>
        <div id="box">
            <h3>Payment Details</h3>
            <div class="div"><label>Name : <?php echo $userdata['First_Name'].' '.$userdata['Last_Name']; ?></label></div>
            <div class="div"><label>Email : <?php echo $userdata['Email']; ?></label></div>
            <div class="div"><label>Location Name : <?php echo $locationData['Location_Name'];?></label></div>
            <div class="div"><label>Location : </br><img src="location_img/<?php echo $locationData['Location_Image'];?>" alt="Location View" width="100" height="100" style="margin-left:75px;margin-top:-15px;"></label></div>
            <div class="div"><label>Capacity : <?php echo $locationData['Capacity'];?> People</label></div>
            <div class="div"><label>Price : Rs.<?php echo number_format($locationData['Price']);?>/-</label></div>
            <div class="div"><label>Transaction Id : <?php echo $paymentDetails['Transaction_Id'];?></label></div>
            <div class="div"><a href="invoice.php">Print Invoice</a></div>
        </div>
    </div>
</body>
</html>