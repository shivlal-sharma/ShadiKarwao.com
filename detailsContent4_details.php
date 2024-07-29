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
    <link rel="stylesheet" href="admin_navbar_details.css?v=1">
    <link rel="stylesheet" href="detailsContent_details.css?v=2">
</head>
<body>
    <?php
        include 'dash_navbar.php';
    ?>

    <nav>
    <div id="add">
            <a href="details_details4.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="detailsContent4_add.php" id="submit1">Add Content</a>
            <a href="details_details5.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>

    <div id="container">

        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `detailsContent4`";
            $result = mysqli_query($con, $selectquery);
            if($result){
                while($row = mysqli_fetch_assoc($result)){ ?>
                <div id="box">
                    <p class="content"><?php echo $row['Content1']; ?></p>
                    <p class="content"><?php echo $row['Content2']; ?></p>
                    <button id="link"><a href="<?php echo $row['Link']; ?>.php"><?php echo $row['Name']; ?></a></button>
                    <p><?php echo $row['Date']; ?></p>
                    <button type="submit" id="update"><a href="detailsContent4_update.php?update=<?php echo $row['Sr_No']; ?>">Update</a></button>
                    <button type="submit" id="delete"><a href="detailsContent4_delete.php?delete=<?php echo $row['Sr_No']; ?>">Delete</a></button>
                </div>
            <?php }
            }  ?>

    </div>
</body>
</html>