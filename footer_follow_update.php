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
        $link = $_POST['link'];
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = "social_media_img/$image";

        $selectquery = "SELECT * FROM `follow2` WHERE `Name`='$name' AND `Link`='$link' AND `Image`='$image'";
        $select = mysqli_query($con, $selectquery);
        $num_rows = mysqli_num_rows($select);
        if($num_rows > 0){ ?>
            <script>
                alert('Footer Link already exists...');
                location.replace('footer_follow_details.php');
            </script>
       <?php }
        else{ 
            $insertquery = "UPDATE `follow2` SET `Name`='$name', `Link`='$link', `Image`='$image', `Date`=current_timestamp() WHERE `Sr_No`=$id";
            $query = mysqli_query($con, $insertquery);
            if($query){
                move_uploaded_file($image_tmp_name, $image_folder); ?>
                <script>
                    alert("Footer Link has updated successfully!");
                    location.replace('footer_follow_details.php');
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
    <title>Update Link</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <?php
        include 'connect.php';
        $id = $_GET['update'];
        $sql = "SELECT * FROM `follow2` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $sql);
        if($result){
            while($row = mysqli_fetch_assoc($result)){ ?>
                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                        <h2>Update Follow</h2>
                        <div class="input">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['Name']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="link">Link</label>
                            <input type="text" id="link" name="link" value="<?php echo $row['Link']; ?>" autofocus autocomplete="off" required>
                        </div>                
                        <div class="input">
                            <label for="image">Image</label>
                            <input type="file" id="image" name="image" accept="image/*" value="<?php echo $row['Image']; ?>" autofocus autocomplete="off" required>
                            <img src="social_media_img/<?php echo $row['Image']; ?>" alt="Social Media App" height="50">
                        </div> 
                        <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No']; ?>">               
                        <div class="input" id="field-submit">
                            <button type="submit" name="submit" id="btn">Update Follow</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="footer_follow_details.php">Go Back</a></button>
                        </div>
                    </form>
                </section>
           <?php }
        } ?>
</body>
</html>