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
        $divider = $_POST['divider'];

        $checkquery = "SELECT * FROM `homelink36` WHERE `Name`='$name' AND `Link`='$link' AND `Divider`='$divider'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){ ?>
            <script>
                alert('Link already exists...');
                location.replace('home_link_details.php');
            </script>
       <?php }
       else{          
            $insertquery = "UPDATE `homelink36` SET `Name`='$name', `Link`='$link', `Divider`='$divider', `Date`=current_timestamp() WHERE `Sr_No`=$id";
            $query = mysqli_query($con, $insertquery);
            if($query){ ?>
                <script>
                    alert("Link has updated successfully...");
                    location.replace('home_link_details.php');
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
        $id = $_GET['update'];
        $selectquery = "SELECT * FROM `homelink36` WHERE `Sr_No`=$id";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>
                <section id="container">
                        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                            <h2>Update Link</h2>
                            <div class="input">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" value="<?php echo $row['Name']; ?>" autofocus autocomplete="off" required>
                            </div>         
                            <div class="input">
                                <label for="link">Link</label>
                                <input type="text" id="link" name="link" value="<?php echo $row['Link']; ?>" autofocus autocomplete="off" required>
                            </div>         
                            <div class="input">
                                <label for="divider">Separator</label>
                                <input type="text" id="divider" name="divider" value="<?php echo $row['Divider']; ?>" autofocus autocomplete="off">
                            </div>
                            <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No']; ?>">
                            <div class="input" id="field-submit">
                                <button type="submit" name="submit" id="btn">Update Link</button>
                            </div>
                            <div class="input">
                                <button type="submit" id="btn1"><a href="home_link_details.php">Go Back</a></button>
                            </div>
                        </form>
                </section>
           <?php }
        }
    ?>
</body>
</html>