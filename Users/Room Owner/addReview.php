<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../connection.php");

    $stud_id = $_POST['stud_id'];
    $owner_id = $_SESSION['user_id'];
    $rating = $_POST['rating'];
    $review = $_POST['message'];

    $checkSql = "SELECT * FROM student_reviews WHERE stud_id = '$stud_id' AND owner_id = '$owner_id'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Review for this student already exists.');
              window.location.href = 'rate_students.php';
              </script>";
    } else {
        // Proceed with insertion if the combination does not exist
        $str_id = uniqid();
        $str_date = date("Y-m-d");

        $insertSql = "INSERT INTO student_reviews (str_id, stud_id, owner_id, str_date, str_rating, str_review)
                      VALUES ('$str_id', '$stud_id', '$owner_id', '$str_date', '$rating', '$review')";

        if ($conn->query($insertSql) === TRUE) {
            echo "<script>alert('Review submitted successfully.');
                  window.location.href = 'rate_students.php';
                  </script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
} else {
    header("Location: rate_students.php");
    exit();
}
?>
