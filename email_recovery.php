<?php
    session_start();
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

        $checkquery = "SELECT * FROM `registration1` WHERE `Email`='$email' AND `status`='active'";
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
                    alert("Verify your Email...");
                    location.replace('login.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Something went wrong...");
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
    <?php
        include "navbar.php";
    ?>
    
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Reset Password</h2>
            <div class="input" id="field1">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" autofocus autocomplete="off" required>
            </div>
            <div class="input" id="field6">
                <button type="submit" name="submit" id="btn">Send Email</button>
            </div>
            <div id="para">Don't have an account ?<a href="sign_up.php">Login</a></div>
        </form>
    </section>
</body>
</html>