<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    // $id = $_GET['update'];
    if(isset($_POST['submit'])){
        $id = $_POST['Sr_No'];
        $fname = $_POST['fname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $addr = $_POST['address'];
        $msg = $_POST['message'];

        $updatequery = "UPDATE `contact363` SET `FullName`='$fname', `Phone_No`='$phone', `Email`='$email', `Address`='$addr', `Message`='$msg', `Time`=current_timestamp() WHERE `Sr_No`=$id";
        $query = mysqli_query($con, $updatequery);

        if($query){ ?>
            <script>
                alert("Message has been updated successfully...");
                location.replace('contact_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert("Something went wrong, \nPlease try again...");
            </script>
        <?php }
       
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
    <?php

        $id = $_GET['update'];

        $selectquery = "SELECT * FROM `contact363` WHERE `Sr_No`='$id'";
        $query = mysqli_query($con, $selectquery);
        $row = mysqli_fetch_assoc($query);

    ?>
    <section id="container">
            <form action="" onsubmit="return validate()" method="post">
                <h2>Add Contact</h2>
                <div class="input">
                    <label for="fname">Full Name</label>
                    <input type="text" id="fname" name="fname" value="<?php echo $row['FullName']; ?>" onkeyup="check(this.value)" autofocus autocomplete="off" required>
                    <i class="fa-solid fa-user"></i>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="phone">Phone No.</label>
                    <input type="tel" id="phone" name="phone" value="<?php echo $row['Phone_No']; ?>" onkeyup="check1(this.value)" maxlength="10" autofocus autocomplete="off" required>
                    <i class="fa-solid fa-phone"></i>
                    <p class="error"></p>
                </div>                
                 <div class="input">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" onkeyup="check2(this.value)" autofocus autocomplete="off" required>
                    <i class="fa-solid fa-envelope"></i>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" value="<?php echo $row['Address']; ?>" onkeyup="check3(this.value)" autofocus autocomplete="off" required>
                    <i class="fa-sharp fa-solid fa-location-dot"></i>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" onkeyup="check4(this.value)" required autofocus autocomplete="off"><?php echo $row['Message']; ?></textarea>
                    <i class="fa-solid fa-message"></i>
                    <p class="error"></p>
                </div>
                <input type="hidden" name='Sr_No' value="<?php echo $row['Sr_No']; ?>">
                <div class="input" id="field5">
                    <button type="submit" name="submit" id="btn">Update</button>
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