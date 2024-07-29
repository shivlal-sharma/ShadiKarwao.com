<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $fname = mysqli_real_escape_string($con , ($_POST['fname']));
        $lname = mysqli_real_escape_string($con , ($_POST['lname']));
        $email = mysqli_real_escape_string($con , ($_POST['email']));
        $location_name = mysqli_real_escape_string($con , ($_POST['location_name']));
        $location_image = $_FILES['location_image']['name'];
        $location_tmp_name = $_FILES['location_image']['tmp_name'];
        $location_folder = 'location_img/'.$location_image;
        $capacity = mysqli_real_escape_string($con , ($_POST['capacity']));
        $price = mysqli_real_escape_string($con , ($_POST['price']));
        $wed_date = date('Y-m-d' , strtotime($_POST['wed_date']));

        $transaction = bin2hex(random_bytes(12));

        $checkquery = "SELECT * FROM `payment300` where `Location_Name`='$location_name' && `Location_Image`='$location_image' && `Wed_Date`='$wed_date'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);

        if($num_rows > 0){ ?>
                <script>
                    alert("Wedding Date is not available, \nPlease, try another date...");
                </script>
        <?php }
        else{
            $insertquery = "INSERT INTO `payment300` (`FirstName`, `LastName`, `Email`, `Location_Name`, `Location_Image`, `Capacity`, `Price`, `Wed_Date`, `Transaction_Id`, `Date`) VALUES ('$fname', '$lname', '$email', '$location_name', '$location_image', '$capacity', '$price', '$wed_date', '$transaction', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){
                move_uploaded_file($location_tmp_name, $location_folder); ?>
                <script>
                    alert("Wedding Location added Successfully...");
                    location.replace('booking_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Wedding Location not added...");
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
    <title> Update Booking </title>
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <h2>Add Booking</h2>
            <div class="input">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname"  autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" autofocus autocomplete="off" required>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input">
                <label for="location_name">Location Name</label>
                <input type="text" id="location_name" name="location_name" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="location_image">Location Image</label>
                <input type="file" id="location_image" name="location_image" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="capacity">Capacity</label>
                <input type="text" id="capacity" name="capacity" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="wed_date">Wedding Date</label>
                <input type="date" id="wed_date" name="wed_date" min="<?php echo date('Y-m-d'); ?>" autofocus autocomplete="off" required>
            </div>
            
            <div class="input">
                <button type="submit" name="submit" id="btn">Submit</button>
            </div>
            <div class="input">
                <button type="submit" id="btn1"><a href="booking_details.php">Go Back</a></button>
            </div>
        </form>
    </section>

</body>
</html>