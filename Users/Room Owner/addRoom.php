<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // user is not logged in, redirect to login page or show an access denied message
    echo "
    <script>
        alert('Log In First to Access this Page');
        setTimeout(function() {
            window.location.href = '../../login.php';
        }, 1000);
    </script>";
    exit();
}

include '../connection.php';
function displayErrorMessage($message, $redirectUrl, $seconds) {
    echo "<p>$message</p>";
    echo "<script>
            setTimeout(function() {
                window.location.href = '$redirectUrl';
            }, $seconds * 1000);
          </script>";
}

if (isset($_POST['addRoom'])) {
    // Generate a single roomId using uniqid()
    $room_id = uniqid();

    // Retrieve form data
    $roomRent = $_POST['roomRent'];
    $roomGender = $_POST['roomGender'];
    $roomAdd = $_POST['roomAdd'];
    $roomStatus = $_POST['roomStatus'];
    $roomAvailableDate = $_POST['roomAvailableDate'];
    $roomType = $_POST['roomType'];
    $numOfBeds = $_POST['numOfBeds'];
    $roomLat = $_POST['lat'];
    $roomLng = $_POST['lng'];
    $extraAmenities = isset($_POST['extraAmenities']) ? $_POST['extraAmenities'] : '';
    $roomTNC = isset($_POST['roomTNC']) ? $_POST['roomTNC'] : '';
    $room_views = 0;
    $owner_id = $_SESSION['user_id'];

    // Insert data into the 'rooms' table
    $insertRoomQuery = "INSERT INTO rooms (`room_id`, `owner_id`, `room_upload_date`, `room_gender`, `room_rent`, `room_add`, `room_status`, `room_available_date`, `room_type`, `room_beds`, `room_lat`, `room_lng`, `room_am`, `room_tnc`, `room_views`)
                    VALUES ('$room_id', '$owner_id', NOW(), '$roomGender', '$roomRent', '$roomAdd', '$roomStatus', '$roomAvailableDate', '$roomType', $numOfBeds, '$roomLat', '$roomLng', '$extraAmenities', '$roomTNC', $room_views)";
    $insertRoomResult = mysqli_query($conn, $insertRoomQuery);

    if (!$insertRoomResult) {
        displayErrorMessage("Error inserting room data. Please try again later.", "manage room.php", 5);
    }
}

// Your existing code for processing other form fields

// Handle selected amenities
if (isset($_POST['selectedAmenities']) && is_array($_POST['selectedAmenities'])) {
    // Sanitize the input to prevent SQL injection
    $selectedAmenities = array_map('intval', $_POST['selectedAmenities']);

    // Insert selected amenities into the room_aminities_link table
    foreach ($selectedAmenities as $amenity_id) {
        $insertAmenityQuery = "INSERT INTO room_aminities_link (ram_id, room_id) VALUES ($amenity_id, '$room_id')";
        $result = mysqli_query($conn, $insertAmenityQuery);
        if (!$result) {
            displayErrorMessage("Error inserting amenity data. Please try again later.", "manage room.php", 5);
        }
    }
}

// Handle room photos
if (isset($_FILES['roomPhoto']) && is_array($_FILES['roomPhoto']['name'])) {
    foreach ($_FILES['roomPhoto']['name'] as $key => $val) {
        if ($_FILES['roomPhoto']['error'][$key] == UPLOAD_ERR_OK) {
            $rand = rand('11111111', '99999999');
            $file = $rand . '_' . $val;
            move_uploaded_file($_FILES['roomPhoto']['tmp_name'][$key], '../images/rooms' . $file);

            // Insert into room_img table
            $insertImagePathQuery = "INSERT INTO room_img (`room_id`, `img_path`) VALUES ('$room_id', '../images/rooms$file')";
            $result = mysqli_query($conn, $insertImagePathQuery);

            if (!$result) {
                displayErrorMessage("Error inserting room photo data. Please try again later.", "manage room.php", 5);
            }
        } else {
            displayErrorMessage("Error uploading room photo. Please try again later.", "manage room.php", 5);
        }
    }
}

// Redirect to "manage room.php" after successfully completing all operations
echo "
<script>
    alert('Room Added Successfully');
</script>";
header("Location: manage room.php");

exit();

mysqli_close($conn);
?>
