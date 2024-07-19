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

$tenantId = uniqid();
$ownerId = $_GET['owner_id'];
$studentId = $_SESSION['user_id'];

$sql_check = "SELECT COUNT(*) AS count FROM tenants WHERE stud_id = '$studentId' AND owner_id = '$ownerId'";
$result_check = mysqli_query($conn, $sql_check);
$row_check = mysqli_fetch_assoc($result_check);

if ($row_check['count'] > 0) {
    echo "
    <script>
        alert('You already Rquested before.');
        window.location.href = 'profile_rating.php';
    </script>";
} else {

    $sql = "INSERT INTO tenants (tt_id, stud_id, owner_id) VALUES ('$tenantId', '$studentId', '$ownerId')";

    if ($conn->query($sql) === TRUE) {
        echo "
    <script>
        alert('Request successfully submitted!');
        window.location.href = 'profile_rating.php';
    </script>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>