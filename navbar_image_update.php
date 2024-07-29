<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    // $id = $_GET['update'];

    include 'connect.php';
    if(isset($_POST['submit'])){
        $id = $_POST['Sr_No'];
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
            $updatequery = "UPDATE `navbar4` SET `Image`='$image', `Date`=current_timestamp() WHERE `Sr_No`=$id";
            $query = mysqli_query($con, $updatequery);
            if($query){
                move_uploaded_file($image_tmp_name, $image_folder); ?>
                <script>
                    alert("Image has been updated Successfully...");
                    location.replace('navbar_image_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Image not updated...");
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
    <title>Update Navbar</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=5">
</head>

<body>
    <?php
        $id = $_GET['update'];
        $selectquery = "SELECT * FROM `navbar363` WHERE `Sr_No`=$id";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>

                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <h2>Update Navbar</h2>
                        <div class="input">
                            <label for="image">Image</label>
                            <input type="file" id="image" accept="image/png, image/jpg, image/jpeg, image/webp" name="image" autofocus autocomplete="off" required>
                        </div>      
                        <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No']; ?>">
                        <div class="input">
                            <button type="submit" name="submit" id="btn">Update</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="navbar_image_details.php">Go Back</a></button>
                        </div>
                    </form>
                </section>

           <?php }
        }
    ?>
</body>
</html>