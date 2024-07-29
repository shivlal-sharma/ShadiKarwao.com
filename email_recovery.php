<?php
    session_start();
    include 'connect.php';
    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($con, ($_POST['email']));

        $checkquery = "SELECT * FROM `registration1` WHERE `Email`='$email'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){
            $row = mysqli_fetch_assoc($query);
            $fname = $row['First_Name'];
            $lname = $row['Last_Name'];
            $token = $row['token'];
            $subject = "Password Reset";
            $body = "Hii, $fname $lname. Click here to reset your password 
            http://localhost/ShadiKarwao/reset_pass.php?token=$token ";
            $sender = "From: shivlalkumarsharma30062003@rjcollege.edu.in";

            if(mail($email, $subject, $body, $sender)){ ?>
                <script>
                    alert("Please, Check your email to reset your password...");
                    location.replace('login.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Email sending failed...");
                </script>
            <?php }
        }
        else{ ?>
            <script>
                    alert("No Email found, \nPlease enter the correct Email...");
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
    <link rel="stylesheet" href="email_recovery.css?v=5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        include "navbar.php";
    ?>
    
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Reset Password</h2>
            <div class="input" id="field1">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" autofocus required>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input" id="field2">
                <input type="submit" name='submit' id='submit' value="Send Email">
            </div>
            <div id="center">Have an account ?<a href="login.php">Login</a></div>
        </form>
    </section>
</body>
</html>