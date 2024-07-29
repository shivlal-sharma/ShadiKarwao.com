<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $desc = $_POST['desc'];
        $content_img = $_FILES['content_img']['name'];
        $content_tmp_name = $_FILES['content_img']['tmp_name'];
        $content_folder = 'content_img/'.$content_img;

        $checkquery = "SELECT * FROM `content33` WHERE `Content_Image`='$content_img'";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows > 0){ ?>
            <script>
                alert('Already Exists, \nPlease Enter another Content Image...')
            </script>
       <?php }
        else{
            $insertquery = "INSERT INTO `content33` (`Description`, `Content_Image`, `Date`) VALUES ('$desc', '$content_img', current_timestamp())";
            $result  = mysqli_query($con, $insertquery);
            if($result){
                move_uploaded_file($content_tmp_name, $content_folder); ?>
                <script>
                    alert('Content has been Added Successfully...');
                    location.replace('content_details.php');
                </script>
           <?php }
            else{ ?>
                <script>
                    alert('Content Not Added...');
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
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
    <!-- <link rel="stylesheet" media="screen and (max-width:1100px)" href="admin_res.css"> -->
</head>
<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                <h2>Content</h2>
                <div class="input">
                    <label for="desc">Description</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" autofocus autocomplete="off" required ></textarea>
                    <!-- <input type="text" name="desc" id="desc" max-length="1000" autofocus autocomplete="off" required> -->
                    <!-- <p class="error"></p> -->
                </div>
                <div class="input">
                    <label for="content_img">Image</label>
                    <input type="file" id="content_img" accept="image/png, image/jpg, image/jpeg, image/webp" name="content_img" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <button type="submit" name="submit" id="btn">Add</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="content_details.php">Go Back</a></button>
                </div>
            </form>
        </section>
</body>
</html>