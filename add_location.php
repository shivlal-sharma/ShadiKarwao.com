<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $location_name = $_POST['name'];
        $capacity = $_POST['capacity'];
        $price = $_POST['price'];
        $details = $_POST['details'];
        $location_img = $_FILES['location_img']['name'];
        $location_tmp_name = $_FILES['location_img']['tmp_name'];
        $location_folder = 'location_img/'.$location_img;

        $checkquery = "SELECT * FROM `location001` WHERE `Location_Image`='$location_img'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Already Exists, \nPlease Enter another Location...')
            </script>
       <?php }
        else{
            $insertquery = "INSERT INTO `location001` (`Location_Name`, `Capacity`, `Price`, `Location_Image`, `Details`, `Date`) VALUES ('$location_name', '$capacity', '$price', '$location_img', '$details', current_timestamp())";
            $result  = mysqli_query($con, $insertquery);
            if($result){
                move_uploaded_file($location_tmp_name, $location_folder); ?>
                <script>
                    alert('Location has been Added Successfully...');
                    location.replace('location_details.php');
                </script>
           <?php }
            else{ ?>
                <script>
                    alert('Location Not Added...');
                </script>
           <?php }
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Location</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
</head>
<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post" enctype="multipart/form-data">
                <h2>Add Location</h2>
                <div class="input">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" onkeyup="check(this.value)" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="capacity">Capacity</label>
                    <input type="number" id="capacity" name="capacity" onkeyup="check1(this.value)" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" onkeyup="check2(this.value)" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="location_img">Image</label>
                    <input type="file" id="location_img" accept="image/png, image/jpg, image/jpeg, image/webp" name="location_img" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <label for="details">Details</label>
                    <input type="text" id="details" name="details" onkeyup="check3(this.value)" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <button type="submit" name="submit" id="btn">Add</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="location_details.php">Go Back</a></button>
                </div>
            </form>
        </section>

        <script src="add_location.js?v=5"></script>

</body>
</html>