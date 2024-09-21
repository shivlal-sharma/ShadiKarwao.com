<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $id = $_POST['Sr_No'];
        $fname = mysqli_real_escape_string($con , ($_POST['fname']));
        $lname = mysqli_real_escape_string($con , ($_POST['lname']));
        $email = mysqli_real_escape_string($con , ($_POST['email']));
        $password = mysqli_real_escape_string($con , ($_POST['password']));
        $cpassword = mysqli_real_escape_string($con , ($_POST['cpassword']));
        $token = bin2hex(random_bytes(15));
        $status = mysqli_real_escape_string($con , ($_POST['status']));
        if($password == $cpassword){
            $pass_hash = password_hash($password, PASSWORD_BCRYPT);
            $updatequery = "UPDATE `admin003` SET `Sr_No`=$id, `FirstName`='$fname', `LastName`='$lname', `Email`='$email', `Password`='$pass_hash', `status`='$status', `Time`=current_timestamp() WHERE `Sr_No`=$id";
            $result = mysqli_query($con, $updatequery);
            if($result){ ?>
                <script>
                    alert("Admin updated successfully...");
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
                alert("incorrect confirm password...");
            </script>
        <?php }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Update User </title>
    <link rel="stylesheet" href="footer_menu_add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        $id = $_GET['updateid'];
        $sql = "SELECT * FROM `admin003` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
    ?>
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post">
            <h2>Update Admin</h2>
            <div class="input">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" value="<?php echo $row['FirstName']; ?>" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" value="<?php echo $row['LastName']; ?>" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $row['Password']; ?>" onkeyup="check1(this.value)" autofocus autocomplete="off" required>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
                <p class="error"></p>
            </div>
            <div class="input">
                <label for="cpassword">Confirm Password</label>
                <input type="password" id="cpassword" name="cpassword" value="<?php echo $row['Password']; ?>" onkeyup="check2(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" value="<?php echo $row['status']; ?>" autofocus autocomplete="off" required>
            </div>
            <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No']; ?>">
            <div class="input" id="field-submit">
                <button type="submit" name="submit" id="btn">Update</button>
            </div>
            <div class="input">
                    <button type="submit" id="btn1"><a href="user_details.php">Go Back</a></button>
            </div>
        </form>
    </section>

    <script src="sign_up.js"></script>

</body>
</html>