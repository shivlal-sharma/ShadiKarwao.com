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
    <link rel="stylesheet" href="location_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include 'dash_navbar.php'; ?>

    <nav>
        <div id="add">
            <a href="dashboard.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="add_location.php" id="submit1">Add Location</a>
            <a href="wishlist_details.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>

    <div id="container">
        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `location001`";
            $result = mysqli_query($con, $selectquery);
            if($result){
                while($row = mysqli_fetch_assoc($result)){ ?>
                
                    <div class="box">
                        <img src="location_img/<?php echo $row['Location_Image']; ?>" alt="Location Image">
                        <div class="name"><?php echo $row['Location_Name']; ?></div>
                        <div class="name">Capacity - <?php echo number_format($row['Capacity']); ?> People</div>
                        <div class="name">Rs.<?php echo number_format($row['Price']); ?>/-</div>
                        <button type="submit" id="detail"><a href="details<?php echo $row['Location_Id']; ?>.php"><?php echo $row['Details']; ?></a></button>
                        <div class="name"><?php echo $row['Date'] ?></div>
                        <button type="submit" id="update"><a href="location_update.php?update=<?php echo $row['Location_Id']; ?>">Update</a></button>
                        <button type="submit" id="delete"><a href="location_delete.php?delete=<?php echo $row['Location_Id']; ?>">Delete</a></button>
                    </div>

            <?php }
            }  ?>
    </div>
</body>
</html>