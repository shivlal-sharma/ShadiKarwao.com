<?php
    session_start();
    include 'connect.php';
    if(!isset($_SESSION['fullName'])){
        header('location:login.php');
    }

    if(isset($_POST['sendLocation'])){
        $location_id = $_POST['location_id'];

        $checkquery = "SELECT * FROM `wishlist30` WHERE `Location_Id`= $location_id";
        $result = mysqli_query($con, $checkquery);
        $num_rows = mysqli_num_rows($result);
        if($num_rows){ 
            $locationData = mysqli_fetch_assoc($result);
            $_SESSION['location'] = $locationData;
        } 
        else{
            alert('Something went wrong...');
        }
    }

    $success = false;
    $error = false;
    
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $deletequery = "DELETE FROM `wishlist30` WHERE `Location_Id`=$id";
        $result = mysqli_query($con, $deletequery);
        if($result){
            $success = true;
        }
        else{
            $error = true;
         }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="wishlist.css?v=6">
    <link rel="stylesheet" media="screen and (max-width:1100px)" href="wishlist_res.css?v=2">
</head>
<body>
    <?php
        include "navbar.php";
    ?>
    <div id="container">
        <?php
            if($success == true){ ?>
                <span id="success">Location has been removed Successfully! <b onclick="remove(this)">&times;</b></span>
           <?php }

            if($error == true){ ?>
                <span id="error">Location has not been removed...<b onclick="remove(this)">&times;</b></span>
           <?php }
        ?>
        <div id="Box">

        <?php
            include 'connect.php';
            $selectquery = "SELECT * FROM `wishlist30`";
            $result = mysqli_query($con, $selectquery);
            $num_rows = mysqli_num_rows($result);
            if($num_rows > 0){
                while($row = mysqli_fetch_assoc($result)){ ?>
                <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">                
                    <div id="box">
                        <img src="location_img/<?php echo $row['Location_Image']; ?>" alt="Wishlist Image">
                        <div class="name"><?php echo $row['Location_Name']; ?></div>
                        <div class="name">Capacity - <?php echo number_format($row['Capacity']); ?> People</div>
                        <div class="name">Rs.<?php echo number_format($row['Price']); ?>/-</div>
                        <input type="hidden" name="location_id" value="<?php echo $row['Location_Id'] ?>">
                        <div id="detail"><a href="details<?php echo $row['Location_Id']; ?>.php"><?php echo $row['Details']; ?></a></div>
                        <button id="book" name="sendLocation">Book Now</button>
                        <a href="wishlist.php?delete=<?php echo $row['Location_Id']; ?>"><i class='fa-sharp fa-solid fa-heart' id="wish"></i></a>
                    </div>
                </form>
            <?php }
            }
            else{ ?>
                <div id="location">
                    <h2>There is no location in the Wishlist</h2>
                </div>
           <?php }  ?>
        </div>
    </div>

    <script>
        function remove(event){
            let parent = event.parentElement;
            parent.remove();
        }
    </script>
</body>
</html>