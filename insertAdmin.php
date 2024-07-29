<?php

    session_start();

    include 'connect.php';

    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        $token = bin2hex(random_bytes(15));

        $hash_pass = password_hash($password, PASSWORD_BCRYPT);

        $checkquery = "SELECT * FROM `admin003` WHERE `Email`='$email' AND `status`='active'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);

        if($num_rows > 0){ ?>
            <script>
                alert('Email Already Exists, \nPlease, Enter another Email...');
            </script>
        <?php }
        else{
            if($password === $cpassword){

                $insertquery = "INSERT INTO `admin003` (`FirstName`, `LastName`, `Email`, `Password`, `token`, `status`, `Time`) VALUES('$fname', '$lname', $email', '$hash_pass', '$token', 'inactive', current_timestamp())";
                $query = mysqli_query($con, $insertquery);

                if($query){
                    
                    $subject = "Email Verification ";
                    $body = "Hii, $fname $lname. Click here to verify your email account 
                    http://localhost/ShadiKarwao/activate.php?token=$token ";
                    $sender = "From: shivlalkumarsharma30062003@rjcollege.edu.in ";
    
                    if(mail($email, $subject, $body, $sender)){ ?>
                        <script>
                            alert('Please, Check your mail to verify your account...');
                            location.replace('admin.php');
                        </script>
                <?php }
                    else{ ?>
                    <script>
                        alert('Email sending failed...');
                    </script>
                <?php }
                }
                else{ ?>
                    <script>
                        alert('Please, Fill the Data Correctly...');
                    </script>
                <?php }
            }
            else{ ?>
                <script>
                    alert('Please, Fill the correct Password...');
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
    <title> Admin Register </title>
    <link rel="stylesheet" href="sign_up.css?v=4<?php $version ?>">
    <link rel="stylesheet" media="screen and (max-width:1100px)" href="admin_res.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <?php

        include 'navbar.php';

    ?>
     <div id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post">
            <h2>Admin</h2>
            <div class="input" id="field1">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" onkeyup="check(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input" id="field2">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" onkeyup="check1(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input" id="field3">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" onkeyup="check2(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input" id="field4">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" onkeyup="check3(this.value)" autofocus autocomplete="off" required>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
                <p class="error"></p>
            </div>
            <div class="input" id="field5">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" onkeyup="check4(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input" id="field6">
                <button type="submit" name="submit" id="btn">Sign Up</button>
            </div>
            <p>Already have an account ?<a href="admin.php">Login</a></p>
        </form>
</div>

    <script src="sign_up.js?v=4"></script>

</body>
</html>