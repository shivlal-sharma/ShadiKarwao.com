<?php
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
    <div id="header">
    <?php
        include 'connect.php';
        $selectquery = "SELECT * FROM `navbar4`";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>
                    <div class="navbar-left">
                        <span id="hamburger"><i class="fa-sharp fa-solid fa-bars"></i></span>
                        <a href="about_us.php"><img src="navbar_img/<?php echo $row['Image']; ?>"></a>
                    </div>
           <?php }
        }
    ?>
        <ul class="navbar-center">

    <?php
        $user_id = $_SESSION['user_id'] ?? 0;
        $sql = "SELECT COUNT(*) AS total FROM `wishlist30` WHERE `user_id`=$user_id";
        $countQuery = mysqli_query($con,$sql);
        $num_rows = mysqli_num_rows($countQuery);
        if($num_rows > 0){
            $row = mysqli_fetch_assoc($countQuery);
            $count = $row['total'];
        }
        else{
            $count = 0;
        }
        $selectquery = "SELECT * FROM `navbar363`";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>
                <li class="navbar-links"><a href="<?php echo $row['Link']; ?>.php"><?php echo $row['Name']; ?></a></li>
           <?php }
        }
    ?>
    <li class="wishlist-link"><a href="wishlist.php" class="wishlist">Wishlist <i class="fa-sharp fa-solid fa-heart" style="color:red;"></i><sup><?php echo $count ?></sup></a></li>
        </ul>
        <ul class="navbar-right">
            <?php
                if(!isset($_SESSION['fullName'])){
                    echo '<li class="sign_up"><a href="sign_up.php">Sign Up</a></li>
                    <li class="login"><a href="login.php">Login</a></li>';
                }
            ?>
            <?php
                if(isset($_SESSION['fullName'])){
                    echo '<li class="logout"><a href="logout.php">Logout</a></li>';
                }
            ?>
        </ul>
    </div>
    <div class="modal">
        <div id="sidebarMenu">
            <span class="cancel">&times;</span>
            <ul class="menu">
                <?php
                $selectquery = "SELECT * FROM `navbar363`";
                $query = mysqli_query($con, $selectquery);
                if($query){
                    while($row = mysqli_fetch_assoc($query)){ ?>
                        <li><a href="<?php echo $row['Link']; ?>.php"><?php echo $row['Name']; ?></a></li>
                <?php }
                } ?>
                <li><a href="wishlist.php" class="wishlist">Wishlist <i class="fa-sharp fa-solid fa-heart" style="color:red;"></i><sup><?php echo $count ?></sup></a></li>
                <?php
                    if(!isset($_SESSION['fullName'])){
                        echo '<li class=item><a href="sign_up.php">Sign Up</a></li>
                        <li class=item><a href="login.php">Login</a></li>';
                    }
                ?>
                <?php
                    if(isset($_SESSION['fullName'])){
                        echo '<li class=item><a href="logout.php">Logout</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>

    <script src="navbar.js"></script>

</body>
</html>