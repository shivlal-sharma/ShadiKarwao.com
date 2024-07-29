<?php
    session_start();
    include 'connect.php';

    $exists = false;
    $success = false;
    $error = false;

    if(isset($_POST['heart'])){
        $location_name = $_POST['location_name'];
        $capacity = $_POST['capacity'];
        $price = $_POST['price'];
        $location_image = $_POST['location_image'];
        $details = $_POST['details'];
        $location_id = $_POST['location_id'];

        if(isset($_SESSION['fullName'])){
            $checkquery = "SELECT * FROM `wishlist30` WHERE `Location_Id`=$location_id";
            $query = mysqli_query($con, $checkquery);
            if(mysqli_num_rows($query) > 0){
                $exists = true;
            }
            else{
                $insertquery = "INSERT INTO `wishlist30` (`Location_Name`, `Capacity`, `Price`, `Location_Image`, `Details`, `Location_Id`, `Date`) VALUES ('$location_name', '$capacity', '$price', '$location_image', '$details', '$location_id', current_timestamp())";
                $result = mysqli_query($con, $insertquery);
                if($result){
                    $success = true;
                }
                else{ 
                    $error = true;
                }
            }  
        }
        else{
            header('location:login.php');
        }
    } 
    
    if(isset($_POST['sendLocation'])){
        $location_id = $_POST['location_id'];

        $checkquery = "SELECT * FROM `location001` WHERE `Location_Id`= $location_id";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows){ 
            $locationData = mysqli_fetch_assoc($result);
            $_SESSION['location'] = $locationData;
        } 
    }
?>

    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="services.css?v=6">
    <link rel="stylesheet" media="screen and (max-width:1100px)" href="services_res.css?v=1">
</head>
<body>
    <?php
        include "navbar.php";
    ?>
    <div id="container">
        <?php
            if($exists == true){ ?>
                <span id="error">Location has already been added Successfully! <b onclick="remove(this)">&times;</b></span>
           <?php }

            if($success == true){ ?>
                <span id="success">Location has been added Successfully! <b onclick="remove(this)">&times;</b></span>
           <?php }

            if($error == true){ ?>
                <span id="error">Location has not been added Successfully! <b onclick="remove(this)">&times;</b></span>
           <?php }
        ?>
        <div id="Box">

        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `location001`";
            $result = mysqli_query($con, $selectquery);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){ ?>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">                
                    <div id="box">
                        <img src="location_img/<?php echo $row['Location_Image']; ?>" alt="Location Image">
                        <div class="name"><?php echo $row['Location_Name']; ?></div>
                        <div class="name">Capacity - <?php echo number_format($row['Capacity']); ?> People</div>
                        <div class="name">Rs.<?php echo number_format($row['Price']); ?>/-</div>
                        <input type="hidden" name="location_image" value="<?php echo $row['Location_Image']; ?>">
                        <input type="hidden" name="location_name" value="<?php echo $row['Location_Name']; ?>">
                        <input type="hidden" name="capacity" value="<?php echo $row['Capacity']; ?>">
                        <input type="hidden" name="price" value="<?php echo $row['Price']; ?>">
                        <input type="hidden" name="details" value="<?php echo $row['Details']; ?>">
                        <input type="hidden" name="location_id" value="<?php echo $row['Location_Id']; ?>">
                        <div id="detail"><a href="details<?php echo $row['Location_Id']; ?>.php"><?php echo $row['Details']; ?></a></div>
                        <button id="book" name="sendLocation">Book Now</button>
                        <button id="heart" name="heart"><i class='fa-sharp fa-solid fa-heart' onclick='heart(this)'></i></button>
                    </div>
                </form>
            <?php }
            }
            else{ ?>
                <div id="location">
                    <h2>There is no location available</h2>
                </div>
           <?php }  ?>
        </div>
    </div>

    <script src="services.js?v=2"></script>
</body>
</html>