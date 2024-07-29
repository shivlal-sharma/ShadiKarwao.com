<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $fname = mysqli_real_escape_string($con , ($_POST['fname']));
        $lname = mysqli_real_escape_string($con , ($_POST['lname']));
        $email = mysqli_real_escape_string($con , ($_POST['email']));
        $password = mysqli_real_escape_string($con , ($_POST['password']));
        $cpassword = mysqli_real_escape_string($con , ($_POST['cpassword']));

        $token = bin2hex(random_bytes(15));

        $status = mysqli_real_escape_string($con , ($_POST['status']));

        $pass_hash = password_hash($password, PASSWORD_BCRYPT);

        $checkquery = "SELECT * FROM `admin003` where Email='$email' AND status='active'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){ ?>
                <script>
                    alert("Email Already Exists, \nPlease, create another account...");
                </script>
        <?php }
        else{
            if($password == $cpassword){

                $insertquery = "INSERT INTO `admin003` (`FirstName`, `LastName`, `Email`, `Password`, `token`, `status`, `Time`) VALUES ('$fname', '$lname', '$email', '$pass_hash', '$token', '$status', current_timestamp())";
                $query = mysqli_query($con, $insertquery);

                if($query){ ?>
                    <script>
                        alert("Admin Inserted Successfully...");
                        location.replace('admin_details.php');
                    </script>
                <?php }
                else{ ?>
                    <script>
                        alert("Please, Fill the data correctly...");
                    </script>
                <?php }
            }
            else{ ?>
                <script>
                    alert("Please, Fill the correct Password...");
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
    <title> Add User </title>
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post">
            <h2>Add User</h2>
            <div class="input">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" onkeyup="check(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" onkeyup="check1(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" onkeyup="check2(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" onkeyup="check3(this.value)" autofocus autocomplete="off" required>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
                <p class="error"></p>
            </div>
            <div class="input">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" onkeyup="check4(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" onkeyup="check5(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input">
                <button type="submit" name="submit" id="btn">Submit</button>
            </div>
            <div class="input">
                <button type="submit" id="btn1"><a href="admin_details.php">Go Back</a></button>
            </div>
        </form>
    </section>

    <script src="sign_up.js?v=0"></script>

</body>
</html>