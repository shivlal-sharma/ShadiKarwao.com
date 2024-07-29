<?php
    session_start();
    include 'connect.php';
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $checkquery = "SELECT * FROM `admin003` where `Email`='$email' && `status`='active'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){
            $row = mysqli_fetch_assoc($query);
            $_SESSION['FullName'] = $row['FirstName'].' '.$row['LastName'];
            $hash = $row['Password'];
            $pass_verify = password_verify($password, $hash);
            if($pass_verify){ ?>
                <script>
                    alert(" You are logged in Successfully...");
                    location.replace('dashboard.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Please, Insert the correct Password...");
                </script>
            <?php }
        }
        else{ ?>
            <script>
                alert("Invalid Credentials.\nPlease, Fill the correct Data...")
            </script>
        <?php  }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        include 'navbar.php';
    ?>
    
    <div id="container">

        <?php
            if(!isset($_SESSION['message'])){ ?>
                <script>
                    alert('You are logged out, \nPlease Login...');
                </script>
           <?php }
        ?>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Admin</h2>
            <div class="inputs">
                <label>Email</label><input type="email" name="email" id="email" autocomplete="off" autofocus required>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="inputs">
                <label>Password</label><input type="password" name="password" id="password" autocomplete="off" required>
                <i class="fa-solid fa-eye-slash" id="eyeClose" onclick="toggle()"></i>
            </div>
            <div class="forget">
                <a href="admin_email_recovery.php">Forget password ?</a>
            </div>
            <button type="submit" name="submit" id="btn">Login</button>
            <p>Not an Admin ?<a href="sign_up.php">Sign Up</a></p>
        </form>
    </div>

    <script src="login.js"></script>
    
</body>
</html>