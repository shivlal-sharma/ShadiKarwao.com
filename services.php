<?php
    session_start();
    include 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="services.css">
</head>
<body>
    <?php
        include "navbar.php";
    ?>
    <header class="header2">
        <h1>Explore Our Locations</h1>
        <p>Find the perfect place for your next event</p>
    </header>
    <div id="container">
        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `location001`";
            $result = mysqli_query($con, $selectquery);
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){ 
                    $location_image = $row['Location_Image'];
                    $location_name = $row['Location_Name'];
                    $capacity = $row['Capacity'];
                    $price = $row['Price'];
                    $details = $row['Details'];
                    $location_id = $row['Location_Id'];
                    echo "<div class='card'>
                            <span class='heart' data-location-id='$location_id'><i class='fa-sharp fa-solid fa-heart'></i></span>
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
                        <h2>There is no Location Available</h2>
                    </div>";
            }  
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const wishlist = JSON.parse(localStorage.getItem('wishlist')) || {};

            $('.heart').each(function(){
                const heart = $(this);
                const locationId = heart.data('location-id');

                if(wishlist[locationId]){
                    heart.addClass('active');
                }
                else{
                    heart.removeClass('active');
                }
            });

            $('.heart').click(function() {
                const heart = $(this);
                const locationId = heart.data('location-id');
                const action = heart.hasClass('active') ? 'remove' : 'add';

                $.ajax({
                    url: 'wishlist.php',
                    type: 'POST',
                    data: { action: action, location_id: locationId },
                    success: function(response) {
                        if (action === 'add') {
                            heart.addClass('active');
                            wishlist[locationId] = true;
                        } else {
                            heart.removeClass('active');
                            delete wishlist[locationId];
                        }
                        localStorage.setItem('wishlist', JSON.stringify(wishlist));
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>