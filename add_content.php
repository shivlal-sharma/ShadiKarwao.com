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
        $desc = $_POST['desc'];
        $content_img = $_FILES['content_img']['name'];
        $content_tmp_name = $_FILES['content_img']['tmp_name'];
        $content_folder = "content_img/$content_img";

        $checkquery = "SELECT * FROM `content33` WHERE `Content_Image`='$content_img'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Content and Image already exists...')
            </script>
       <?php }
        else{
            $insertquery = "INSERT INTO `content33` (`Description`, `Content_Image`, `Date`) VALUES ('$desc', '$content_img', current_timestamp())";
            $result  = mysqli_query($con, $insertquery);
            if($result){
                move_uploaded_file($content_tmp_name, $content_folder); ?>
                <script>
                    alert('Content and Image has added successfully!');
                    location.replace('content_details.php');
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
    <title>Add Content</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <h2>Content</h2>
                <div class="input">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" autofocus autocomplete="off" required ></textarea>
                </div>
                <div class="input">
                    <label for="content_img">Image</label>
                    <input type="file" id="content_img" accept="image/*" name="content_img" autofocus autocomplete="off" required>
                </div>
                <div class="input" id="field-submit">
                    <button type="submit" name="submit" id="btn">Add</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="content_details.php">Go Back</a></button>
                </div>
            </form>
        </section>
</body>
</html>