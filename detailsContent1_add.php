<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }
    
    include 'connect.php';
    if(isset($_POST['submit'])){
        $content1 = $_POST['content1'];
        $content2 = $_POST['content2'];
        $name = $_POST['name'];
        $link = $_POST['link'];

        $checkquery = "SELECT * FROM `detailsContent1` WHERE `Content1`='$content1' AND `Content2`='$content2' AND `Name`='$name' AND `Link`='$link'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){ ?>
            <script>
                alert('Content Already Exists, \nPlease Enter another content...');
            </script>
       <?php }
       else{          
            $insertquery = "INSERT INTO `detailsContent1` (`Content1`, `Content2`, `Name`, `Link`, `Date`) VALUES ('$content1', '$content2', '$name', '$link', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){ ?>
                <script>
                    alert("Content has been added successfully...");
                    location.replace('detailsContent1_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Content not added...");
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
    <title>Details Content</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
</head>

<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                <h2>Add Details Content</h2>
                <div class="input">
                    <label for="content1">Content1</label>
                    <input type="text" id="content1" name="content1" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <label for="content2">Content2</label>
                    <input type="text" id="content2" name="content2" autofocus autocomplete="off">
                </div>
                <div class="input">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" autofocus autocomplete="off" required>
                </div>         
                <div class="input">
                    <label for="link">Link</label>
                    <input type="text" id="link" name="link" autofocus autocomplete="off" required>
                </div>         
                <div class="input">
                    <button type="submit" name="submit" id="btn">Add</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="detailsContent1_details.php">Go Back</a></button>
                </div>         
            </form>
        </div>
    </section>
</body>
</html>