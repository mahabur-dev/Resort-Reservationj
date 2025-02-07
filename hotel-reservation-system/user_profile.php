<?php
    session_start();
    $css_link = "admin/css/user-profile.css";
    require 'inc/header.php';
    require 'inc/config.php';
    $user_id = -1;
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
    }
    else{
        header("location : login.php");
    }
?>
    <div class="profile-main">
        <div class="aside">
            <div class="aside1">
                <div class="asid">
                    <a href="#">My booking</a>
                </div>
                <div class="asid">
                    <a href="#">Profile</a>
                </div>  
                <div class="asid">
                    <a href="#">Cashback Rewards</a>
                </div>  
                <div class="asid">
                    <a href="#">Reviews</a>   
                </div>  
                <div class="asid">
                    <a href="#">PointMax</a>   
                </div>  
                <div class="asid">
                    <a href="#">Payment Method</a>   
                </div>  
            </div>
        </div>
        <div class="main-part">
            <div class="main-container">
                <div class="user">
                    <h2>User Details</h2>
                </div>
                <?php
                    $res = mysqli_query($conn , "SELECT id , password , username , email FROM users WHERE id = $user_id") 
                    or die(mysqli_error($conn));
                    while($information=mysqli_fetch_assoc($res)): ?>
                <div class="row name">
                    <div class="col-75">
                        <h4>Name</h4> 
                        <p><?php echo $information['username'];?>
                    </div>
                    <div class="col-25">
                        <a href="#"> Edit</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-75">
                        <h4>Email</h4> 
                        <p><?php echo $information['email'];?></p>
                    </div>
                    <div class="col-25">
                        <a href="#">Edit</a>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-75">
                        <h4>Phone Number</h4> 
                    </div>
                    <div class="col-25">
                        <a href="#">Add</a>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-75">
                        <h4>Password</h4> 
                        <input type="password" name="password" id="password" value="<?php echo $information['password']?>">
                    </div>
                    <div class="col-25">
                        <a href="#">Edit</a>
                    </div>
                </div> 
                <?php endwhile;?> 
            </div>
        </div>
    </div>
    </body>
</html>