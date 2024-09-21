<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
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
                alert("Message changed successfully...");
                location.replace('contact_details.php');
            </script>
        <?php }
        else{ ?>
            <script>
                alert("Something went wrong...");
            </script>
        <?php }
       
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Message</title>
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <?php
        $id = $_GET['update'];
        $selectquery = "SELECT * FROM `contact363` WHERE `Sr_No`='$id'";
        $query = mysqli_query($con, $selectquery);
        $row = mysqli_fetch_assoc($query);
    ?>
    <section id="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Add Message</h2>
            <div class="input">
                <label for="fname">Full Name</label>
                <input type="text" id="fname" name="fname" value="<?php echo $row['FullName']; ?>" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="phone">Phone No.</label>
                <input type="tel" id="phone" name="phone" value="<?php echo $row['Phone_No']; ?>" pattern="[0-9]{10}" autofocus autocomplete="off" required>
            </div>                
             <div class="input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="<?php echo $row['Address']; ?>" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" required autofocus autocomplete="off"><?php echo $row['Message']; ?></textarea>
            </div>
            <input type="hidden" name='Sr_No' value="<?php echo $row['Sr_No']; ?>">
            <div class="input" id="field-submit">
                <button type="submit" name="submit" id="btn">Update Message</button>
            </div>
            <div class="input">
                <button type="submit" id="btn1"><a href="contact_details.php">Go Back</a></button>
            </div>
        </form>
    </section>
</body>
</html>