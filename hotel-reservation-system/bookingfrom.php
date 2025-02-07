<?php
session_start();
// print_r($_SESSION);
$css_link = "assets/css/bookingfrom.css";
require 'inc/config.php';
require 'inc/header.php';
if(!isset($_SESSION['username'])){
    echo  "<script>alert('Booking Successful!');</script>";
    header("location: admin/login.php");

}
$user_id = $_SESSION['id'];

if (isset($_GET['id'])) {

    $room_id = $_GET['id'];
  }
// Fetch Room Details
$sql = "SELECT * FROM add_rooms WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();
$room = $result->fetch_assoc();

if (!$room) {
    echo  "<script>alert('Booking Successful!');</script>";
    header("Location: admin/login.php");
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session
    $checkin = $_POST['chekin_date'];
    $checkout = $_POST['checkout_date'];
    $guests = $_POST['guests'];
    $phone = $_POST['phone_num'];

    // Check if the room is already booked
    $check_sql = "SELECT status FROM add_rooms WHERE id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $room_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $row = $check_result->fetch_assoc();

    if ($row['status'] === "Booked") {
        echo "<script>alert('Sorry, this room is already booked.'); window.location.href='index.php';</script>";
        exit();
    }

    // Insert Booking Data
    $insert_sql = "INSERT INTO bookings (user_id, room_id, checkin_date, checkout_date, guests, phone, status)
                   VALUES (?, ?, ?, ?, ?, ?, 'Confirmed')";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iissis", $user_id, $room_id, $checkin, $checkout, $guests, $phone);

    if ($insert_stmt->execute()) {
        // Update Room Status to Booked
        $update_sql = "UPDATE add_rooms SET status = 'Booked' WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $room_id);
        $update_stmt->execute();

        echo "<script>alert('Booking Successful!');</script>";
    } else {
        echo "<script>alert('Booking Failed! Please try again.');</script>";
    }
}

?>

<script>
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

<div class="bfrom">
    <h2>Book Your Room</h2>
    <div class="sbfrom">
        <form method="POST">
            <div class="style">
            <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id); ?>">
            </div>
            <div class="style">
              <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            </div>
            <div class="style">
                <label for="chekin_date">Check-in Date</label>
                <input type="date" name="chekin_date" required>
            </div>
            <div class="style">
                <label for="checkout_date">Check-out Date</label>
                <input type="date" name="checkout_date" required>
            </div>
            <div class="style">
                <label for="guests">Number of Guests</label>
                <input type="number" name="guests" required>
            </div>
            <div class="style">
                <label for="phone_num">Phone Number</label>
                <input type="number" name="phone_num" required>
            </div>
            <div class="style">
                <button class="btnp" name="submit">Confirm Booking</button>
            </div>
        </form>
    </div>
</div>

<?php require 'inc/fotter.php'; ?>

<script src="assets/js/chatt-bay.js"></script>
</body>
</html>
