<?php
   $css_link ="css/table.css"; 
   require 'inc/header.php';
   require '../inc/config.php'; 
   $sql = "SELECT * FROM add_rooms WHERE status = 'booked'";
   $result = mysqli_query($conn , $sql);
?>

<table>
    <tr>
        <th>ID</th>
        <th>Room_name</th>
        <th>Room_type</th>
        <th>Price</th>
        <th>Capacity</th>
        <th>Image</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php while($room = mysqli_fetch_assoc($result)):?>

        <tr>
                <td> <?php echo $room['id'];?></td>
                <td> <?php echo $room['room_name'];?></td>
                <td> <?php echo $room['room_type'];?></td>
                <td> <?php echo $room['price'];?></td>
                <td> <?php echo $room['capacity'];?></td>
                <td><img class="img" style="width: 100%; height: 50px" src="images/<?php echo $room['image'];?>"></th>
                <td> <?php echo $room['status'];?></td>
                <td>
                    <a class="edit" href="edit_room.php?id=<?php echo $room['id'];?>">Edit</a>
                    <form method="POST" action="room.php" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $room['id'];?>">
                        <button class="delete" type="submit" name="delete_room" onclick="return confirm('Are you sure you want to delete this room?');">Delete</button>
                    </form>
                </td>
        </tr>
        <?php endwhile;?>
    </table>
    <?php
    // Free result set
    mysqli_free_result($result);

    // Close the connection
    mysqli_close($conn);
    ?>
    </div> 
</div>
       
</body>
</html>

