<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="about.css">
</head>
<body>
    <?php
        include "navbar.php";
    ?>
    
    <section id="container">

        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `content33`";
            $result = mysqli_query($con, $selectquery);
            if($result){
                while($row = mysqli_fetch_assoc($result)){ ?>
                    <img src="content_img/<?php echo $row['Content_Image']; ?>" alt="Content Image">
                    <div id="content"><?php echo $row['Description']; ?></div>                 
            <?php }
            }  ?>

    </section>

    <section id="container2">
        <h2>Our Team</h2>
        <div id="Box">

        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `teammngr03`";
            $result = mysqli_query($con, $selectquery);
            if($result){
                while($row = mysqli_fetch_assoc($result)){ ?>                
                    <div class="box2">
                        <img src="team_img/<?php echo $row['Person_Image']; ?>" alt="Team Image">
                        <div class="name"><?php echo $row['Name']; ?></div>
                    </div>
                <?php }
            } ?>

    </section>

    <footer>
        <div id="Boxxx">
            <div class="box4" id="box4">
                <h2>Menu</h2>
                <ul id="menu">
        
                    <?php
                        include 'connect.php';
                        $sql = "SELECT * FROM `menu1`";
                        $result = mysqli_query($con, $sql);
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){ ?>
                                    <li><a href="<?php echo $row['Link']; ?>.php" target="_self"><?php echo $row['Name']; ?></a></li>
                            <?php }
                        } ?>

                        <?php if(!isset($_SESSION['fullName'])){ ?>
                            <li><a href="login.php" target="_self">Login</a></li>
                            <li><a href="sign_up.php" target="_self">Sign Up</a></li>
                        <?php } ?>
                        <?php if(isset($_SESSION['fullName'])){ ?>
                            <li><a href="logout.php" target="_self">Logout</a></li>
                        <?php } ?>

                    </ul>   
            </div>

            <div class="box4" id="box5">
                <h2>Follow</h2>

                <?php
                    include 'connect.php';
                    $sql = "SELECT * FROM `follow2`";
                    $result = mysqli_query($con, $sql);
                    if($result){
                        while($row = mysqli_fetch_assoc($result)){ ?>
                            <ul id="social-media">
                                <li><img src="social_media_img/<?php echo $row['Image']; ?>" alt="Media Images"><a href="<?php echo $row['Link']; ?>" id="anchor"><?php echo $row['Name']; ?></a></li>
                            </ul>
                    <?php }
                    } ?>

            </div>

            <div class="box4" id="box6">
                <h2>Contact</h2>

                <?php
                    include 'connect.php';
                    $sql = "SELECT * FROM `mycontact36`";
                    $result = mysqli_query($con, $sql);
                    if($result){
                        while($row = mysqli_fetch_assoc($result)){ ?>
                            <div id="contact">
                                <div id="div"><label><?php echo $row['Title']; ?></label><div><?php echo $row['Info']; ?></div></div>
                            </div>
                    <?php }
                    }
                ?>

            </div>
        </div>
        <p>All &copy; <?php echo date('Y'); ?> ShadiKarwao.com are reserved.</p>
    </footer>
</body>
</html>