<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'navbar_img/'.$image;

        $selectquery = "SELECT * FROM `navbar4` WHERE `Image`='$image'";
        $select = mysqli_query($con, $selectquery);
        $num_rows = mysqli_num_rows($select);
        if($num_rows > 0){ ?>
            <script>
                alert('Image Already Exists, \nPlease Enter another Image...');
                location.replace('navbar_image_details.php');
            </script>
       <?php }
        else{ 
            $insertquery = "INSERT INTO `navbar4` (`Image`, `Date`) VALUES ('$image', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){
                move_uploaded_file($image_tmp_name, $image_folder); ?>
                <script>
                    alert("Image has been added Successfully...");
                    location.replace('navbar_image_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Image not added...");
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
    <title>Add Navbar</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=5">
</head>

<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <h2>Add Navbar</h2>
                <div class="input">
                    <label for="image">Image</label>
                    <input type="file" id="image" accept="image/png, image/jpg, image/jpeg, image/webp" name="image" autofocus autocomplete="off" required>
                </div>      
                <div class="input">
                    <button type="submit" name="submit" id="btn">Add</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="navbar_image_details.php">Go Back</a></button>
                </div>
            </form>
    </section>
</body>
</html>