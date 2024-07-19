<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // header("Location: login.php");
    echo "Error: User not logged in.";
    exit();
}

// Include your database connection file
include '../connection.php';

// Check if the form is submitted
if (isset($_POST['compRoom'])) {
    $compId = uniqid();
    $userId = $_SESSION['user_id'];
    $roomId = $_POST['room_id'];
    $complaintText = $_POST['roomComp'];
    $complaintDate = date('Y-m-d'); // Current date

    // Check if the user has already complained about this room
    $existingComplaintQuery = "SELECT * FROM complaints WHERE stud_id = '$userId' AND room_id = '$roomId'";
    $existingComplaintResult = mysqli_query($conn, $existingComplaintQuery);

    if (mysqli_num_rows($existingComplaintResult) > 0) {
        // User has already complained about this room, handle accordingly
        echo "<script>
        alert('Error: You have already complained about this room.');
        window.location.href = 'index.php';
        </script>";

    } else {
        // Insert the complaint into the database
        $compId = uniqid();
        $insertComplaintQuery = "INSERT INTO complaints (cmp_id, stud_id, room_id, cmp_date, cmp_text) 
                                VALUES ('$compId','$userId', '$roomId', '$complaintDate', '$complaintText')";
        $result = mysqli_query($conn, $insertComplaintQuery);

        if (!$result) {
            // Handle the error (you may log it or return an error message)
            echo "<script>
        alert('Error adding complaint');
        window.location.href = 'index.php';
        </script>";
        } else {
            echo "<script>
        alert('Complaint Added Successfully');
        window.location.href = 'index.php';
        </script>";
        }
    }
}
?>