<?php
    session_start();

    
    require '../inc/config.php';
    $username = $email = $nameError = $emailError = $passwordError = $successful_msg = $Error = "" ;
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {

        $username = $conn -> real_escape_string($_POST["username"]);
        $email =  $conn -> real_escape_string($_POST["email"]);
        $password = $conn -> real_escape_string($_POST["password"]);
        $confirmPassword = $conn -> real_escape_string($_POST["confirmPassword"]);
        // $role =  $conn -> real_escape_string($_POST["role"]);

        $sql = "SELECT email FROM users WHERE email='$email'";
        $result = $conn -> query($sql);

        if(!preg_match("/^[A-Za-z0-9]+$/", $username)) 
            $nameError = "Name must contain at least one alphabet or number.";
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
            }
        elseif(!preg_match("/^[A-Za-z0-9]+$/", $password))
            $passwordError = "Password must contain at least one alphabet or number.";
        elseif(strlen($password)<8) 
            $passwordError = "Password length at least 8 character" ;
        elseif($password != $confirmPassword)
            $passwordError = "Passwords do not match";
        elseif($result -> num_rows > 0)
            $Error = "An account with this email address already exists.";
        else {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_hash')";
            if($conn -> query($sql) == TRUE) {
                $username = $email ="";
               
                header("location: login.php");
            }
            else
                echo "Error: " . $conn -> error;            
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/login-logout.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <form action="register.php" method="post">
        <div class="login-form">
            <div class="login">
                <h1>Resort Registration</h1>
                <div class="email">
                    <input type="text" name="username"  value="<?php echo $username?>" id="username" required placeholder="username">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="email">
                    <input type="email" name="email" id="email" value="<?php echo $email?>" required placeholder="example@gmail.com">
                    <i class='bx bxs-envelope' ></i>
                </div>
                <div class="password">
                    <input type="password" name="password" id="password" required placeholder="Type password">
                    <i class='bx bx-lock-open'></i>
                </div>
                <div class="password">
                    <input type="password" name="confirmPassword" id="cpassword" required placeholder="Type confirm password">
                    <i class='bx bx-lock-open'></i>
                 </div>
                 <br>
                 <!-- <div class="password">
                    <input type="role" name="role" id="role" required placeholder="Type your role">
                    <i class='bx bx-lock-open'></i>
                 </div> -->
                <span style="color:#f96d00"><?php echo $Error?></span>
                <br>
                <div class="btnn">
                    <button class="btn" type="submit" name="submit">Register</button>
                 </div>
            </div>
        </div>
    </form>
</body>
</html>