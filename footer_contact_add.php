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
                alert('Title already exists...');
                location.replace('footer_contact_details.php');
            </script>
       <?php }
        else{ 
            $insertquery = "INSERT INTO `mycontact36` (`Title`, `Info`, `Date`) VALUES ('$title', '$info', current_timestamp())";
            $query = mysqli_query($con, $insertquery);
            if($query){ ?>
                <script>
                    alert("MyContact has added successfully!");
                    location.replace('footer_contact_details.php');
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
    <title>MyContact</title>
    <link rel="stylesheet" href="footer_menu_add.css">
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
            <div class="input" id="field-submit">
                <button type="submit" name="submit" id="btn">Add MyContact</button>
            </div>
            <div class="input">
                <button type="submit" id="btn1"><a href="footer_contact_details.php">Go Back</a></button>
            </div>
        </form>
    </section>
</body>
</html>