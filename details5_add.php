<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $location_img = $_FILES['location_img']['name'];
        $location_tmp_name = $_FILES['location_img']['tmp_name'];
        $location_folder = 'details_img/'.$location_img;

        $checkquery = "SELECT * FROM `details5` WHERE `Image`='$location_img'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Already Exists, \nPlease Enter another Details...')
            </script>
       <?php }
        else{
            $insertquery = "INSERT INTO `details5` (`Image`, `Name`, `Date`) VALUES ('$location_img', '$name', current_timestamp())";
            $result  = mysqli_query($con, $insertquery);
            if($result){
                move_uploaded_file($location_tmp_name, $location_folder); ?>
                <script>
                    alert('Details has been Added Successfully...');
                    location.replace('details_details5.php');
                </script>
           <?php }
            else{ ?>
                <script>
                    alert('Details Not Added...');
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
    <!-- <link rel="stylesheet" href="details_details.css?v=0"> -->
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
    <!-- <link rel="stylesheet" media="screen and (max-width:1100px)" href="admin_res.css"> -->
</head>
<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post" enctype="multipart/form-data">
                <h2>Add Details</h2>
                <div class="input">
                    <label for="location_img">Image</label>
                    <input type="file" id="location_img" accept="image/png, image/jpg, image/jpeg, image/webp" name="location_img" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" onkeyup="check(this.value)" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <button type="submit" name="submit" id="btn">Add</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="details_details5.php">Go Back</a></button>
                </div>
            </form>
        </section>

        <script src="add_location.js?v=5"></script>

</body>
</html>