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
    <title>MyContact</title>
    <link rel="stylesheet" href="admin_navbar_details.css?v=3">
    <link rel="stylesheet" href="footer_contact_details.css?v=7">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <?php
        include 'dash_navbar.php';
    ?>

    <nav>
        <div id="add">
            <a href="footer_follow_details.php" id="submit"><i class="fa-solid fa-backward"></i>&nbsp;&nbsp;&nbsp;&nbsp; Backward</a>
            <a href="footer_contact_add.php" id="submit1">Add MyContact</a>
            <a href="booking_details.php" id="submit2">Forward &nbsp;&nbsp;<i class="fa-solid fa-forward"></i></a>
        </div>
    </nav>

    <div id="container">

        <?php

            include 'connect.php';

            $sql = "SELECT * FROM `mycontact36`";
            $result = mysqli_query($con, $sql);
            if($result){
                while($row = mysqli_fetch_assoc($result)){ ?>
                    <div id="contact">
                        <div class="div"><label><?php echo $row['Title']; ?></label><div><?php echo $row['Info']; ?></div></div>
                        <div id="date"><?php echo $row['Date']; ?></div>
                        <button type="submit" id="update"><a href="footer_contact_update.php?update=<?php echo $row['Sr_No']; ?>">Update</a></button>
                        <button type="submit" id="delete"><a href="footer_contact_delete.php?delete=<?php echo $row['Sr_No']; ?>">Delete</a></button>
                    </div>
               <?php }
            }
        ?>

    </div>    
</body>
</html>