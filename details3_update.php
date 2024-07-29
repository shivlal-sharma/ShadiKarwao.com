<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $id = $_POST['Sr_No'];
        $name = $_POST['name'];
        $location_img = $_FILES['location_img']['name'];
        $location_tmp_name = $_FILES['location_img']['tmp_name'];
        $location_folder = 'details_img/'.$location_img;

        $checkquery = "SELECT * FROM `details3` WHERE `Image`='$location_img' && `Name`='$name'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Already Exists, \nPlease Enter another Details...');
                location.replace('details_details3.php');
            </script>
       <?php }
        else{
            $updatequery = "UPDATE `details3` SET `Image`='$location_img', `Name`='$name', `Date`=current_timestamp() WHERE `Sr_No`=$id";
            $result  = mysqli_query($con, $updatequery);
            if($result){
                move_uploaded_file($location_tmp_name, $location_folder); ?>
                <script>
                    alert('Details has been Updated Successfully...');
                    location.replace('details_details3.php');
                </script>
           <?php }
            else{ ?>
                <script>
                    alert('Details Not Updated...');
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
    <title>Update Details</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
</head>
<body>
    <?php
        $id = $_GET['update'];
        $selectquery = "SELECT * FROM `details3` WHERE `Sr_No`=$id";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>
                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post" enctype="multipart/form-data">
                        <h2>Update Details</h2>
                        <div class="input">
                            <label for="location_img">Image</label>
                            <input type="file" id="location_img" accept="image/png, image/jpg, image/jpeg, image/webp" name="location_img" autofocus autocomplete="off" required>
                            <img src="details_img/<?php echo $row['Image'] ?>" alt="Location Image" height="120">
                        </div>
                        <div class="input">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['Name'] ?>" onkeyup="check(this.value)" autofocus autocomplete="off" required>
                            <p class="error"></p>
                        </div>
                        <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No'] ?>">
                        <div class="input">
                            <button type="submit" name="submit" id="btn">Update</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="details_details3.php">Go Back</a></button>
                        </div>
                    </form>
                </section>
           <?php }
        }
    ?>

        <script src="add_location.js?v=5"></script>

</body>
</html>