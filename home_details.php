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
    <title>Home</title>
    <link rel="stylesheet" href="admin_navbar_details.css">
    <link rel="stylesheet" href="home_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        include 'dash_navbar.php';
    ?>
    <nav>
    <div id="add">
            <a href="navbar_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="home_content_add.php" id="submit1">Add Content</a>
            <a href="home_link_details.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>

    <div id="container">

        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `home6`";
            $result = mysqli_query($con, $selectquery);
            if($result){
                while($row = mysqli_fetch_assoc($result)){ ?>
                <div class="box">
                    <p class="content"><?php echo $row['Heading']; ?></p>
                    <p class="content"><?php echo $row['Content']; ?></p>
                    <p class="content"><?php echo $row['Ask']; ?></p>
                    <p><?php echo $row['Date']; ?></p>
                    <button type="submit" id="update"><a href="home_content_update.php?update=<?php echo $row['Sr_No']; ?>">Update</a></button>
                    <button type="submit" id="delete"><a href="home_content_delete.php?delete=<?php echo $row['Sr_No']; ?>">Delete</a></button>
                </div>
            <?php }
            }  ?>

    </div>
</body>
</html>