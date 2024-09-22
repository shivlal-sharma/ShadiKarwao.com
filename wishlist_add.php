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
        $location_id = $_POST['location_id'];
        $user_id = $_POST['user_id'];

        $checkquery = "SELECT * FROM `wishlist30` WHERE `Location_Id`=$location_id AND `user_id`=$user_id";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Already Exists, \nEnter other Location...');
            </script>
       <?php }
        else{
            $insertquery = "INSERT INTO `wishlist30` (`Location_Id`, `user_id`, `Date`) VALUES ($user_id,$location_id, current_timestamp())";
            $result  = mysqli_query($con, $insertquery);
            if($result){ ?>
                <script>
                    alert('Location has added successfully...');
                    location.replace('wishlist_details.php');
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
    <title>Add Wishlist</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <section id="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"  method="post">
            <h2>Add Wishlist</h2>
            <div class="input">
                <label for="location_id">Location Id</label>
                <input type="number" id="location_id" name="location_id" min="1" autofocus autocomplete="off" required>
            </div>
            <div class="input">
                <label for="user_id">User Id</label>
                <input type="number" id="user_id" name="user_id" min="1" autofocus autocomplete="off" required>
            </div>
            <div class="input" id="field-submit">
                <button type="submit" name="submit" id="btn">Add Wishlist</button>
            </div>
            <div class="input">
                <button type="submit" id="btn1"><a href="wishlist_details.php">Go Back</a></button>
            </div>
        </form>
    </section>
</body>
</html>