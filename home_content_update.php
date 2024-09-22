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
        $ask = $_POST['ask'];
        $content = $_POST['content'];
        $heading = $_POST['heading'];

        $checkquery = "SELECT * FROM `home6` WHERE `Heading`='$heading' AND `Content`='$content' AND `Ask`='$ask'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){ ?>
            <script>
                alert('Content already exists...');
                location.replace('home_details.php');
            </script>
       <?php }
       else{          
            $updatequery = "UPDATE `home6` SET `Heading`='$heading', `Content` = '$content', `Ask`='$ask', `Date`=current_timestamp() WHERE `Sr_No` = $id";
            $query = mysqli_query($con, $updatequery);
            if($query){ ?>
                <script>
                    alert("Content has updated successfully!");
                    location.replace('home_details.php');
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
    <title>Update Content</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <?php
        $id = $_GET['update'];
        $selectquery = "SELECT * FROM `home6` WHERE `Sr_No`=$id";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>
                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                        <h2>Update Content</h2>
                        <div class="input">
                            <label for="heading">Heading</label>
                            <input type="text" id="heading" name="heading" value="<?php echo $row['Heading']; ?>" autofocus autocomplete="off">
                        </div>
                        <div class="input">
                            <label for="content">Content</label>
                            <input type="text" id="content" name="content" value="<?php echo $row['Content']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="ask">Ask</label>
                            <input type="text" id="ask" name="ask" value="<?php echo $row['Ask']; ?>" autofocus autocomplete="off">
                        </div>         
                        <input type="hidden" name='Sr_No' value="<?php echo $row['Sr_No']; ?>">                
                        <div class="input" id="field-submit">
                            <button type="submit" name="submit" id="btn">Submit</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="home_details.php">Go Back</a></button>
                        </div>
                    </form>
                </section>
           <?php }
        }
    ?>
</body>
</html>