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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <?php include 'dash_navbar.php'; ?>

    <div class="box">
        <div class="info">
            <div class="about">Locations</div>
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
            <div class="about">Wishlists <i class="fa-sharp fa-solid fa-heart" style="color:red;"></i></div>
            <div class="count">
                <?php 
                    $users = "SELECT COUNT(*) as total FROM `wishlist30`";
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
            <div class="about">Bookings</div>
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
            <div class="about">Contacts</div>
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
            <div class="about">Users</div>
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
            <div class="about">Admins</div>
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
            <div class="about">Teams</div>
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
</body>
</html>