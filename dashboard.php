<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome! <?php echo $_SESSION['FullName']; ?></title>
    <link rel="stylesheet" href="dashboard.css?v=1">
</head>
<body>
    <?php
        include 'dash_navbar.php';
    ?>

    <div class="box">
        <div class="info">
            <div class="about">User</div>
            <div class="count">
                <?php 
                    $users = "SELECT COUNT(*) as total FROM `registration1` WHERE `Status`='active'";
                    $query = mysqli_query($con,$users);
                    if(mysqli_num_rows($query)>0){
                        $row = mysqli_fetch_assoc($query);
                        echo  $count = $row['total'];
                    }
                    else{
                        echo $count = 0;
                    }
                ?>
            </div>
        </div>
        <div class="info">
            <div class="about">Location</div>
            <div class="count">
                <?php 
                    $users = "SELECT COUNT(*) as total FROM `location001`";
                    $query = mysqli_query($con,$users);
                    if(mysqli_num_rows($query)>0){
                        $row = mysqli_fetch_assoc($query);
                        echo $count = $row['total'];
                    }
                    else{
                        echo $count = 0;
                    }
                ?>
            </div>
        </div>
        <div class="info">
            <div class="about">Contact</div>
            <div class="count">
                <?php 
                    $users = "SELECT COUNT(*) as total FROM `contact363`";
                    $query = mysqli_query($con,$users);
                    if(mysqli_num_rows($query)>0){
                        $row = mysqli_fetch_assoc($query);
                        echo $count = $row['total'];
                    }
                    else{
                        echo $count = 0;
                    }
                ?>
            </div>
        </div>
        <div class="info">
            <div class="about">Booking</div>
            <div class="count">
                <?php 
                    $users = "SELECT COUNT(*) as total FROM `payment300`";
                    $query = mysqli_query($con,$users);
                    if(mysqli_num_rows($query)>0){
                        $row = mysqli_fetch_assoc($query);
                        echo $count = $row['total'];
                    }
                    else{
                        echo $count = 0;
                    }
                ?>
            </div>
        </div>
        <div class="info">
            <div class="about">Admin</div>
            <div class="count">
                <?php 
                    $users = "SELECT COUNT(*) as total FROM `admin003`";
                    $query = mysqli_query($con,$users);
                    if(mysqli_num_rows($query)>0){
                        $row = mysqli_fetch_assoc($query);
                        echo $count = $row['total'];
                    }
                    else{
                        echo $count = 0;
                    }
                ?>
            </div>
        </div>
        <div class="info">
            <div class="about">Team</div>
            <div class="count">
                <?php 
                    $users = "SELECT COUNT(*) as total FROM `teammngr03`";
                    $query = mysqli_query($con,$users);
                    if(mysqli_num_rows($query)>0){
                        $row = mysqli_fetch_assoc($query);
                        echo $count = $row['total'];
                    }
                    else{
                        echo $count = 0;
                    }
                ?>
            </div>
        </div>
        <?php if(isset($_SESSION['FullName'])){ ?>
            <div id="logout"><a href="admin_logout.php">Logout</a></div>
        <?php } ?>  
</body>
</html>