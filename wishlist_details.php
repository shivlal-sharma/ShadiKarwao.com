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
    <title>Wishlists</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="admin_navbar_details.css">
    <link rel="stylesheet" href="location_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        include 'dash_navbar.php';
    ?>
    
    <nav>
        <div id="add">
            <a href="location_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="wishlist_add.php" id="submit1">Add Wishlist<i class="fa-sharp fa-solid fa-heart" style="color:red";></i></a>
            <a href="booking_details.php" id="submit2">Forward &nbsp;&nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>
    <?php
        include 'connect.php';
        $select_location_id = "SELECT * FROM `wishlist30`";
        $result = mysqli_query($con, $select_location_id);
        if(mysqli_num_rows($result) > 0){
            echo "<div id='container'>";
            while($rows = mysqli_fetch_assoc($result)){
                $location_id = $rows['Location_Id'];
                $user_id = $rows['user_id'];
                $selectquery = "SELECT * FROM `location001` WHERE `Location_Id`=$location_id";
                $query = mysqli_query($con,$selectquery);
                if(mysqli_num_rows($query) > 0){
                    $row = mysqli_fetch_assoc($query); ?>
                        <div class="box">
                            <img src="location_img/<?php echo $row['Location_Image']; ?>" alt="Location Image">
                            <div class="name"><?php echo $row['Location_Name']; ?></div>
                            <div class="name">Capacity - <?php echo number_format($row['Capacity']); ?> People</div>
                            <div class="name">Rs.<?php echo number_format($row['Price']); ?>/-</div>
                            <button type="submit" id="detail"><a href="details<?php echo $row['Location_Id']; ?>.php"><?php echo $row['Details']; ?></a></button>
                            <div class="name"><?php echo $row['Date'] ?></div>
                            <div id="update" style="color:red;">Location Id <?php echo $location_id; ?></div>
                            <div id="delete" style="color:red;">User Id <?php echo $user_id; ?></div>
                        </div>
                <?php }
            }
            echo "</div>";
        }else{ 
            echo "<h2 style='text-align:center;margin-top:100px;'>There is no Wishlist <i class='fa-sharp fa-solid fa-heart' style='color:red';></i><h2>";
        } 
    ?>
</body>
</html>