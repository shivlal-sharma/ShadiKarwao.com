<?php
    session_start();
    if(isset($_SESSION['FullName'])){
        header('location:dashboard.php');
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
                    alert(" You have logged in successfully...");
                    location.replace('dashboard.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Incorrect password...");
                </script>
            <?php }
        }
        else{ ?>
            <script>
                alert("Invalid credentials...");
            </script>
        <?php  }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="sign_up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include 'dash_navbar.php'; ?>
    
    <div id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Admin</h2>
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
                <a href="admin_email_recovery.php">Forget password ?</a>
            </div>
            <button type="submit" name="submit" id="btn">Login</button>
        </form>
    </div>

    <script src="sign_up.js"></script>
</body>
</html>