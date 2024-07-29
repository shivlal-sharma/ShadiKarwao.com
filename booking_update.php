<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
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

        $checkquery = "SELECT * FROM `payment300` where `FirstName`='$fname' && `LastName`='$lname' && `Email`='$email' &&`Location_Name`='$location_name' && `Location_Image`='$location_image' && `Wed_Date`='$wed_date' && `Price`='$price' && `Capacity`='$capacity'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){ ?>
                <script>
                    alert("Wedding Date is not available, \nPlease, try another date...");
                    location.replace('booking_update.php');
                </script>
        <?php }
        else{
            $updatequery = "UPDATE `payment300` SET `FirstName`='$fname', `LastName`='$lname', `Email`='$email', `Location_Name`='$location_name', `Location_Image`='$location_image', `Capacity`='$capacity', `Price`='$price', `Wed_Date`='$wed_date', `Transaction_Id`='$transaction', `Date`= current_timestamp() WHERE `Id`=$id";
            $query = mysqli_query($con, $updatequery);
            if($query){
                move_uploaded_file($location_tmp_name, $location_folder); ?>
                <script>
                    alert(" Wedding Location updated Successfully...");
                    location.replace('booking_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Wedding Location not updated...");
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
    <?php
       $booking_id = $_GET['updateid'];
       $sql = "SELECT * FROM `payment300` WHERE `Id`=$booking_id";
       $result = mysqli_query($con, $sql);
       if($result){
            $rows = mysqli_fetch_assoc($result);
    ?>

                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <h2>Update Booking</h2>
                        <div class="input">
                            <label for="fname">First Name</label>
                            <input type="text" id="fname" name="fname" value="<?php echo $rows['FirstName']; ?>"  autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="lname">Last Name</label>
                            <input type="text" id="lname" name="lname" value="<?php echo $rows['LastName']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo $rows['Email']; ?>" autofocus autocomplete="off" required>
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="input">
                            <label for="location_name">Location Name</label>
                            <input type="text" id="location_name" name="location_name" value="<?php echo $rows['Location_Name']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="location_image">Location Image</label>
                            <input type="file" id="location_image" name="location_image" value="<?php echo $rows['Location_Image']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="capacity">Capacity</label>
                            <input type="text" id="capacity" name="capacity" value="<?php echo $rows['Capacity']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="price">Price</label>
                            <input type="text" id="price" name="price" value="<?php echo $rows['Price']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="wed_date">Wedding Date</label>
                            <input type="date" id="wed_date" name="wed_date" value="<?php echo $rows['Wed_Date']; ?>" min="<?php echo date('Y-m-d'); ?>" autofocus autocomplete="off" required>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $rows['Id']; ?>">
                        <div class="input">
                            <button type="submit" name="submit" id="btn">Update</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="booking_details.php">Go Back</a></button>
                        </div>
                    </form>
                </section>
                <?php } ?>
          
</body>
</html>