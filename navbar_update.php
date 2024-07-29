<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    // $id = $_GET['update'];

    include 'connect.php';
    if(isset($_POST['submit'])){
        $id = $_POST['Sr_No'];
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
            $updatequery = "UPDATE `navbar363` SET `Name`='$name', `Link`='$link', `Date`=current_timestamp() WHERE `Sr_No`=$id";
            $query = mysqli_query($con, $updatequery);
            if($query){ ?>
                <script>
                    alert("Link has been updated Successfully...");
                    location.replace('navbar_details.php');
                </script>
            <?php }
            else{ ?>
                <script>
                    alert("Link not updated...");
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
    <title>Update Navbar</title>
    <link rel="stylesheet" href="footer_menu_add.css?v=5">
    <!-- <link rel="stylesheet" media="screen and (max-width: 1100px)" href="admin_res.css"> -->
</head>

<body>
    <?php
        $id = $_GET['update'];
        $selectquery = "SELECT * FROM `navbar363` WHERE `Sr_No`=$id";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>

                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                        <h2>Update Navbar</h2>
                        <div class="input">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['Name']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="link">HyperLink</label>
                            <input type="text" id="link" name="link" value="<?php echo $row['Link']; ?>" autofocus autocomplete="off" required>
                        </div>           
                        <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No']; ?>">
                        <div class="input">
                            <button type="submit" name="submit" id="btn">Update</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="navbar_details.php">Go Back</a></button>
                        </div>
                    </form>
                </section>

           <?php }
        }
    ?>
</body>
</html>