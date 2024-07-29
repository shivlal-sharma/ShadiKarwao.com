<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="navbar.css?v=1">
    <link rel="stylesheet" media="screen and (max-width:895px)" href="navbar_res.css?v=1">
</head>
<body>
    <div id="header">

    <?php
        include 'connect.php';
        $selectquery = "SELECT * FROM `navbar4`";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>

                    <div id="img">
                        <img src="navbar_img/<?php echo $row['Image']; ?>">
                    </div>
           <?php }
        }
    ?>

        <div id="logoname">ShadiKarwao</div>

        <ul id="mylink">

    <?php
        $sql = "SELECT COUNT(*) AS total FROM `wishlist30`";
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
                <li><a href="<?php echo $row['Link']; ?>.php"><?php echo $row['Name']; ?></a></li>
           <?php }
        }
    ?>
    <li><a href="wishlist.php" id="count">Wishlist<sup id="color"><?php echo $count ?></sup></a></li>
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
    <input type="checkbox" id="openSidebarMenu">
    <label for="openSidebarMenu" id="sidebarIconToggle">
        <div class="spinner top"></div>
        <div class="spinner middle"></div>
        <div class="spinner bottom"></div>
    </label>
    <div id="sidebarMenu">
        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `navbar4`";
            $query = mysqli_query($con, $selectquery);
            if($query){
                while($row = mysqli_fetch_assoc($query)){ ?>

                        <div id="img">
                            <img src="navbar_img/<?php echo $row['Image']; ?>">
                        </div>
            <?php }
            }
        ?>
        <ul class="menu">
            <?php
            $selectquery = "SELECT * FROM `navbar363`";
            $query = mysqli_query($con, $selectquery);
            if($query){
                while($row = mysqli_fetch_assoc($query)){ ?>

                            <li><a href="<?php echo $row['Link']; ?>.php"><?php echo $row['Name']; ?></a></li>

            <?php }
            } ?>
            <li id="count1"><a href="wishlist.php">Wishlist<sup id="color1"><?php echo $count ?></sup></a></li>
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

    <!-- <script src="navbar.js?v=1"></script> -->

</body>
</html>