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
                    alert("Email already exists...");
                </script>
        <?php }
        else{
            if($password == $cpassword){
                $insertquery = "INSERT INTO `admin003` (`FirstName`, `LastName`, `Email`, `Password`, `token`, `status`, `Time`) VALUES ('$fname', '$lname', '$email', '$pass_hash', '$token', '$status', current_timestamp())";
                $query = mysqli_query($con, $insertquery);
                if($query){ ?>
                    <script>
                        alert("Admin added successfully!");
                        location.replace('admin_details.php');
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
                    alert("Incorrect confirm password...");
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
    <link rel="stylesheet" href="footer_menu_add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post">
            <h2>Add Admin</h2>
            <div class="input">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" onkeyup="check1(this.value)" autofocus autocomplete="off" required>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
                <p class="error"></p>
            </div>
            <div class="input">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" onkeyup="check2(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" autofocus autocomplete="off" required>
            </div>
            <div class="input" id="field-submit">
                <button type="submit" name="submit" id="btn">Add Admin</button>
            </div>
            <div class="input">
                <button type="submit" id="btn1"><a href="admin_details.php">Go Back</a></button>
            </div>
        </form>
    </section>

    <script src="sign_up.js"></script>
</body>
</html>