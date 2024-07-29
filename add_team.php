<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }
    
    include 'connect.php';
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $team_img = $_FILES['team_img']['name'];
        $team_tmp_name = $_FILES['team_img']['tmp_name'];
        $team_folder = 'team_img/'.$team_img;

        $checkquery = "SELECT * FROM `teammngr03` WHERE `Person_Image`='$team_img'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Already Exists, \nPlease Enter another Manager...')
            </script>
       <?php }
        else{
            $insertquery = "INSERT INTO `teammngr03` (`Name`, `Person_Image`, `Date`) VALUES ('$name', '$team_img', current_timestamp())";
            $result  = mysqli_query($con, $insertquery);
            if($result){
                move_uploaded_file($team_tmp_name, $team_folder); ?>
                <script>
                    alert('Manager has been Added Successfully!...');
                    location.replace('team_details.php');
                </script>
           <?php }
            else{ ?>
                <script>
                    alert('Manager Not Added...');
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
    <title>Add Team</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
</head>
<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" onsubmit="return validate()" method="post" enctype="multipart/form-data">
                <h2>Add Team</h2>
                <div class="input">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" onkeyup="check(this.value)" autofocus autocomplete="off" required>
                    <p class="error"></p>
                </div>
                <div class="input">
                    <label for="team_img">Manager</label>
                    <input type="file" id="team_img" accept="image/png, image/jpg, image/jpeg, image/webp" name="team_img" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <button type="submit" name="submit" id="btn">Add</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="team_details.php">Go Back</a></button>
                </div>
            </form>
        </section>

        <script src="add_location.js?v=4"></script>

</body>
</html>