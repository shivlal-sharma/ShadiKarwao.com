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
        $desc = $_POST['desc'];
        $content_img = $_FILES['content_img']['name'];
        $content_tmp_name = $_FILES['content_img']['tmp_name'];
        $content_folder = "content_img/$content_img";

        $checkquery = "SELECT * FROM `content33` WHERE `Content_Image`='$content_img' AND `Description`='$desc'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Content and Image already exists...');
                location.replace('content_details.php');
            </script>
       <?php }
        else{
            $updatequery = "UPDATE `content33` SET `Description`='$desc', `Content_Image`='$content_img', `Date`=current_timestamp() WHERE `Sr_No`=$id";
            $result  = mysqli_query($con, $updatequery);
            if($result){
                move_uploaded_file($content_tmp_name, $content_folder); ?>
                <script>
                    alert('Content and Image has updated successfully!');
                    location.replace('content_details.php');
                </script>
           <?php }
            else{ ?>
                <script>
                    alert('Something went wrong...');
                    location.replace('content_details.php');
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
    <title>Update Content</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <?php
        $id = $_GET['update'];
        $selectquery = "SELECT * FROM `content33` WHERE `Sr_No`=$id";
        $result = mysqli_query($con, $selectquery);
        while($row = mysqli_fetch_assoc($result)){
    ?>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <h2>Content</h2>
                <div class="input">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" autofocus autocomplete="off" required><?php echo $row['Description']; ?></textarea>
                </div>
                <div class="input">
                    <label for="content_img">Image</label>
                    <input type="file" id="content_img" accept="image/*" name="content_img" autofocus autocomplete="off" required>
                    <img src="content_img/<?php echo $row['Content_Image']; ?>" alt="Content Image" height="120" width="120">
                </div>
                <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No']; ?>">
                <div class="input" id="field-submit">
                    <button type="submit" name="submit" id="btn">Update Content</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="content_details.php">Go Back</a></button>
                </div>
            </form>
        </section>
    <?php } ?>
</body>
</html>