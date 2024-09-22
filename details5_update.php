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
        $id = $_POST['Sr_No'];
        $name = $_POST['name'];
        $location_img = $_FILES['location_img']['name'];
        $location_tmp_name = $_FILES['location_img']['tmp_name'];
        $location_folder = "details_img/$location_img";

        $checkquery = "SELECT * FROM `details5` WHERE `Image`='$location_img' AND `Name`='$name'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Details already exists...');
                location.replace('details_details5.php');
            </script>
       <?php }
        else{
            $updatequery = "UPDATE `details5` SET `Image`='$location_img', `Name`='$name', `Date`=current_timestamp() WHERE `Sr_No`=$id";
            $result  = mysqli_query($con, $updatequery);
            if($result){
                move_uploaded_file($location_tmp_name, $location_folder); ?>
                <script>
                    alert('Details has updated Successfully!');
                    location.replace('details_details5.php');
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
    <title>Update Details</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <?php
        $id = $_GET['update'];
        $selectquery = "SELECT * FROM `details5` WHERE `Sr_No`=$id";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>
                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <h2>Update Details</h2>
                        <div class="input">
                            <label for="location_img">Image</label>
                            <input type="file" id="location_img" accept="image/*" name="location_img" autofocus autocomplete="off" required>
                            <img src="details_img/<?php echo $row['Image'] ?>" alt="Location Image" height="120">
                        </div>
                        <div class="input">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['Name'] ?>" autofocus autocomplete="off" required>
                        </div>
                        <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No'] ?>">
                        <div class="input" id="field-submit">
                            <button type="submit" name="submit" id="btn">Update Details</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="details_details5.php">Go Back</a></button>
                        </div>
                    </form>
                </section>
           <?php }
        }
    ?>
</body>
</html>