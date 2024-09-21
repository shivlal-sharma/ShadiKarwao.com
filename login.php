<?php
    session_start();
    if(isset($_SESSION['fullName'])){
        header('Location:home.php');
        exit();
    }

    $loggedIn = false;
    $incorrectPass = false;
    $invalid = false;

    if(isset($_POST['submit'])){
        include 'connect.php';
        $email = $_POST['email'];
        $password = $_POST['password'];

        $checkquery = "SELECT * FROM `registration1` where `Email`='$email' AND `status`='active'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){
            $userdata = mysqli_fetch_assoc($query);
            $hash = $userdata['Password'];
            $pass_verify = password_verify($password, $hash);
            if($pass_verify){ 
                $loggedIn = true;
                $_SESSION['userdata'] = $userdata;
                $_SESSION['user_id'] = $userdata['Sr_No'];
                $_SESSION['fullName'] = $userdata['First_Name'].' '.$userdata['Last_Name'];
            }
            else{ 
                $incorrectPass = true;
            }
        }
        else{ 
            $invalid = true;
        }
        mysqli_close($con);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="./images/logo.png">
    <link rel="stylesheet" href="sign_up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    
    <div id="container">
        <?php
            if($loggedIn == true){
                header('location:home.php');
            }

            if($incorrectPass == true){ ?>
                <span id="error">Incorrect password...<b onclick="remove(this)">&times;</b></span>
        <?php }

            if($invalid == true){ ?>
                <span id="error">Invalid credentials...<b onclick="remove(this)">&times;</b></span>
        <?php } ?>
        
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Login</h2>
            <div class="input" id="field3">
                <label>Email</label>
                <input type="email" name="email" id="email" autocomplete="off" autofocus required>
            </div>
            <div class="input" id="field4">
                <label>Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
            </div>
            <div class="forget">
                <a href="email_recovery.php">Forget password ?</a>
            </div>
            <button type="submit" name="submit" id="btn">Login</button>
            <p id="para">Don't have an account ?<a href="sign_up.php">Sign Up</a></p>
        </form>
    </div>

    <script src="sign_up.js"></script>
</body>
</html>