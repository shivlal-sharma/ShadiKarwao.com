<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $capacity = $_POST['capacity'];
        $price = $_POST['price'];
        $details = $_POST['details'];
        $wishlist_img = $_FILES['wishlist_img']['name'];
        $wishlist_tmp_name = $_FILES['wishlist_img']['tmp_name'];
        $wishlist_folder = 'location_img/'.$wishlist_img;

        $checkquery = "SELECT * FROM `wishlist30` WHERE `Wishlist_Image`='$wishlist_img'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Already Exists, \nPlease Enter another Location...')
            </script>
       <?php }
        else{
            $insertquery = "INSERT INTO `wishlist30` (`Sr_No`, `Name`, `Capacity`, `Price`, `Wishlist_Image`, `Details`, `Date`) VALUES ($id, '$name', '$capacity', '$price', '$wishlist_img', '$details', current_timestamp())";
            $result  = mysqli_query($con, $insertquery);
            if($result){
                move_uploaded_file($wishlist_tmp_name, $wishlist_folder); ?>
                <script>
                    alert('Location has been Added Successfully...');
                    location.replace('wishlist_details.php');
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
    <title>Add Wishlists</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
</head>
<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post" enctype="multipart/form-data">
                <h2>Add Location</h2>
                <div class="input">
                    <label for="id">Id</label>
                    <input type="number" id="id" name="id" autofocus autocomplete="off" required>
                </div>
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
                    <label for="wishlist_img">Image</label>
                    <input type="file" id="wishlist_img" accept="image/png, image/jpg, image/jpeg, image/webp" name="wishlist_img" autofocus autocomplete="off" required>
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
                    <button type="submit" id="btn1"><a href="wishlist_details.php">Go Back</a></button>
                </div>
            </form>
        </section>

        <script src="add_location.js?v=0"></script>

</body>
</html>