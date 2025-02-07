<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <!-- link font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- link css -->
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="<?php echo $css_link;?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
   <header class="header">
        <div class="head-nav">
            <div>
               <a href="#">MR Resorts</a>
            </div>
            
            <div class="nav_bar">
                <a href="index.php">Home</a>
                <a href="#">About</a>
                <a href="#">Contact Us</a>
                <div class="dropdown">
                    <a href="#" class="dropbtn">Service</a>
                    <div class="dropdown-content">
                        <a href="#">Hotels</a>
                        <a href="#">Flights</a>
                        <a href="#">Transport</a>
                        <a href="#">Apartment Booking</a> 
                    </div>
                </div>
            </div>
            <div class="log">
                <a class="login" href="admin/login.php">Login</a>
                <a class="register" href="admin/register.php">Register</a>
                <div class="dropdown">
                    <!-- <img class="showprofile" src="../assets/img/login-img/avatar.jpg"> -->
                    <a href="#"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ' '; ?></a>
                    <div class="dropdown-content">
                        <a href="user_profile.php">Profile</a>
                        <a href="#">Setting and privacy</a>
                        <a class="logout" href="admin/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="head-search">
            <div class="search-container">
                <input type="text" placeholder="Destination name..." class="input-field" id="name">
                <input type="date" class="input-field" id="checkin" placeholder="Check-in">
                <input type="date" class="input-field" id="checkout" placeholder="Check-out">
                <input type="number" placeholder="Adults" class="input-field" id="adults" min="1" value="1">
                <button class="search-btnn">Search</button>
            </div>
        </div>
   </header>

   <script>
    // Hide login and register options if user is logged in
    document.addEventListener("DOMContentLoaded", function() {
        // console.log("DOM fully loaded and parsed");
        const loginLink = document.querySelector('.login');
        const registerLink = document.querySelector('.register');
        const profileShow = document.querySelector('.showprofile');
        const logout = document.querySelector('.logout');

        // console.log(loginLink, registerLink, profileShow, logout);

        if (<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>) {
            if (loginLink) loginLink.style.display = 'none';
            if (registerLink) registerLink.style.display = 'none';
            if (profileShow) profileShow.style.display = 'inline';
            if (logout) logout.style.display = 'inline';
        }
    });
   </script>
</body>
</html>