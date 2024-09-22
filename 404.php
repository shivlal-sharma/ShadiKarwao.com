<?php
    include 'connect.php';
    http_response_code(404); // Set the response code to 404
    $icon = "";
    $selectquery = "SELECT * FROM `navbar4`";
    $query = mysqli_query($con, $selectquery);
    if($query){
        $fav_icon = mysqli_fetch_assoc($query); 
        $icon =  $fav_icon['Image'];
    } 
    date_default_timezone_set("Asia/Kolkata");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found - ShadiKarwao</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="404.css" />
</head>
<body>
    <?php include 'navbar.php'; ?>

    <h1>404 Not Found</h1>
    <p>Oops! The page you are looking for was not found.</p>
    <p><strong>Requested URL : </strong><?php echo htmlspecialchars("http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?></p>
    <p><strong>Date and Time : </strong><?php echo htmlspecialchars(date('d-m-Y h:i:s A')); ?></p>
    
    <div class="image-container">
        <img src="images/logo1.png" alt="Company logo">
    </div>
    
    <p>It seems we can’t find what you’re looking for.</p>
    <a href="home.php" class="button">Go to Homepage</a>
</body>
</html>
