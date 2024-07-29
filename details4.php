<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="details.css?v=1">
    <link rel="stylesheet" media="screen and (max-width:1050px)" href="details_res.css?v=1">
</head>
<body>
    <?php
        include "navbar.php";
    ?>

    <section id="container">
        <div id="box">
        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `details4`";
            $query = mysqli_query($con, $selectquery);
            if($query){
                while($row = mysqli_fetch_assoc($query)){ ?>
                        <div id="details">
                            <img src="details_img/<?php echo $row['Image'] ?>" alt="Location Images">
                            <p><?php echo $row['Name'] ?></p>
                        </div>
            <?php }
            } 
        ?>  
        </div>
        <div id="content">
        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `detailsContent4`";
            $query = mysqli_query($con, $selectquery);
            if($query){
                while($row = mysqli_fetch_assoc($query)){ ?>
                    <p><?php echo $row['Content1']; ?></p>
                    <p><?php echo $row['Content2']; ?></p>
                    <button><a href="<?php echo $row['Link']; ?>.php"><?php echo $row['Name']; ?></a></button>
            <?php }
            } ?>  
        </div>
    </section>
</body>
</html>