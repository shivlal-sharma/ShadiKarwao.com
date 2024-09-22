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

    if(isset($_POST['submit'])){
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = "navbar_img/$image";

        $selectquery = "SELECT * FROM `navbar4` WHERE `Image`='$image'";
        $select = mysqli_query($con, $selectquery);
        $num_rows = mysqli_num_rows($select);
        if($num_rows > 0){ ?>
            <script>
                alert('Logo already exists...');
                location.replace('navbar_image_details.php');
            </script>
       <?php }
        else{ 
            $insertquery = "INSERT INTO `navbar4` (`Image`, `Date`) VALUES ('$image', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){
                move_uploaded_file($image_tmp_name, $image_folder); ?>
                <script>
                    alert("Logo added Successfully...");
                    location.replace('navbar_image_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Something went wrong...");
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
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <h2>Add Navbar Logo</h2>
                <div class="input">
                    <label for="image">Logo</label>
                    <input type="file" id="image" accept="image/*" name="image" autofocus autocomplete="off" required>
                </div>      
                <div class="input" id="field-submit">
                    <button type="submit" name="submit" id="btn">Add Logo</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="navbar_image_details.php">Go Back</a></button>
                </div>
            </form>
    </section>
</body>
</html>