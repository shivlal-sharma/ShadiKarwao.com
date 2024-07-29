<?php
    session_start();
    include 'connect.php';

    $loggedIn = false;
    $incorrectPass = false;
    $invalid = false;

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $checkquery = "SELECT * FROM `registration1` where `Email`='$email' && `status`='active'";
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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css?v=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        @media screen and (max-width: 430px) {
            span{
                width: 300px;
                text-align:center;
                font-size:1rem;
            }

            b{
                font-size:1.5rem;
            }
        }
    </style>
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    
    <div id="container">
        <?php
            if($loggedIn == true){ ?>
                <span id="success">You are logged in Successfully!<b onclick="remove(this)">&times;</b></span>
                <?php header('location:home.php'); ?>
        <?php }

            if($incorrectPass == true){ ?>
                <span id="error">Fill the correct password...<b onclick="remove(this)">&times;</b></span>
        <?php }

            if($invalid == true){ ?>
                <span id="error">Invalid Credentials, Fill the data correctly...<b onclick="remove(this)">&times;</b></span>
        <?php }
        ?>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Login</h2>
            <div class="inputs">
                <label>Email</label><input type="email" name="email" id="email" autocomplete="off" autofocus required>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="inputs">
                <label>Password</label><input type="password" name="password" id="password" autocomplete="off" required>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
            </div>
            <div class="forget">
                <a href="email_recovery.php">Forget password ?</a>
            </div>
            <button type="submit" name="submit" id="btn">Login</button>
            <p>Con't have an account ?<a href="sign_up.php">Sign Up</a></p>
        </form>
    </div>

    <script src="login.js?v=0"></script>
    
</body>
</html>