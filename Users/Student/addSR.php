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
    $sr_id = uniqid();
    $stud_id = $_SESSION['user_id'];
    $room_id = $_POST['room_id'];

    // Check if the student has already submitted a review for the specified room
    $existingReviewQuery = "SELECT * FROM society_reviews WHERE stud_id = '$stud_id' AND room_id = '$room_id'";
    $existingReviewResult = mysqli_query($conn, $existingReviewQuery);

    if (mysqli_num_rows($existingReviewResult) > 0) {
        echo "<script>
        alert('You have already submitted a review for this society.');
        window.history.back();
      </script>";
    } else {
        $rating = $_POST['rating'];
        $area = $_POST['area_name'];
        $review = $_POST['message'];
        $sr_date = date('Y-m-d');

        echo "sr_id: $sr_id, room_id: $room_id, stud_id: $stud_id, sr_date: $sr_date, rating: $rating, area: $area, review: $review";

        // Insert the review into the database
        $insertReviewQuery = "INSERT INTO society_reviews (sr_id, room_id, stud_id, sr_date, sr_rating, sr_area, sr_review) 
                              VALUES ('$sr_id', '$room_id', '$stud_id', '$sr_date', '$rating', '$area', '$review')";
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