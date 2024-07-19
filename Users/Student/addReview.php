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

if (isset($_POST['submit'])) {
    $rr_id = uniqid();
    $stud_id = $_SESSION['user_id'];
    $room_id = $_POST['room_id'];

    // Check if the student has already submitted a review for the specified room
    $existingReviewQuery = "SELECT * FROM room_reviews WHERE stud_id = '$stud_id' AND room_id = '$room_id'";
    $existingReviewResult = mysqli_query($conn, $existingReviewQuery);

    if (mysqli_num_rows($existingReviewResult) > 0) {
        echo "<script>
        alert('You have already submitted a review for this room.');
        window.history.back();
      </script>";
    } else {
        $rating = $_POST['rating'];
        $review = $_POST['message'];
        $rr_date = date('Y-m-d');

        // Insert the review into the database
        $insertReviewQuery = "INSERT INTO room_reviews ( rr_id,room_id, stud_id, rr_date, rr_rating, rr_review) 
                              VALUES ( '$rr_id','$room_id', '$stud_id', '$rr_date', '$rating', '$review')";
        $result = mysqli_query($conn, $insertReviewQuery);

        if (!$result) {
            echo "<script>
            alert('Error submitting review.');
            window.history.back();
          </script>";
        } else {
            echo "<script>
            alert('Review submitted successfully!');
            window.history.back();
          </script>";
        }
    }
}
?>
