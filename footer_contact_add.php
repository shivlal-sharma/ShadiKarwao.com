<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $info = $_POST['info'];

        $selectquery = "SELECT * FROM `mycontact36` WHERE `Title`='$title'";
        $select = mysqli_query($con, $selectquery);
        $num_rows = mysqli_num_rows($select);
        if($num_rows > 0){ ?>
            <script>
                alert('Title Already Exists, \nPlease Enter another Title...');
                location.replace('footer_contact_details.php');
            </script>
       <?php }
        else{ 
            $insertquery = "INSERT INTO `mycontact36` (`Title`, `Info`, `Date`) VALUES ('$title', '$info', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){ ?>
                <script>
                    alert("MyContact has been added Successfully...");
                    location.replace('footer_contact_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("MyContact not added...");
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
    <title>MyContact</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=0">
    <!-- <link rel="stylesheet" media="screen and (max-width: 1100px)" href="admin_res.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <section id="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                <h2>Add MyContact</h2>
                <div class="input">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" autofocus autocomplete="off" required>
                </div>
                <div class="input">
                    <label for="info">Info</label>
                    <input type="text" id="info" name="info" autofocus autocomplete="off" required>
                </div>                       
                <div class="input">
                    <button type="submit" name="submit" id="btn">Add</button>
                </div>
                <div class="input">
                    <button type="submit" id="btn1"><a href="footer_contact_details.php">Go Back</a></button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>