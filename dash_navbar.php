<?php 
    include 'connect.php';
    $icon = "";
    $selectquery = "SELECT * FROM `navbar4`";
    $query = mysqli_query($con, $selectquery);
    if($query){
        $fav_icon = mysqli_fetch_assoc($query); 
        $icon =  $fav_icon['Image'];
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Navbar</title>
    <link rel="icon" type="image/png" href="images/<?php echo $icon; ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="dash_navbar.css">
</head>
<body>
    <div id="header">
        <div class="navbar-left">
            <span id="hamburger"><i class="fa-sharp fa-solid fa-bars"></i></span>
            <a href="about_us.php" class="about-us"><img src="images/logo.png" alt="Company Logo"></a>
        </div>
        <ul class="navbar-right">
            <li class="navbar-link dashboard"><a href="dashboard.php" target="_self">DashBoard</a></li>
            <li class="navbar-link locations"><a href="location_details.php" target="_self">Locations</a></li>
            <li class="navbar-link wishlists"><a href="wishlist_details.php" target="_self">Wishlists <i class="fa-sharp fa-solid fa-heart" id="wish"></i></a></li>
            <li class="navbar-link bookings"><a href="booking_details.php" target="_self">Booking</a></li>
            <li class="navbar-link contacts"><a href="contact_details.php" target="_self">Contacts</a></li>
            <li class="navbar-link users"><a href="user_details.php" target="_self">Users</a></li>
            <li class="navbar-link admins"><a href="admin_details.php" target="_self">Admins</a></li>
            <?php
                if(isset($_SESSION['FullName'])){
                    echo '<li class="navbar-link"><a href="admin_logout.php" target="_self">Logout</a></li>';
                }else{
                    echo '<li class="navbar-link"><a href="login_admin.php" target="_self">Login</a></li>';   
                }
            ?>
       </ul>
    </div>

    <div class="modal">
        <div id="sidebarMenu">
            <span class="cancel">&times;</span>
            <ul class="menu">
                <li class="sidebar-link"><a href="dashboard.php" target="_self">DashBoard</a></li>
                <li class="sidebar-link"><a href="location_details.php" target="_self">Locations</a></li>
                <li class="sidebar-link"><a href="wishlist_details.php" target="_self">Wishlists <i class="fa-sharp fa-solid fa-heart" id="wish"></i></a></li>
                <li class="sidebar-link"><a href="booking_details.php" target="_self">Booking</a></li>
                <li class="sidebar-link"><a href="contact_details.php" target="_self">Contacts</a></li>
                <li class="sidebar-link"><a href="user_details.php" target="_self">Users</a></li>
                <li class="sidebar-link"><a href="admin_details.php" target="_self">Admins</a></li>
                <li class="sidebar-link"><a href="navbar_image_details.php" target="_self">Navbar-Logo</a></li>
                <li class="sidebar-link"><a href="navbar_details.php" target="_self">Navbar</a></li>
                <li class="sidebar-link"><a href="home_details.php" target="_self">Home</a></li>
                <li class="sidebar-link"><a href="home_link_details.php" target="_self">Home-Links</a></li>
                <li class="sidebar-link"><a href="content_details.php" target="_self">Contents</a></li>
                <li class="sidebar-link"><a href="team_details.php" target="_self">Our-Teams</a></li>
                <li class="sidebar-link"><a href="details_details1.php" target="_self">Details1</a></li>
                <li class="sidebar-link"><a href="detailsContent1_details.php" target="_self">Content-Details1</a></li>
                <li class="sidebar-link"><a href="details_details2.php" target="_self">Details2</a></li>
                <li class="sidebar-link"><a href="detailsContent2_details.php" target="_self">Content-Details2</a></li>
                <li class="sidebar-link"><a href="details_details3.php" target="_self">Details3</a></li>
                <li class="sidebar-link"><a href="detailsContent3_details.php" target="_self">Content-Details3</a></li>
                <li class="sidebar-link"><a href="details_details4.php" target="_self">Details4</a></li>
                <li class="sidebar-link"><a href="detailsContent4_details.php" target="_self">Content-Details4</a></li>
                <li class="sidebar-link"><a href="details_details5.php" target="_self">Details5</a></li>
                <li class="sidebar-link"><a href="detailsContent5_details.php" target="_self">Content-Details5</a></li>
                <li class="sidebar-link"><a href="details_details6.php" target="_self">Details6</a></li>
                <li class="sidebar-link"><a href="detailsContent6_details.php" target="_self">Content-Details6</a></li>
                <li class="sidebar-link"><a href="footer_menu_details.php" target="_self">Menu</a></li>
                <li class="sidebar-link"><a href="footer_follow_details.php" target="_self">Follow</a></li>
                <li class="sidebar-link"><a href="footer_contact_details.php" target="_self">MyContact</a></li>
                <?php
                    if(isset($_SESSION['FullName'])){
                        echo '<li class="sidebar-link"><a href="admin_logout.php" target="_self">Logout</a></li>';
                    }
                    else{
                        echo '<li class="sidebar-link"><a href="login_admin.php" target="_self">Login</a></li>';
                    }
                ?>
            </ul>
        </div>
    </div>

    <script src="dash_navbar.js"></script>
</body>
</html>