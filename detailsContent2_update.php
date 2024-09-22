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
        $content1 = $_POST['content1'];
        $content2 = $_POST['content2'];
        $name = $_POST['name'];
        $link = $_POST['link'];

        $checkquery = "SELECT * FROM `detailsContent2` WHERE `Content1`='$content1' AND `Content2`='$content2' AND `Name`='$name' AND `Link`='$link'";
        $query = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($query);
        if($num_rows > 0){ ?>
            <script>
                alert('Content already exists...');
                location.replace('detailsContent2_details.php');
            </script>
       <?php }
       else{          
            $updatequery = "UPDATE `detailsContent2` SET `Content1`='$content1', `Content2`='$content2', `Name`='$name', `Link`='$link', `Date`=current_timestamp() WHERE `Sr_No`=$id";
            $query = mysqli_query($con, $updatequery);
            if($query){ ?>
                <script>
                    alert("Content has updated successfully!");
                    location.replace('detailsContent2_details.php');
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
    <title>Update Details Content</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <?php
         $id =$_GET['update'];
         $selectquery = "SELECT * FROM `detailsContent2` WHERE `Sr_No`=$id";
         $query = mysqli_query($con, $selectquery);
         if($query){
             while($row = mysqli_fetch_assoc($query)){ ?>
                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                        <h2>Update Details Content</h2>
                        <div class="input">
                            <label for="content1">Content1</label>
                            <input type="text" id="content1" name="content1" value="<?php echo $row['Content1']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="content2">Content2</label>
                            <input type="text" id="content2" name="content2" value="<?php echo $row['Content2']; ?>" autofocus autocomplete="off">
                        </div>
                        <div class="input">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['Name']; ?>" autofocus autocomplete="off" required>
                        </div>         
                        <div class="input">
                            <label for="link">Link</label>
                            <input type="text" id="link" name="link" value="<?php echo $row['Link']; ?>" autofocus autocomplete="off" required>
                        </div>      
                        <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No']; ?>">   
                        <div class="input" id="field-submit">
                            <button type="submit" name="submit" id="btn">Update Details Content</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="detailsContent2_details.php">Go Back</a></button>
                        </div>         
                    </form>
                </section>
            <?php }
        } ?>
</body>
</html>
