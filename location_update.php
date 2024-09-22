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

    if(isset($_POST['submit_update'])){
        $location_id = $_POST['location_id'];
        $location_name = $_POST['location_name'];
        $capacity = $_POST['capacity'];
        $price = $_POST['price'];
        $details = $_POST['details'];
        $location_img = $_FILES['location_img']['name'];
        $location_tmp_name = $_FILES['location_img']['tmp_name'];
   
        $updatequery = "UPDATE `location001` SET `Location_Name`='$location_name', `Capacity`='$capacity', `Price`='$price', `Location_Image`='$location_img', `Details`='$details', `Date`=current_timestamp() WHERE `Location_Id`=$location_id";
        $result = mysqli_query($con, $updatequery);
        if($result){
            move_uploaded_file($location_tmp_name, "location_img/$location_img"); ?>
            <script>
                alert('Location changed successfully...');
                location.replace('location_details.php');
            </script>
    <?php }
    else{ ?>
            <script>
                alert('something went wrong...');
                location.replace('location_details.php');
            </script>
    <?php }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Location</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <?php
        $id = $_GET['update'];
        $selectquery = "SELECT * FROM `location001` WHERE `Location_Id`=$id";
        $result = mysqli_query($con, $selectquery);
        while($row = mysqli_fetch_assoc($result)){
    ?>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <h2>Update Location</h2>
                <div class="input">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="location_name" value="<?php echo $row['Location_Name']; ?>" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="capacity">Capacity</label>
                    <input type="number" id="capacity" name="capacity" value="<?php echo $row['Capacity']; ?>" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" value="<?php echo $row['Price']; ?>" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="location_img">Image</label>
                    <input type="file" id="location_img" accept="image/png, image/jpg, image/jpeg, image/webp" name="location_img" autofocus autocomplete="off" required>
                    <img src="location_img/<?php echo $row['Location_Image']; ?>" alt="Location Image" width="100" height="100">
                </div>
                <div class="input">
                    <label for="details">Details</label>
                    <input type="text" id="details" name="details" value="<?php echo $row['Details']; ?>" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <input type="hidden" name="location_id" value="<?php echo $row['Location_Id']; ?>">
                <div class="input">
                    <button type="submit" name="submit_update" id="btn">Update</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="location_details.php">Go Back</a></button>
                </div>
            </form>
        </section>
<?php } ?>
</body>
</html>