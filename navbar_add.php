<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $link = $_POST['link'];

        $selectquery = "SELECT * FROM `navbar363` WHERE `Name`='$name' && `Link`='$link'";
        $select = mysqli_query($con, $selectquery);
        $num_rows = mysqli_num_rows($select);
        if($num_rows > 0){ ?>
            <script>
                alert('Link Already Exists, \nPlease Enter another Link...');
                location.replace('navbar_details.php');
            </script>
       <?php }
        else{ 
            $insertquery = "INSERT INTO `navbar363` (`Name`, `Link`, `Date`) VALUES ('$name','$link', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){ ?>
                <script>
                    alert("Link has been added Successfully...");
                    location.replace('navbar_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Link not added...");
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
    <title>Add Navbar</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=5">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                <h2>Add Navbar</h2>
                <div class="input">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <label for="link">HyperLink</label>
                    <input type="text" id="link" name="link" autofocus autocomplete="off" required>
                </div>          
                <div class="input">
                    <button type="submit" name="submit" id="btn">Add</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="navbar_details.php">Go Back</a></button>
                </div>
            </form>
    </section>
</body>
</html>