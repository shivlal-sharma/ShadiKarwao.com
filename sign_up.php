<?php
    session_start();
    if(isset($_SESSION['fullName'])){
        header('Location:home.php');
        exit();
    }

    include 'connect.php';
    $icon = "";
    $selectquery = "SELECT * FROM `navbar4`";
    $query = mysqli_query($con, $selectquery);
    if($query){
        $fav_icon = mysqli_fetch_assoc($query); 
        $icon =  $fav_icon['Image'];
    } 

    $exists = false;
    $emailVerify = false;
    $emailFail = false;
    $notInserted = false;
    $incorrectPass = false;
    $loggedIn = false;
    $notLoggedIn = false;

    if(isset($_GET['token'])){
        include 'connect.php';
        $token = $_GET['token'];
        $updatequery = "UPDATE `registration1` SET `status`='active' where `token`='$token'";
        $query = mysqli_query($con, $updatequery);
        if($query){ 
            $loggedIn = true;
        }else{
            $notLoggedIn = true;
        }
        mysqli_close($con);
    }

    if(isset($_POST['submit'])){
        include 'connect.php';
        $fname = mysqli_real_escape_string($con , ($_POST['fname']));
        $lname = mysqli_real_escape_string($con , ($_POST['lname']));
        $email = mysqli_real_escape_string($con , ($_POST['email']));
        $password = mysqli_real_escape_string($con , ($_POST['password']));
        $cpassword = mysqli_real_escape_string($con , ($_POST['cpassword']));
        $token = bin2hex(random_bytes(15));
        $pass_hash = password_hash($password, PASSWORD_BCRYPT);
        $checkquery = "SELECT * FROM `registration1` WHERE `Email`='$email' AND `status`='active'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){
            $exists = true;
        }else{
            if($password == $cpassword){
                $insertquery = "INSERT INTO `registration1` (`First_Name`, `Last_Name`, `Email`, `Password`, `token`, `status`, `Time`) VALUES ('$fname', '$lname', '$email', '$pass_hash', '$token', 'inactive', current_timestamp())";
                $query = mysqli_query($con, $insertquery);
                if($query){
                    $subject = "Email Verification ";
                    $body = "Hii, $fname $lname. Click here to verify your email account 
http://localhost/ShadiKarwao/sign_up.php?token=$token ";
                    $sender = "From: shivlalkumarsharma30062003@rjcollege.edu.in ";
                    if(mail($email, $subject, $body, $sender)){ 
                        $emailVerify = true;
                    }
                    else{ 
                        $emailFail = true;
                    }
                }
                else{
                    $notInserted = true;
                }
            }
            else{
                $incorrectPass = true;
            }
        }
        mysqli_close($con);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="sign_up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include "navbar.php"; ?>

    <section id="container">
        <?php
            if($exists == true){ ?>
                <span id="error">Email already exists...<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($emailVerify == true){ ?>
                <span id="success">Verify your Email...<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($emailFail == true){ ?>
                <span id="error">Email sending failed...<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($notInserted == true){ ?>
                <span id="error">Something went wrong...<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($incorrectPass == true){ ?>
                <span id="error">Incorrect password...<b onclick="remove(this)">&times;</b></span>
           <?php }

            if($loggedIn == true){ 
                header('location:login.php');
            }

            if($notLoggedIn == true){ ?>
                <span id="error">You are no longer verified...<b onclick="remove(this)">&times;</b></span>
           <?php } ?>

        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post">
            <h2>Sign Up</h2>
            <div class="input" id="field1">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" autofocus autocomplete="off" required>
            </div>
            <div class="input" id="field2">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" autofocus autocomplete="off" required>
            </div>
            <div class="input" id="field3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" autofocus autocomplete="off" required>
            </div>
            <div class="input" id="field4">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" onkeyup="check1(this.value)" autofocus autocomplete="off" required>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
                <p class="error"></p>
            </div>
            <div class="input" id="field5">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" onkeyup="check2(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input" id="field6">
                <button type="submit" name="submit" id="btn">Sign Up</button>
            </div>
            <p id="para">Already have an account ?<a href="login.php">Login</a></p>
        </form>
    </section>

    <script src="sign_up.js"></script>
</body>
</html>