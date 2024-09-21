<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
    }
    
    $user_id = $_SESSION['user_id'];

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $location_id = $_POST['location_id'];
        $deletequery = "DELETE FROM `wishlist30` WHERE `Location_Id`=$location_id AND `user_id`=$user_id";
        mysqli_query($con, $deletequery);
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $location_id = $_POST['location_id'];
        $action = $_POST['action'];
        if($action === "add"){
            $insertquery = "INSERT INTO `wishlist30` (`Location_Id`,`user_id`,`Date`) VALUES($location_id,$user_id,current_timestamp())";
            mysqli_query($con, $insertquery);
        }
        else if($action === "remove"){
            $deletequery = "DELETE FROM `wishlist30` WHERE `Location_Id`=$location_id AND `user_id`=$user_id";
            mysqli_query($con, $deletequery);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="services.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    
    <div id="container" style='margin-top:60px;'>
        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `wishlist30` WHERE `user_id`=$user_id";
            $result = mysqli_query($con, $selectquery);
            $num_rows = mysqli_num_rows($result);
            if($num_rows > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $location_id = $row['Location_Id'];   
                    $select_location = "SELECT * FROM `location001` WHERE `Location_Id`=$location_id";
                    $location_result = mysqli_query($con,$select_location);
                    $location_num_rows = mysqli_num_rows($location_result);
                    if($location_num_rows > 0){
                        while($location = mysqli_fetch_assoc($location_result)){
                            $location_image = $location['Location_Image'];
                            $location_name = $location['Location_Name'];
                            $capacity = $location['Capacity'];
                            $price = $location['Price'];
                            $details = $location['Details'];
                            $location_id = $location['Location_Id'];
                            echo "<div class='card'>
                                    <div class='heart active' data-location-id='$location_id'><i class='fa-sharp fa-solid fa-heart'></i></div>
                                    <img src='./images/$location_image' alt='$location_name' class='location-image'>
                                    <div class='card-content'>
                                        <h2 class='location-name'>$location_name</h2>
                                        <p class='location-capacity'>Capacity: $capacity</p>
                                        <p class='location-price'>Price: Rs.".number_format($price,2,'.',',')."/-</p>
                                        <button class='view-detail'><a href='details$location_id.php?no=$location_id'>$details</a></button>
                                    </div>
                                </div>";
                        }
                    }else{
                        echo "<div id='location'>
                                <h2>There is no Location in the Wishlist <i class='fa-sharp fa-solid fa-heart' style='color:red;'></i></h2>
                                <button class='view-detail' style='width:130px;margin-top:15px;'><a href='services.php'>View Services</a></button>
                            </div>";
                    }         
                }
            } else{
                echo "<div id='location'>
                        <h2>There is no Location in the Wishlist <i class='fa-sharp fa-solid fa-heart' style='color:red;'></i></h2>
                        <button class='view-detail' style='width:130px;margin-top:15px;'><a href='services.php'>View Services</a></button>
                    </div>";
            } 
        ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            const wishlist = JSON.parse(localStorage.getItem('wishlist'));
            $('.heart').on('click',function(){
                const heart = $(this);
                const locationId = heart.data('location-id');

                $.ajax({
                    url:'wishlist.php',
                    type:'POST',
                    data:{location_id:locationId},
                    success:function(response){
                        delete wishlist[locationId];
                        localStorage.setItem('wishlist',JSON.stringify(wishlist));
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>