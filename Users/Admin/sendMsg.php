<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $msg_id = uniqid();
    $roomId = $_POST['room_id'];
    $ownerId = $_POST['owner_id'];
    $subject = $_POST['subject'];
    $message = $_POST['msg'];

    $insertMsgQuery = "INSERT INTO messages (msg_id, room_id, owner_id, msg_date, msg_subject, msg_text)
                        VALUES ('$msg_id', '$roomId','$ownerId', NOW(), '$subject', '$message')";

    $insertMsgResult = mysqli_query($conn, $insertMsgQuery);

    if ($insertMsgResult) {
        // Message inserted successfully
        echo "
            <script>
                alert('Message sent successfully!');
                window.location.href = 'manage room.php';
            </script>";
        exit();
    } else {
        // Error inserting message
        echo "
            <script>
                alert('Error sending message. Please try again later.');
                window.location.href = 'manage room.php';
            </script>";
        exit();
    }
} else {
    // Redirect to the form page if accessed directly without submitting the form
    header("Location: manage room.php");
    exit();
}
?>