<?php
    session_start();
    if(!isset($_SESSION['FullName'])){
        header('location:login_admin.php');
    }

    include 'connect.php';
    if(isset($_POST['submit'])){
        $id = $_POST['Sr_No'];
        $title = $_POST['title'];
        $info = $_POST['info'];

        $selectquery = "SELECT * FROM `mycontact36` WHERE `Title`='$title' AND `Info`='$info'";
        $select = mysqli_query($con, $selectquery);
        $num_rows = mysqli_num_rows($select);
        if($num_rows > 0){ ?>
            <script>
                alert('Title already exists...');
                location.replace('footer_contact_details.php');
            </script>
       <?php }
        else{ 
            $updatequery = "UPDATE `mycontact36` SET `Title`='$title', `Info`='$info', `Date`=current_timestamp() WHERE `Sr_No`=$id";
            $query = mysqli_query($con, $updatequery);
            if($query){ ?>
                <script>
                    alert("MyContact has updated successfully...");
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
    <title>Update MyContact</title>
    <link rel="stylesheet" href="footer_menu_add.css">
</head>
<body>
    <?php
        $id =$_GET['update'];
        $selectquery = "SELECT * FROM `mycontact36` WHERE `Sr_No`=$id";
        $query = mysqli_query($con, $selectquery);
        if($query){
            while($row = mysqli_fetch_assoc($query)){ ?>
                <section id="container">
                    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                        <h2>Update MyContact</h2>
                        <div class="input">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" value="<?php echo $row['Title']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <div class="input">
                            <label for="info">Info</label>
                            <input type="text" id="info" name="info" value="<?php echo $row['Info']; ?>" autofocus autocomplete="off" required>
                        </div>
                        <input type="hidden" name="Sr_No" value="<?php echo $row['Sr_No']; ?>">                       
                        <div class="input" id="field-submit">
                            <button type="submit" name="submit" id="btn">Update MyContact</button>
                        </div>
                        <div class="input">
                            <button type="submit" id="btn1"><a href="footer_contact_details.php">Go Back</a></button>
                        </div>
                    </form>
                </section>
           <?php }
        } ?>
</body>
</html>