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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $req_id = uniqid();
    $stud_id = $_SESSION['user_id'];
    $owner_id = $_POST['owner_id'];
    $room_id = $_POST['room_id'];
    $req_date = date('Y-m-d');


    // Check if the student has already requested a call for the same room
    $existingRequestQuery = "SELECT * FROM request_call WHERE stud_id = '$stud_id' AND room_id = '$room_id'";
    $existingRequestResult = mysqli_query($conn, $existingRequestQuery);

    if (mysqli_num_rows($existingRequestResult) > 0) {
        // The student has already requested a call for the same room
        echo "<script>
            alert('You have already requested a call for this room.');
            window.location.href = 'index.php';
        </script>";
    } else {
        // Insert the request into the database
        $insertRequestQuery = "INSERT INTO request_call (req_id, stud_id, owner_id, room_id, req_date) 
                              VALUES ('$req_id', '$stud_id', '$owner_id', '$room_id', '$req_date')";
        $result = mysqli_query($conn, $insertRequestQuery);

        if (!$result) {
            echo "<script>
                alert('Error');
                window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Call requested successfully! Owner will contact you soon ...');
                window.location.href = 'index.php';
            </script>";
        }
    }
}
?>
