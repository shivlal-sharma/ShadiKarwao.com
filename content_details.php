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
    <title>Contents</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="admin_navbar_details.css">
    <link rel="stylesheet" href="content_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        include 'dash_navbar.php';
    ?>

    <nav>
    <div id="add">
            <a href="home_link_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="add_content.php" id="submit1">Add Content</a>
            <a href="team_details.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>

    <div id="container">

        <?php

            include 'connect.php';

            $selectquery = "SELECT * FROM `content33`";
            $result = mysqli_query($con, $selectquery);
            if($result){
                while($row = mysqli_fetch_assoc($result)){ ?>
                
                    <div id="box">
                        <img src="content_img/<?php echo $row['Content_Image']; ?>" alt="Content Image">
                        <div id="content">
                            <div class="desc"><?php echo $row['Description']; ?></div>
                            <div class="desc" id="date"><?php echo $row['Date'] ?></div>
                            <div id="button">
                                <button type="submit" id="update"><a href="content_update.php?update=<?php echo $row['Sr_No']; ?>">Update</a></button>
                                <button type="submit" id="delete"><a href="content_delete.php?delete=<?php echo $row['Sr_No']; ?>">Delete</a></button>
                            </div>
                        </div>  
                    </div>
                    
            <?php }
            }  ?>

    </div>
</body>
</html>