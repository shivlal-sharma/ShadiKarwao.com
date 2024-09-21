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
        $location_folder = "details_img/$location_img";

        $checkquery = "SELECT * FROM `details4` WHERE `Image`='$location_img'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Details already exists...')
            </script>
       <?php }
        else{
            $insertquery = "INSERT INTO `details4` (`Image`, `Name`, `Date`) VALUES ('$location_img', '$name', current_timestamp())";
            $result  = mysqli_query($con, $insertquery);
            if($result){
                move_uploaded_file($location_tmp_name, $location_folder); ?>
                <script>
                    alert('Details has added successfully!');
                    location.replace('details_details4.php');
                </script>
           <?php }
            else{ ?>
                <script>
                    alert('Something went wrong...');
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
    <title>Add Details</title>
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
            <h2>Add Details</h2>
            <div class="input">
                <label for="location_img">Image</label>
                <input type="file" id="location_img" accept="image/*" name="location_img" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" autofocus autocomplete="off" required>
            </div>
            <div class="input" id="field-submit">
                <button type="submit" name="submit" id="btn">Add Details</button>
            </div>
            <div class="input">
                <button type="submit" id="btn1"><a href="details_details4.php">Go Back</a></button>
            </div>
        </form>
    </section>
</body>
</html>