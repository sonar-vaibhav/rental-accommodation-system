<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // user is not logged in, redirect to login page or show an access denied message
    echo "
    <script>
        alert('Log In First to Access this Page');
        setTimeout(function() {
            window.location.href = '../../login.html';
        }, 1000);
    </script>";
    exit();
}

function displayErrorMessage($message, $redirectUrl, $seconds) {
    echo "<p>$message</p>";
    echo "<script>
            setTimeout(function() {
                window.location.href = '$redirectUrl';
            }, $seconds * 1000);
          </script>";
}

include '../connection.php';

if (isset($_POST['updateRoom'])) {
    // Retrieve form data
    $room_id = $_POST['room_id'];
    $roomRent = $_POST['roomRent'];
    $roomAdd = $_POST['roomAdd'];
    $roomGender = $_POST['roomGender'];
    $roomStatus = $_POST['roomStatus'];
    $roomAvailableDate = $_POST['roomAvailableDate'];
    $roomType = $_POST['roomType'];
    $numOfBeds = $_POST['numOfBeds'];
    $extraAmenities = isset($_POST['extraAmenities']) ? $_POST['extraAmenities'] : '';
    $roomTNC = isset($_POST['roomTNC']) ? $_POST['roomTNC'] : '';
    $room_id = $_POST['room_id']; // Assuming you have the room_id available in your code
    $owner_id = $_SESSION['user_id'];

    // Update data in the 'rooms' table
    $updateRoomQuery = "UPDATE rooms SET
                        owner_id = '$owner_id',
                        room_gender = '$roomGender',
                        room_rent = '$roomRent',
                        room_add = '$roomAdd',
                        room_status = '$roomStatus',
                        room_available_date = '$roomAvailableDate',
                        room_type = '$roomType',
                        room_beds = $numOfBeds,
                        room_am = '$extraAmenities',
                        room_tnc = '$roomTNC'
                        WHERE room_id = '$room_id'";

    $updateRoomResult = mysqli_query($conn, $updateRoomQuery);

    if ($updateRoomResult) {
        echo "
        <script>alert('Data Updated Successfully');</script>
        ";
    } else {
        displayErrorMessage("Error updating room data. Please try again later.", "manage room.php", 5);
    }
}

// Your existing code for processing other form fields

// Handle selected amenities
if (isset($_POST['selectedAmenities']) && is_array($_POST['selectedAmenities'])) {
    // Sanitize the input to prevent SQL injection
    $selectedAmenities = array_map('intval', $_POST['selectedAmenities']);

    // Delete existing amenity links for the room
    $deleteAmenityQuery = "DELETE FROM room_aminities_link WHERE room_id = '$room_id'";
    $deleteAmenityResult = mysqli_query($conn, $deleteAmenityQuery);

    if ($deleteAmenityResult) {
        echo "
        <script>alert('Data Updated Successfully');</script>
        ";
    }
    else{
        displayErrorMessage("Error deleting existing amenity links. Please try again later.", "manage room.php", 5);
    }

    // Insert selected amenities into the room_aminities_link table
    foreach ($selectedAmenities as $amenity_id) {
        $insertAmenityQuery = "INSERT INTO room_aminities_link (ram_id, room_id) VALUES ($amenity_id, '$room_id')";
        $result = mysqli_query($conn, $insertAmenityQuery);
        if (!$result) {
            displayErrorMessage("Error inserting amenity data. Please try again later.", "manage room.php", 5);
        }
    }
}

// Redirect to "manage room.php" after successfully completing all operations
echo "
<script>
    alert('Room Updated Successfully');
</script>";
header("Location: manage room.php");

exit();

mysqli_close($conn);
?>