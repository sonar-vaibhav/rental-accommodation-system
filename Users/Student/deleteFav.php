<?php
include '../connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['roomId'])) {
    $roomId = $_GET['roomId'];
    $studId = $_SESSION['user_id']; // student ID in the session

    // Check if the room is not already in favorites to avoid duplicates
    $checkQuery = "DELETE FROM fav_rooms WHERE room_id = '$roomId' AND stud_id = '$studId'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (!$checkResult) {
        echo "removed from favorites";
    } else {
        header("Location: ./fav_rooms.php?remove_fav=success");
        exit();
    }
} else {
    // Handle other request methods or missing parameters
    header("Location: ./fav_rooms.php?invalid_request=favorites");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
