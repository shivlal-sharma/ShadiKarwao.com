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
    <title>Menu</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="admin_navbar_details.css">
    <link rel="stylesheet" href="footer_menu_details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php include 'dash_navbar.php'; ?>
    <nav>
        <div id="add">
            <a href="detailsContent6_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="footer_menu_add.php" id="submit1">Add Menu</a>
            <a href="footer_follow_details.php" id="submit2">Forward &nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>
    <div id="container">
        <?php
            include 'connect.php';
            $sql = "SELECT * FROM `menu1`";
            $result = mysqli_query($con, $sql);
            if($result){
                while($row = mysqli_fetch_assoc($result)){ ?>
                    <ul id="menu">
                        <li><a href="<?php echo $row['Link']; ?>.php" id="anchor"><?php echo $row['Name']; ?></a></li>
                        <li><?php echo $row['Date']; ?></li>
                        <li><button type="submit" id="update"><a href="footer_menu_update.php?update=<?php echo $row['Sr_No']; ?>">Update</a></button></li>
                        <li><button type="submit" id="delete"><a href="footer_menu_delete.php?delete=<?php echo $row['Sr_No']; ?>">Delete</a></button></li>
                    </ul>
               <?php }
            }
        ?>
    </div>    
</body>
</html>