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
        if(isset($_GET['token'])){
            $token = $_GET['token'];
            $newpassword = mysqli_real_escape_string($con, $_POST['newpassword']);
            $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
            $newpass_hash = password_hash($newpassword, PASSWORD_BCRYPT);

            if($newpassword === $cpassword){
                $updatequery = "UPDATE `admin003` SET `Password`='$newpass_hash' WHERE `token`='$token'";
                $query = mysqli_query($con, $updatequery);
                if($query){ ?>
                    <script>
                        alert("Password has changed successfully!");
                        location.replace('login_admin.php');
                    </script>
                <?php }
                else{ 
                    echo "<script>alert('Something went wrong...');</script>";
                    echo "<script>location.replace('admin_email_recovery.php);</script>";
                }
            }
            else{ 
                echo "<script>alert('Incorrect confirm password...');</script>";
                echo "<script>location.replace('admin_email_recovery.php);</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="sign_up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include "dash_navbar.php"; ?>

    <section id="container">
        <form action="" onsubmit="return validate()" method="post">
            <h2>Reset Password</h2>
            <div class="input" id="field1">
                <label for="newpassword">New Password</label>
                <input type="password" name="newpassword" id="password" onkeyup="check1(this.value)" autofocus autocomplete="off" required>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
                <p class="error"></p>
            </div>
            <div class="input" id="field2">
                <label for="cpassword">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword" onkeyup="check2(this.value)" autofocus autocomplete="off" required>
                <p class="error"></p>
            </div>
            <div class="input" id="field6">
                <button type="submit" name='submit' id='btn'>Reset Password</button>
            </div>
            <div id="para">Are you admin ? <a href="login_admin.php">Login</a></div>
        </form>
    </section>

    <script src="sign_up.js"></script>
</body>
</html>