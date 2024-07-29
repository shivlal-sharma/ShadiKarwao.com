<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="dash_navbar.css?v=2">
</head>
<body>
    <div id="header">

        <div id="img">
            <img src="images/logo.png" alt="Company Logo">
        </div>
        <ul id="mylink">
            <li class=item><a href="dashboard.php" target="_self">DashBoard</a></li>
            <li class=item><a href="navbar_image_details.php" target="_self">NavbarImage</a></li>
            <li class=item><a href="navbar_details.php" target="_self">Navbar</a></li>
            <li class=item><a href="home_details.php" target="_self">Home</a></li>
            <li class=item><a href="home_link_details.php" target="_self">HomeLink</a></li>
            <li class=item><a href="user_details.php" target="_self">Users</a></li>
            <li class=item><a href="admin_details.php" target="_self">Admins</a></li>
            <li class=item><a href="contact_details.php" target="_self">Contacts</a></li>
            <li class=item><a href="content_details.php" target="_self">Contents</a></li>
            <li class=item><a href="team_details.php" target="_self">Teams</a></li>
            <li class=item><a href="location_details.php" target="_self">Locations</a></li>
            <li class=item><a href="wishlist_details.php" target="_self">Wishlists <i class="fa-sharp fa-solid fa-heart" id="wish"></i></a></li>
            <li class=item><a href="details_details1.php" target="_self">Details1</a></li>
            <li class=item><a href="detailsContent1_details.php" target="_self">ContentDetails1</a></li>
            <li class=item><a href="details_details2.php" target="_self">Details2</a></li>
            <li class=item><a href="detailsContent2_details.php" target="_self">ContentDetails2</a></li>
            <li class=item><a href="details_details3.php" target="_self">Details3</a></li>
            <li class=item><a href="detailsContent3_details.php" target="_self">ContentDetails3</a></li>
            <li class=item><a href="details_details4.php" target="_self">Details4</a></li>
            <li class=item><a href="detailsContent4_details.php" target="_self">ContentDetails4</a></li>
            <li class=item><a href="details_details5.php" target="_self">Details5</a></li>
            <li class=item><a href="detailsContent5_details.php" target="_self">ContentDetails5</a></li>
            <li class=item><a href="details_details6.php" target="_self">Details6</a></li>
            <li class=item><a href="detailsContent6_details.php" target="_self">ContentDetails6</a></li>
            <li class=item><a href="footer_menu_details.php" target="_self">Menu</a></li>
            <li class=item><a href="footer_follow_details.php" target="_self">Follow</a></li>
            <li class=item><a href="footer_contact_details.php" target="_self">MyContact</a></li>
            <li class=item><a href="booking_details.php" target="_self">Booking Details</a></li>
            <?php
                if(isset($_SESSION['FullName'])){
                    echo '<li class=item><a href="admin_logout.php" target="_self">Logout</a></li>';
                }
            ?>
       </ul>
    </div>
    <input type="checkbox" id="openSidebarMenu">
    <label for="openSidebarMenu" id="sidebarIconToggle">
        <div class="spinner top"></div>
        <div class="spinner middle"></div>
        <div class="spinner bottom"></div>
    </label>
    <div id="sidebarMenu">
        <!-- <div id="img">
            <img src="images/logo.png" alt="Company Logo">
        </div> -->
        <ul class="menu">
            <li class=item><a href="dashboard.php" target="_self">DashBoard</a></li>
            <li class=item><a href="navbar_image_details.php" target="_self">NavbarImage</a></li>
            <li class=item><a href="navbar_details.php" target="_self">Navbar</a></li>
            <li class=item><a href="home_details.php" target="_self">Home</a></li>
            <li class=item><a href="home_link_details.php" target="_self">HomeLink</a></li>
            <li class=item><a href="user_details.php" target="_self">Users</a></li>
            <li class=item><a href="admin_details.php" target="_self">Admins</a></li>
            <li class=item><a href="contact_details.php" target="_self">Contacts</a></li>
            <li class=item><a href="content_details.php" target="_self">Contents</a></li>
            <li class=item><a href="team_details.php" target="_self">Teams</a></li>
            <li class=item><a href="location_details.php" target="_self">Locations</a></li>
            <li class=item><a href="wishlist_details.php" target="_self">Wishlists <i class="fa-sharp fa-solid fa-heart" id="wish"></i></a></li>
            <li class=item><a href="details_details1.php" target="_self">Details1</a></li>
            <li class=item><a href="detailsContent1_details.php" target="_self">ContentDetails1</a></li>
            <li class=item><a href="details_details2.php" target="_self">Details2</a></li>
            <li class=item><a href="detailsContent2_details.php" target="_self">ContentDetails2</a></li>
            <li class=item><a href="details_details3.php" target="_self">Details3</a></li>
            <li class=item><a href="detailsContent3_details.php" target="_self">ContentDetails3</a></li>
            <li class=item><a href="details_details4.php" target="_self">Details4</a></li>
            <li class=item><a href="detailsContent4_details.php" target="_self">ContentDetails4</a></li>
            <li class=item><a href="details_details5.php" target="_self">Details5</a></li>
            <li class=item><a href="detailsContent5_details.php" target="_self">ContentDetails5</a></li>
            <li class=item><a href="details_details6.php" target="_self">Details6</a></li>
            <li class=item><a href="detailsContent6_details.php" target="_self">ContentDetails6</a></li>
            <li class=item><a href="footer_menu_details.php" target="_self">Menu</a></li>
            <li class=item><a href="footer_follow_details.php" target="_self">Follow</a></li>
            <li class=item><a href="footer_contact_details.php" target="_self">MyContact</a></li>
            <li class=item><a href="booking_details.php" target="_self">Booking Details</a></li>
            <?php
                if(isset($_SESSION['FullName'])){
                    echo '<li class=item><a href="admin_logout.php" target="_self">Logout</a></li>';
                }
            ?>
       </ul>
    </div>

</body>
</html>