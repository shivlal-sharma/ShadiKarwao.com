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
    <title>Locations</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
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

        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `location001`";
            $result = mysqli_query($con, $selectquery);
            if(mysqli_num_rows($result) > 0){
                echo "<div id='container'>";
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
            echo "</div>";
            }else{
                echo "<h2 style='text-align:center;margin-top:100px;'>There is no Location Available<h2>";
            }  ?>
</body>
</html>