<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to the login page or show an access denied message
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

// Get the owner_id and stud_id from the URL parameters
$ownerId = $_SESSION['user_id'];
$studId = $_GET['stud_id'];
$removedDate = date('Y-m-d'); 

// Delete the tenant row
$sql = "UPDATE tenants SET still_tenant = 'No', removed_date = '$removedDate' WHERE owner_id = '$ownerId' AND stud_id = '$studId'";

if ($conn->query($sql) === TRUE) {
    echo "
    <script>
        alert('Tenant removed successfully.');
        window.location.href = 'rate_students.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
