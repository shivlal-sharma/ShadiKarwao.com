<?php
    session_start();
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
        exit();
    }

    $success = false;
    $error = false;

    include 'connect.php';

    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $message = $_POST['message'];

        $selectquery = "SELECT * FROM `contact363` WHERE `FullName`='$fname' AND `Phone_No`='$phone' AND `Email`='$email' AND `Address`='$address' AND `Message`='$message'";
        $result = mysqli_query($con,$selectquery);
        if(mysqli_num_rows($result) > 0){
            $success = true;
        }else{
            $insertquery = "INSERT INTO `contact363` (`FullName`, `Phone_No`, `Email`, `Address`, `Message`, `Time`) VALUES ('$fname', '$phone', '$email', '$address', '$message', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){ 
                $success = true;
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
    <title>Contact</title>
    <link rel="stylesheet" href="sign_up.css">
</head>
<body>
    <?php include "navbar.php"; ?>

    <div id="container">
        <?php
            if($success == true){ ?>
                <span id="success">Message sent successfully!<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($error == true){ ?>
                <span id="error">Something went wrong...<b onclick="remove(this)">&times;</b></span>
           <?php }
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <h2>Contact Us</h2>
                <div class="input">
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="fname" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone" pattern='[0-9]{10}' autofocus autocomplete="off" required>
                </div>                
                 <div class="input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" required autofocus autocomplete="off"></textarea>
                </div>
                <div class="input" id="field5">
                    <button type="submit" name="submit" id="btn">Submit</button>
                </div>
            </form>
    </div>

    <script src="sign_up.js"></script>
</body>
</html>