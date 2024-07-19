<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "
    <script>
        alert('Log In First to Access this Page');
        setTimeout(function() {
            window.location.href = '../../login.html';
        }, 1000);
    </script>";
    exit();
}

include '../connection.php';

// Fetch the values from the form submission
$tenantId = uniqid();
$ownerId = $_SESSION['user_id'];
$studentId = $_POST['stud_id'];
$roomId = $_POST['selectedRoom'];
$addedDate = date('Y-m-d'); // Format: YYYY-MM-DD

// Check if the student has already made a request for the given room
$sql_check = "SELECT COUNT(*) AS count FROM tenants WHERE stud_id = '$studentId' AND owner_id = '$ownerId' AND room_id = '$roomId'";
$result_check = mysqli_query($conn, $sql_check);
$row_check = mysqli_fetch_assoc($result_check);

if ($row_check['count'] > 0) {
    echo "
    <script>
        alert('Student is already your tenant.');
        window.location.href = 'rate_students.php';
    </script>";
} else {
    // Insert the data into the tenants table
    $sql = "INSERT INTO tenants (tt_id, stud_id, owner_id, room_id, added_date, still_tenant) VALUES ('$tenantId', '$studentId', '$ownerId', '$roomId', '$addedDate', 'Yes')";

    if ($conn->query($sql) === TRUE) {
        echo "
    <script>
        alert('Tenant added successfully.');
        window.location.href = 'rate_students.php';
    </script>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

?>