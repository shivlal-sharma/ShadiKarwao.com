<?php
    session_start();
    if(isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }
    
    include 'connect.php';
    $icon = "";
    $selectquery = "SELECT * FROM `navbar4`";
    $query = mysqli_query($con, $selectquery);
    if($query){
        $fav_icon = mysqli_fetch_assoc($query); 
        $icon =  $fav_icon['Image'];
    } 
    
    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($con, ($_POST['email']));

        $checkquery = "SELECT * FROM `admin003` WHERE `Email`='$email' AND `status`='active'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){
            $row = mysqli_fetch_assoc($query);
            $fname = $row['FirstName'];
            $lname = $row['LastName'];
            $token = $row['token'];
            $subject = "Password Reset";
            $body = "Hii, $fname $lname. Click here to reset your password 
http://localhost/ShadiKarwao/admin_reset_pass.php?token=$token ";
            $sender = "From: shivlalkumarsharma30062003@rjcollege.edu.in";

            if(mail($email, $subject, $body, $sender)){ ?>
                <script>
                    alert("Verify your Email...");
                    location.replace('login_admin.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("something went wrong...");
                </script>
            <?php }
        }
        else{ ?>
            <script>
                    alert("Invalid Email...");
            </script>
       <?php }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Recovery</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="sign_up.css">
</head>
<body>
    <?php include "dash_navbar.php"; ?>
    
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Reset Password</h2>
            <div class="input" id="field1">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" autofocus required>
            </div>
            <div class="input" id="field6">
                <button type="submit" name='submit' id='btn'>Send Email</button>
            </div>
            <div id="para">Are you admin ? <a href="login_admin.php">Login</a></div>
        </form>
    </section>
</body>
</html>