<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
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

    if (isset($_POST['submit'])) {
        $id = $_POST['Sr_No'];
        $fname = mysqli_real_escape_string($con, ($_POST['fname']));
        $lname = mysqli_real_escape_string($con, ($_POST['lname']));
        $email = mysqli_real_escape_string($con, ($_POST['email']));
        $password = mysqli_real_escape_string($con, ($_POST['password']));
        $status = mysqli_real_escape_string($con, ($_POST['status']));
        
        // Check if email exists with active status for another user
        $emailQuery = "SELECT * FROM `admin003` WHERE `Email`='$email' AND `Sr_No` != $id AND `status`='active'";
        $emailResult = mysqli_query($con, $emailQuery);
    
        if (mysqli_num_rows($emailResult) > 0) { ?>
            <script>
                alert("Email already exists.");
            </script>
        <?php } else {
            // Handle password update
            $pass_hash = "";
            if (!empty($password)) {
                    // Fetch the current hashed password
                    $currentPasswordQuery = "SELECT `Password` FROM `admin003` WHERE `Sr_No`=$id";
                    $currentPasswordResult = mysqli_query($con, $currentPasswordQuery);
                    $currentPasswordRow = mysqli_fetch_assoc($currentPasswordResult);
                    $currentPasswordHash = $currentPasswordRow['Password'];
    
                    // Check if the password has changed
                    if (password_verify($password, $currentPasswordHash)) {
                        $pass_hash = $currentPasswordHash; // Retain the current password
                    } else {
                        $pass_hash = password_hash($password, PASSWORD_BCRYPT); // Hash the new password
                    }
            } else {
                // Fetch the current hashed password if no new password is entered
                $currentPasswordQuery = "SELECT `Password` FROM `admin003` WHERE `Sr_No`=$id";
                $currentPasswordResult = mysqli_query($con, $currentPasswordQuery);
                $currentPasswordRow = mysqli_fetch_assoc($currentPasswordResult);
                $pass_hash = $currentPasswordRow['Password'];
            }
    
            // Update the database
            $updatequery = "UPDATE `admin003` SET `FirstName`='$fname', `LastName`='$lname', `Email`='$email', `Password`='$pass_hash', `status`='$status', `Time`=current_timestamp() WHERE `Sr_No`=$id";
            $result = mysqli_query($con, $updatequery);
    
            if ($result) { ?>
                <script>
                    alert("Admin updated successfully...");
                    location.replace('admin_details.php');
                </script>
            <?php } else { ?>
                <script>
                    alert("Something went wrong...");
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
    <title>Update User</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        if (isset($_GET['updateid'])) {
            $id = intval($_GET['updateid']);
        } else {
            echo "<script>location.replace('admin_details.php');</script>";
            exit;
        }
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
                <input type="text" id="lname" name="lname" value="<?php echo $row['LastName']; ?>" autofocus required>
            </div>
            <div class="input">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" autofocus required>
            </div>
            <div class="input">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" onkeyup="check1(this.value)" autofocus>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
                <p class="error"></p>
            </div>
            <div class="input">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" value="<?php echo $row['status']; ?>" autofocus required>
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