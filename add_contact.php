<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }
    
    include 'connect.php';
    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $message = $_POST['message'];

        $checkquery = "SELECT * FROM `contact363` WHERE `FullName`='$fname' AND `Phone_No`='$phone' AND `Email`='$email' AND `Address`='$address' AND `Message`='$message'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){ ?>
            <script>
                alert('Contact Already Exists, \nPlease Enter another contact...');
            </script>
       <?php }
       else{ 
            $insertquery = "INSERT INTO `contact363` (`FullName`, `Phone_No`, `Email`, `Address`, `Message`, `Time`) VALUES ('$fname', '$phone', '$email', '$address', '$message', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){ ?>
                <script>
                    alert("Message has been added successfully...");
                    location.replace('contact_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Message not added...");
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
    <title>Add Contact</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" onsubmit="return validate()" method="post">
                <h2>Add Contact</h2>
                <div class="input">
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="fname" onkeyup="check(this.value)" autofocus autocomplete="off" required>
                    <i class="fa-solid fa-user"></i>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="phone">Phone No.</label>
                    <input type="tel" id="phone" name="phone" onkeyup="check1(this.value)" maxlength="10" autofocus autocomplete="off" required>
                    <i class="fa-solid fa-phone"></i>
                    <p class="error"></p>
                </div>                
                 <div class="input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" onkeyup="check2(this.value)" autofocus autocomplete="off" required>
                    <i class="fa-solid fa-envelope"></i>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" onkeyup="check3(this.value)" autofocus autocomplete="off" required>
                    <i class="fa-sharp fa-solid fa-location-dot"></i>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" onkeyup="check4(this.value)" required autofocus autocomplete="off"></textarea>
                    <i class="fa-solid fa-message"></i>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <button type="submit" name="submit" id="btn">Submit</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="contact_details.php">Go Back</a></button>
                </div>
            </form>
        </div>
    </section>

    <script src="contact.js?v=2"></script>

</body>
</html>