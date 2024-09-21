<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locations</title>
    <link rel="stylesheet" href="admin_navbar_details.css">
    <link rel="stylesheet" href="team_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        include 'dash_navbar.php';
    ?>
    <nav>
        <div id="add">
            <a href="content_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="add_team.php" id="submit1">Add Team</a>
            <a href="details_details1.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>

    <div id="container">
        <?php

            include 'connect.php';

            $selectquery = "SELECT * FROM `teammngr03`";
            $result = mysqli_query($con, $selectquery);
            if($result){
                while($row = mysqli_fetch_assoc($result)){ ?>
                
                    <div id="box">
                        <img src="team_img/<?php echo $row['Person_Image']; ?>" alt="Team Image">
                        <div class="name"><?php echo $row['Name']; ?></div>
                        <div class="name"><?php echo $row['Date']; ?></div>
                        <button type="submit" id="update"><a href="team_update.php?update=<?php echo $row['Sr_No']; ?>">Update</a></button>
                        <button type="submit" id="delete"><a href="team_delete.php?delete=<?php echo $row['Sr_No']; ?>">Delete</a></button>
                    </div>

            <?php }
            }  ?>
    </div>
</body>
</html>