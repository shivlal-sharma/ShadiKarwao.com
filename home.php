<?php
    session_start();
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
    <title>Home</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="home.css">
    <style>
        @media screen and (max-width:396px) {
            #box{
                font-size: 16.2px;
            }
        }
    </style>
</head>
<body>
    <?php include "navbar.php"; ?>

    <section id="container">
        <div id="box">
    <?php 
            include 'connect.php';
            $selectquery = "SELECT * FROM `home6`";
            $query = mysqli_query($con, $selectquery);
            if($query){
                while($row = mysqli_fetch_assoc($query)){ ?>

                            <h2 id="heading"><?php echo $row['Heading']; ?></h2>           
                            <p id="para"><?php echo $row['Content']; ?></p>           
                            <p id="ask"><?php echo $row['Ask']; ?></p>  

            <?php }
            } ?>

            <div id="anchor"> <?php
            $selectquery = "SELECT * FROM `homelink36`";
            $query = mysqli_query($con, $selectquery);
            if($query){ 
                while($row = mysqli_fetch_assoc($query)){ ?>
               
                    <p><a href="<?php echo $row['Link']; ?>.php" ><?php echo $row['Name']; ?></a><?php echo $row['Divider']; ?></p>
            
            <?php }
            } ?>

            </div>
        </div>
    </section>

            <!-- <h1>Welcome!</h1>
            <p class="content">Plan Your Dream Wedding!</p>
            <p class="content">Let us help you to create the perfect day!</p>
            <p class="content">Let us turn your special day into a magical experience!</p>
            <p id="ask">Do you what to know more? </p>  -->
</body>
</html>