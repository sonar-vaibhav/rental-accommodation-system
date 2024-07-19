<?php
include '../connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['roomId'])) {
    $roomId = $_GET['roomId'];
    $studId = $_SESSION['user_id']; // student ID in the session

    // Check if the room is not already in favorites to avoid duplicates
    $checkQuery = "SELECT * FROM fav_rooms WHERE room_id = '$roomId' AND stud_id = '$studId'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($checkResult) == 0) {
        // Room is not in favorites, insert it
        $fav_id = uniqid();
        $insertQuery = "INSERT INTO fav_rooms VALUES ('$fav_id','$roomId', '$studId')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            header("Location: ./index.php?success=favorites");
            exit();
        } else {
            header("Location: ./index.php?error=favorites");
            exit();
        }
    } else {
        header("Location: ./index.php?already_added=favorites");
        exit();
    }
} else {
    // Handle other request methods or missing parameters
    header("Location: ./index.php?invalid_request=favorites");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>
