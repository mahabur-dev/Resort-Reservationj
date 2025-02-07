<?php
    session_start();
    $css_link = 'assets/css/seeprice.css';
    require 'inc/config.php';
    require 'inc/header.php';
    $room_id = 0;
    if (isset($_GET['id'])) {

     $room_id = $_GET['id'];
     $sql = "SELECT * FROM add_rooms WHERE id = $room_id ";
     $result = mysqli_query($conn , $sql);
     $room = mysqli_fetch_assoc($result);
   }
?>
   <script>
    // Hide login and register options if user is logged in
        document.addEventListener("DOMContentLoaded", function() {
            console.log("DOM fully loaded and parsed");
            const loginLink = document.querySelector('.login');
            const registerLink = document.querySelector('.register');
            const profileShow = document.querySelector('.showprofile');
            const logout = document.querySelector('.logout');

            if (<?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>) {
                loginLink.style.display = 'none';
                registerLink.style.display = 'none';
                profileShow.style.display = 'inline';
                logout.style.display = 'inline';
            }
        });
    </script>

<div class="seeprice">
 <div class="price">
       <div class="style">
            <img class="img"  src="admin/images/<?php echo $room['image'];?>" alt="">
       </div>
       <div class="description">
            <ul>
               <li><?php echo $room['room_name'];?></li>
               <li><?php echo $room['room_type'];?></li>
               <li><?php echo $room['capacity'];?></li>
               <li><?php echo $room['description'];?></li>
               <li>Free Cancellation, before 5 days ago</li>  
               <li><a href="#">See Room Facility</a> </li>
            </ul>
           
       </div>
       <div class="price1">
          <ul>
               <li>Speacial Discount 5%</li>
               <li><?php echo $room['price']?></li>
               <li><?php echo $room['status'];?></li>
               <li>Tax Included</li>
               <li>1 night, 2 adults</li>
          </ul>
                <a href="bookingfrom.php? id=<?php echo $room_id ;?>">
                <button class="btnp">Booked Now</button>
         </a>

       </div>

    </div>
</div>
<?php 
    require 'inc/fotter.php';
?>
   <script src="assets/js/chatt-bay.js"></script>
</body>
</html>