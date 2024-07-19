<?php
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $msgId = $_POST['msg_id'];
    $message = $_POST['reply_msg'];

    // Check if the msg_reply column is empty
    $checkMsgQuery = "SELECT msg_reply FROM messages WHERE msg_id = '$msgId'";
    $checkMsgResult = mysqli_query($conn, $checkMsgQuery);

    if ($checkMsgResult) {
        $row = mysqli_fetch_assoc($checkMsgResult);

        if (empty($row['msg_reply'])) {
            // Update the msg_reply column only if it is empty
            $insertMsgQuery = "UPDATE messages SET msg_reply = '$message' WHERE msg_id = '$msgId'";
            $insertMsgResult = mysqli_query($conn, $insertMsgQuery);

            if ($insertMsgResult) {
                // Reply sent successfully
                echo "
                    <script>
                        alert('Reply sent successfully!');
                        window.location.href = 'message.php';
                    </script>";
                exit();
            } else {
                // Error updating message
                echo "
                    <script>
                        alert('Error sending reply. Please try again later.');
                        window.location.href = 'message.php';
                    </script>";
                exit();
            }
        } else {
            // Reply column is not empty, do not update
            echo "
                <script>
                    alert('Reply already sent for this message.');
                    window.location.href = 'message.php';
                </script>";
            exit();
        }
    } else {
        // Error checking message
        echo "
            <script>
                alert('Error checking message. Please try again later.');
                window.location.href = 'message.php';
            </script>";
        exit();
    }
} else {
    // Redirect to the form page if accessed directly without submitting the form
    header("Location: manage room.php");
    exit();
}
?>

