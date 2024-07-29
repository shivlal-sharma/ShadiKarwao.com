<?php
    session_start();
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
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

        $insertquery = "INSERT INTO `contact363` (`FullName`, `Phone_No`, `Email`, `Address`, `Message`, `Time`) VALUES ('$fname', '$phone', '$email', '$address', '$message', current_timestamp())";
        $query = mysqli_query($con, $insertquery);

        if($query){ 
            $success = true;
        }
        else{
            $error = true;
        }
       
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="sign_up.css?v=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        @media screen and (max-width: 430px) {
            span{
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
        include "navbar.php";
    ?>

    <div id="container">
        <?php
            if($success == true){ ?>
                <span id="success">Thanks for sending the message!<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($error == true){ ?>
                <span id="error">Something went wrong. Please try again...<b onclick="remove(this)">&times;</b></span>
           <?php }
        ?>
            <form action="" onsubmit="return validate()" method="post">
                <h2>Contact Us</h2>
                <div class="input">
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="fname" onkeyup="check(this.value)" autofocus autocomplete="off" required>
                    <i class="fa-solid fa-user"></i>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="phone">Phone</label>
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
                <div class="input" id="field5">
                    <button type="submit" name="submit" id="btn">Submit</button>
                </div>
            </form>
    </div>

    <script src="contact.js?v=3"></script>

</body>
</html>